<?php

namespace App\Http\Controllers\seguridad;

use App\Models\Tickets;
use App\Models\user;
use App\Models\Cliente;
use App\Models\Parametro;
use Illuminate\Http\Request;
use App\Mail\registerMailable;
use App\Models\ordenes_compras;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UtilesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $user = user::where("id", $id)->first();

        return view('seguridad.usuario.perfil')->with(compact( 'user'));
    }

    public function nuevo()
    {
        $user = new user();

        return view('seguridad.usuario.perfil')->with(compact('user'));
    }

    public function save(request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
        ]);

        $user = new user();
        $validated['password'] = Hash::make('12345678');
        $validated['cambio_password'] = 1;

        foreach ($validated as $key => $value) {
            $user->$key = $value;
        }
        $user->save();
        if ($es_nuevo) {
            $correo = new registerMailable($user);
            Mail::send([], [], function ($message)  use ($request, $correo) {
                $message->to($request->email, $request->last_name)
                    ->subject('Registro de usuario para ingreso a portal Clap!')
                    ->setBody($correo->render(), 'text/html');
            });
        }
        
        return back()
            ->withInput($request->input())
            ->with('success', 'Se guardó los datos del usuario en forma correcta.');
    }

    // public function foto(Request $request)
    // {
    //     $request->validate([
    //         "id" => 'required',
    //         'foto' => 'image'
    //     ], [
    //         'id.required' => 'Primero debe tener guardado Detalle de usuario para luego poder subir una foto'
    //     ]);

    //     $user = User::findOrFail($request->id);
    //     if ($request->hasFile('foto')) {
    //         // guarda el archivo dentro de storage/app/fotos
    //         $foto_vieja = $user->foto;
    //         if (!empty($foto_vieja)) {
    //             Storage::delete($foto_vieja);
    //         }
    //         $path = Storage::disk('usuarios')->put("", $request->file('foto'));
    //         $user->foto = $path;
    //         $user->save();
    //     }

    //     return back()
    //         ->withInput($request->input())
    //         ->with('success', 'Foto actualizada correctamente.');
    // }

    public function password()
    {
        $titulo = "Cambio de clave";

        return view('seguridad.usuario.password')->with(compact('titulo'));
    }

    public function save_password(Request $request)
    {
        $validado = $request->validate([
            'password_nueva' => ['required', 'string', 'min:8', 'max:20', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                                'different:password_actual'],
            'confirmacion_password' => [
                'required', 'string', 'min:8', 'max:20', 'same:password_nueva'
            ],
            'password_actual' => [
                'required', 'string', 'max:20',
                function ($attribute, $value, $fail) use ($request) {
                    $usuario = User::where('id', Auth()->user()->id)->first();
                    if (!($usuario && Hash::make($value) != $usuario->password)) {
                        $fail('La clave actual que ingreso es incorrecta.');
                    }
                }
            ]
        ]);

        $user = user::where("id", Auth()->user()->id)->first();
        $user->password = hash::make($validado['password_nueva']);
        $user->cambio_password = 0;
        $user->save();

        return back()->with('success', 'Se actualizó la nueva password correctamente.');
    }

    public function readonly($id)
    {
        $user = user::where("id", $id)->first();
        $readonly = true;

        return view('seguridad.usuario.perfil_readonly')->with(compact( 'user', 'readonly'));
    }

    // front end, se accede desde mi perfil, usuario
    public function profile() {

        $cliente = Cliente::where('user_id', Auth()->user()->id)->first();
        $valores = UtilesController::ProfileCants();
        $activo = 'profile';

        if ($cliente) {
            return view('profile.front_profile')->with(compact('cliente', 'valores', 'activo'));
        }else {
            return redirect()->route('profile')->with(compact('user'));
        }
    }

    public function pass_change(){

        $valores = UtilesController::ProfileCants();
        $activo = 'password';

        return view('profile.cambio_clave')->with(compact('valores', 'activo'));
    }
}
