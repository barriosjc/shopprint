<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Descuento;
use App\Models\Parametro;
use Illuminate\Http\Request;
use App\Mail\registerMailable;
// use App\Models\clientes_sector;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use App\Mail\resetpasswordMaillable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ViewErrorBag;
use App\Mail\registerImprentaMailable;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UtilesController;

// use App\Models\clientes_datos_facturacion;


/**
 * Class ClienteController
 * @package App\Http\Controllers
 */
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::paginate();
        $origen = 'index';

        return view('cliente.index', compact('clientes', 'origen'))
            ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
    }

    public function habilitar()
    {
        $clientes = Cliente::where('fecha_aprobo', null)->paginate();
        $origen = 'hab';

        return view('cliente.index', compact('clientes', 'origen'))
            ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($origen)
    {
        $cliente = new Cliente();
        $user = new User();
        $usuarios = User::v_empleados()->get();

        if ($origen === 'register') {
            $view = 'auth.register';
        } else {
            $view = 'cliente.create';
        }

        return view($view, compact('cliente', 'usuarios', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $origen)
    {
        $paso = 0;
        $back = false;
        if ($request->origen == 'abm') {
            $back = true;
        }

        if ($request->has('step1') || $back) {
            // Obtén los datos del formulario
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $conf_email = $request->input('conf_email');
            $errors = [];

            if (empty($first_name) || strlen($first_name) > 255) {
                $errors[] = 'El campo  First Name es requerido y debe tener un máximo de 255 caracteres.';
            }
            if (empty($last_name) || strlen($last_name) > 255) {
                $errors[] = 'El campo Last Name es requerido y debe tener un máximo de 255 caracteres.';
            }
            if (empty($phone) || strlen($phone) > 100) {
                $errors[] = 'El campo Phones es requerido y debe tener un máximo de 100 caracteres.';
            }
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'El campo E-mail Address es requerido y debe ser una dirección de correo electrónico válida.';
            }
            if ($request->valida_confirm == 'si') {
                if ($email != $conf_email) {
                    $errors[] = 'El email y la Confirmación de email deben ser iguales.';
                }
            }
            if (User::where('email', $email)->exists()) {
                $errors[] = 'The E-mail Address has already been registered. If you had already registered previously, log in and recover your password.';
            }
            $messageBag = new MessageBag($errors);
            // Crear un objeto ViewErrorBag y asignar el MessageBag
            $viewErrorBag = new ViewErrorBag();
            $viewErrorBag->put('default', $messageBag);

            if (!empty($errors)) {
                return back()
                ->with('paso', 1)
                ->with("errors", $viewErrorBag)
                ->withInput();
            }

            $paso = 2;
        }
        if ($request->has('step2') || $back) {
            $country = $request->input('country');
            $city = $request->input('city');
            $state = $request->input('state');
            $zipcode = $request->input('zipcode');
            $address1 = $request->input('address1');
            $address2 = $request->input('address2');
            $errors = [];
            if (empty($country) || strlen($country) > 45) {
                $errors[] = 'Debe ingresar el campo Country es obligatorio';
            }
            if (empty($city) || strlen($city) > 45) {
                $errors[] = 'Debe ingresar el campo City es obligatorio';
            }
            if (empty($state) || strlen($state) > 45) {
                $errors[] = 'Debe ingresar el campo State es obligatorio';
            }
            if (empty($zipcode) || strlen($zipcode) > 20) {
                $errors[] = 'Debe ingresar el campo Zip Code es obligatorio';
            }
            if (empty($address1) || strlen($address1) > 255) {
                $errors[] = 'Debe ingresar el campo Address (Line 1) es obligatorio';
            }
            if (empty($address2) || strlen($address2) > 255) {
                $errors[] = 'Debe ingresar el campo Address (Line 2) es obligatorio';
            }
            $messageBag = new MessageBag($errors);
            // Crear un objeto ViewErrorBag y asignar el MessageBag
            $viewErrorBag = new ViewErrorBag();
            $viewErrorBag->put('default', $messageBag);

            if (!empty($errors)) {
                return back()
                ->with('paso', 2)
                ->with("errors", $viewErrorBag)
                ->withInput();
            }

            $paso = 3;
        }

        if ($request->has('step3') || $back) {
            $company = $request->input('company');
            $taxid = $request->input('taxid');
            $website = $request->input('website');
            $about_us = $request->input('about_us');
            $form_path = $request->file('form_path');
            $errors = [];
            if (empty($company) || strlen($company) > 100) {
                $errors[] = 'Debe ingresar el campo Company es obligatorio';
            }
            if (empty($taxid) || strlen($taxid) > 20) {
                $errors[] = 'Debe ingresar el campo TAX id es obligatorio';
            }
            if ($request->origen != 'abm') {
                if (empty($about_us) || strlen($about_us) > 500) {
                    $errors[] = 'Debe ingresar el dato de About Us, ingresar hasta 500 caractes máximo';
                }
            }
            if (empty($website) || strlen($website) > 20) {
                $errors[] = 'Debe ingresar el campo WebSite es obligatorio';
            }
            if (empty($form_path) || !in_array($form_path->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'pdf']) || $form_path->getSize() > 2048000) {
                $errors[] = 'Debe elegir el archivo de formulario en formato jpg, jpeg, png o pdf, y no debe exceder 2MB';
            }
            $messageBag = new MessageBag($errors);
            // Crear un objeto ViewErrorBag y asignar el MessageBag
            $viewErrorBag = new ViewErrorBag();
            $viewErrorBag->put('default', $messageBag);

            if (!empty($errors)) {
                return back()
                ->with('paso', 3)
                ->with("errors", $viewErrorBag)
                ->withInput();
            }
         
            $this->save($request, $origen);
            $paso = 4;

            return back()
                ->with('paso', $paso);
        }

        if ($request->has('step-2')) {
            $paso = 1;
        }

        if ($request->has('step-3')) {
            $paso = 2;
        }

        return back()
            ->with('paso', $paso)
            ->withInput();
    }

    public function save(Request $request, $origen)
    {

        DB::beginTransaction(); // Inicia la transacción
        try {
            $user = new user;
            $user->name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make('WebMedia');
            $user->save();

            $cliente = new Cliente;
            $cliente->user_id = $user->id;
            $cliente->first_name = $request->first_name;
            $cliente->last_name = $request->last_name;
            $cliente->city = $request->city;
            $cliente->phone = $request->phone;
            $cliente->country = $request->country;
            $cliente->state = $request->state;
            $cliente->zipcode = $request->zipcode;
            $cliente->address1 = $request->address1;
            $cliente->address2 = $request->address2;
            $cliente->company  = $request->company;
            $cliente->website  = $request->website;
            $cliente->taxid = $request->taxid;
            $envia_clave = false;
            if( isset($request->habilitar) ) {
                $envia_clave = true;
                $cliente->fecha_aprobo = date("Y-m-d H:i");
                $cliente->users_id_aprobo = Auth()->user()->id;
            }else{
                $cliente->fecha_aprobo = null;
                $cliente->users_id_aprobo = null;
            }
            $cliente->factor_envio = isset($request->factor_envio) ? $request->factor_envio : 0;
            // $cliente->users_id_aprobo = isset($request->users_id_aprobo) ? $request->users_id_aprobo : null;
            $originalName = $request->file('form_path')->getClientOriginalName();
            $path = $originalName;
            $path = Storage::disk('clientes')->put("", $request->file('form_path'));
            $cliente->form_path = $path;

            // $cliente->email = $request->email;
            if ($origen === 'register') {
                $cliente->forma_pago_tarjeta = 1;
                $cliente->forma_pago_cheque =  0;
                $cliente->forma_pago_ctacte =  0;
            } elseif ($origen === 'abm'){
                $cliente->forma_pago_tarjeta = isset($request->tarjeta) ? 1 : 0;
                $cliente->forma_pago_cheque = isset($request->cheque) ? 1 : 0;
                $cliente->forma_pago_ctacte = isset($request->ctacte) ? 1 : 0; 
            } else {
                $cliente->forma_pago_tarjeta = 1;
            }
            $cliente->save();

            //le asigna el  role cliente al nuevo usuario
            $user->assignRole('clientes');
            DB::commit();

            if($envia_clave) {
                $clave = bin2hex(random_bytes(5));
                $hash = Hash::make($clave);
                
                //$empresa = empresa::where("id", $user->empresas_id)->first();
                $user->password = $hash;
                $user->cambio_password = 1;
                $user->save();
    
                $correo = new resetpasswordMaillable($user, $clave);
                Mail::send([], [], function ($message)  use ($user, $correo) {
                    $message->to($user->email, $user->last_name)
                        ->subject('Creación de clave para ingreso a portal Imprint SIGNS !')
                        ->setBody($correo->render(), 'text/html');
                });
            }else {
                // mail a usuario
                $email = UtilesController::traerParamValor('aprueba_registros');
                $email_user = $user->email;
                $correo = new registerMailable($user, $cliente);
                Mail::send([], [], function ($message)  use ($email_user, $correo) {
                    $message->to($email_user, 'new user')
                        ->subject('Registro de usuario para ingreso al portal Imprint SIGNS !')
                        ->setBody($correo->render(), 'text/html');
                });
            }

            if ($origen != 'abm') {
            // mail a la imprenta
                $email = UtilesController::traerParamValor('aprueba_registros');
                $correo = new registerImprentaMailable($user, $cliente);
                Mail::send([], [], function ($message)  use ($email, $correo) {
                    $message->to($email, 'new user')
                        ->subject('Registro de usuario para ingreso al portal Imprint SIGNS !')
                        ->setBody($correo->render(), 'text/html');
                });
            }
            $paso = 4;
    
            // return back()->twith(["success" => 'Registración exitosa, se van analizar los datos ingresados y luego va a recibir un email con el resultado del registro.']);
            if($origen == 'abm') {
                return redirect()->route('clientes.index')->with('success', 'Se ingreso nuevo cliente en forma exitosa y si corresponde se le envia email con datos de ingreso !');
            }else {
                return back()
                ->with('paso', $paso);
            }
    
        } catch (Exception $e) {
            // Si ocurre algún error, revierte la transacción
            DB::rollBack();

            // ver esto no podria dar ok si hace un rollback, no guarda nada asi
            // if (stripos($e, 'SMTP') !== false) {
            //     //no se envio email pero el registro se hizo
            //     return redirect()->back()
            //         ->with(["success" => 'Registración exitosa, se van analizar los datos ingresados y luego va a recibir un email con el resultado del registro.']);
            // } else {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Error al guardar los datos del cliente. \n' .
                        $e->getCode() . "\n" .
                        $e->getMessage());
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);

        return view('cliente.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $origen)
    {

        $cliente = Cliente::find($id);
        $user = User::where('id', $cliente->user_id)->first();
        $usuarios = User::v_empleados()->get();
        $descuentos = Descuento::get();

        return view('cliente.edit', compact('cliente',  'usuarios', 'user', 'origen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $origen)
    {
        $cliente = Cliente::where('id', $id)->first();
        
        $users = Auth()->user();
        $validated = $request->validate(
            [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'phone' => 'required|max:100',
                'email' => 'required|max:200',
                'country' => 'required|max:45',
                'city' => 'required|max:45',
                'state' => 'required|max:45',
                'zipcode' => 'required|max:20',
                'address1' => 'required|max:255',
                'address2' => 'nullable|max:255',
                'company' => 'required|max:100',
                'taxid' => 'required|max:20',
                'factor_envio' => 'required|numeric|between:0,9999.99',
                'form_path' => Rule::requiredIf(fn () => $request->form_path_text),
                'email' => ['required', 'email', Rule::unique('users')->ignore($cliente->user_id)]

            ],
            [
                'email.unique' => 'The email has already been registered. If you had already registered previously, log in and recover your password. ',
                'form_path.required' => 'You must choice the form file, jpg, png, pdf.',
                'first_name.required' => 'Debe ingresar el campo First Name, es obligatorio ',
                'last_name.required' => 'Debe ingresar el campo Last Name, es obligatorio ',
                'phone.required' => 'Debe ingresar el campo Phones, es obligatorio ',
                'email.required' => 'Debe ingresar el campo E-mail Address, es obligatorio ',
                'country.required' => 'Debe ingresar el campo Country es obligatorio ',
                'city.required' => 'Debe ingresar el campo City es obligatorio ',
                'state.required' => 'Debe ingresar el campo State es obligatorio ',
                'zipcode.required' => 'Debe ingresar el campo Zip Code es obligatorio ',
                'address1.required' => 'Debe ingresar el campo Address (Line 1) es obligatorio ',
                'address2.required' => 'Debe ingresar el campo Address (Line 2) es obligatorio ',
                'company.required' => 'Debe ingresar el campo Company es obligatorio',
                'taxid.required' => 'Debe ingresar el campo TAX id es obligatorio',
                'website.required' => 'Debe ingresar el campo Website es obligatorio',
            ]
        );
        DB::beginTransaction(); // Inicia la transacción
        try {
            $cliente->first_name = $request->first_name;
            $cliente->last_name = $request->last_name;
            $cliente->phone = $request->phone;
            $cliente->country = $request->country;
            $cliente->city = $request->city;
            $cliente->state = $request->state;
            $cliente->zipcode = $request->zipcode;
            $cliente->address1 = $request->address1;
            $cliente->address2 = $request->address2;
            $cliente->company  = $request->company;
            $cliente->website  = $request->website;
            $cliente->taxid = $request->taxid;

            $envia_clave = false;
            $bloquea = false;
            if ($cliente->fecha_aprobo == null) {
                if( isset($request->habilitar) ) {
                    $envia_clave = true;
                    $cliente->fecha_aprobo = date("Y-m-d H:i");
                    $cliente->users_id_aprobo = Auth()->user()->id;
                }else{
                    $cliente->fecha_aprobo = null;
                    $cliente->users_id_aprobo = null;
                }
            }else{
                if( ! isset($request->habilitar) ) {
                    $cliente->fecha_aprobo = null;
                    $cliente->users_id_aprobo = null;
                    $bloquea = true;
                }
            }
            $cliente->factor_envio = isset($request->factor_envio) ? $request->factor_envio : 1;
            // $cliente->users_id_aprobo = isset($request->users_id_aprobo) ? $request->users_id_aprobo : $cliente->users_id_aprobo;
            // $cliente->fecha_aprobo = isset($request->fecha_aprobo) ? $request->fecha_aprobo : null;
            if ($request->hasFile('form_path')) {
                $originalName = $request->file('form_path')->getClientOriginalName();
                $path = $originalName;
                $path = Storage::disk('clientes')->put("", $request->file('form_path'));
                $cliente->form_path = $path;
            }
            // $cliente->email = $request->email;
            $cliente->forma_pago_tarjeta = isset($request->tarjeta) ? 1 : 0;
            $cliente->forma_pago_cheque = isset($request->cheque) ? 1 : 0;
            $cliente->forma_pago_ctacte = isset($request->ctacte) ? 1 : 0;
            $cliente->save();

            $user = User::where('id', $cliente->user_id)->first();
            $user->name = $request->first_name; 
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            if($bloquea) {
                $user->password = "DESHABILITADO";
                $user->cambio_password = 1;
            }
            $user->save();

            DB::commit();

            if($envia_clave) {
                $clave = bin2hex(random_bytes(5));
                $hash = Hash::make($clave);
                
                //$empresa = empresa::where("id", $user->empresas_id)->first();
                $user->password = $hash;
                $user->cambio_password = 1;
                $user->save();
    
                $correo = new resetpasswordMaillable($user, $clave);
                Mail::send([], [], function ($message)  use ($user, $correo) {
                    $message->to($user->email, $user->name)
                        ->subject('Cambio de clave para ingreso a portal Imprint SIGNS !')
                        ->setBody($correo->render(), 'text/html');
                });
            }

            if($origen == 'index'){
                return redirect()->route('clientes.index')
                    ->with('success', 'Client updated successfully.');
            }else{
                return redirect()->route('clientes.habilitar')
                ->with('success', 'Client updated successfully.');
            }
        } catch (Exception $e) {
            // Si ocurre algún error, revierte la transacción
            DB::rollBack();

            return redirect()->back()->with('error', 'Error al actualizar los datos del cliente cliente ' . $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cliente = Cliente::where('id', $id)->first();
        // $user = User::where('id', $cliente->user_id)->first();
        // $user->removeRole('clientes');
        // $user->delete();
        // $cliente->delete();
        $cliente->fecha_aprobo = null;
        $cliente->users_id_aprobo = null;
        $cliente->save();


        return redirect()->route('clientes.index')
            ->with('success', 'Client deleted successfully');
    }
}

