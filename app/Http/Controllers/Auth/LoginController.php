<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Cliente;
use Spatie\Permission\Traits\HasRoles;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        if ($this->guard()->attempt($credentials, $request->filled('remember'))) {
            // Validar el estado del usuario después de haber iniciado sesión
            if ($this->isUserActive($credentials)) {
                return true;
            } else {
                // Si el usuario no está activo, cerramos la sesión y lanzamos una excepción
                $this->guard()->logout();
                throw ValidationException::withMessages([
                    $this->username() => [trans('auth.account_inactive')],
                ]);
            }
        }

        return false;
    }

    protected function isUserActive($credentials)
    {
        // Asume que tienes un campo 'activo' y 'fecha_aprobo' en tu modelo de usuario
        //$user = Auth::getProvider()->retrieveByCredentials($credentials);
        $user = Auth()->user();
        if ($user->roles->where('name','cliente')->first()) {
            $cliente = cliente::where("user_id", Auth()->user()->id)->first();
            $fecha = $cliente->fecha_aprobo;
        }else{
            return true;
        }
    
        if ($fecha != null) {
            return true;
        }
    
        return false;
    }
    
    protected function isValidAprovalDate($fechaAprobo)
    {
        // Verifica si la fecha de aprobación es mayor a la fecha actual
        return strtotime($fechaAprobo) > time();
    }
}
