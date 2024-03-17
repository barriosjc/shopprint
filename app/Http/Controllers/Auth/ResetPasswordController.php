<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\resetpasswordMaillable;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{

    public function  restablecer()
    {
        return view('auth.passwords.email');
    }

    public function email(Request $request)
    {
        $validated = $request->validate(
            [
                'email' => 'required|string|max:200',
            ]
        );

        $user = user::where('email', $request->email)->first();
        if (!empty($user)) { 
            $cliente = cliente::where('user_id', $user->id)->first();
            if($cliente->fecha_aprobo == null){
                return back()->with(['error' => 'No se ha podido encontrar en nuestro sistema un usuario con el correo ingresado o no tiene el acceso autorizado']);
            }
            $clave = bin2hex(random_bytes(5));
            $hash = Hash::make($clave);
            
            //$empresa = empresa::where("id", $user->empresas_id)->first();
            $user->password = $hash;
            $user->cambio_password = 1;
            $user->save();

            $correo = new resetpasswordMaillable($user, $clave);
            Mail::send([], [], function ($message)  use ($user, $correo) {
                $message->to($user->email, $user->last_name)
                    ->subject('Cambio de clave para ingreso a portal Imprint SIGNS !')
                    ->setBody($correo->render(), 'text/html');
            });
        }else {
            return back()->with(['error' => 'No se ha podido encontrar en nuestro sistema un usuario con el correo ingresado']);
        }

        return back()->with(['success' => 'Se le ha enviado un email a '.$validated['email'].' con su nueva clave.']);
    }
}
