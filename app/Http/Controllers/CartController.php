<?php

namespace App\Http\Controllers;

use oc;
use Stripe;
// use App\Models\Producto;
use Exception;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Parametro;
// use App\Models\clientes_sector;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Models\ordenes_compras;
use App\Mail\ordencompraMailable;
use Illuminate\Support\Facades\DB;
use App\Models\ordenes_compras_det;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Models\ordenes_compras_det_adic;
use App\Models\ordenes_compras_det_opciones;
use App\Models\productos_adicional_val;
use App\Models\ProductosFoto;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    // public function shop()
    // {
    //     $products = Producto::all();

    //     return view('shop.carrito')->with(['products' => $products]);
    // }

    public function cart()
    {
        $cartCollection = \Cart::getContent();

        if (!$cartCollection->count()) {
            return back()->with('error_msg', 'No hay productos cargados en el carrito');
        }

        return view('shop.cart')->with(['cartCollection' => $cartCollection]);
    }

    public function remove(Request $request)
    {
        \Cart::remove($request->id);

        return redirect()->route('cart.index')->with('success_msg', 'Item is removed!');
    }

    public function clear()
    {
        \Cart::clear();

        return redirect()->route('cart.index')->with('success_msg', 'Car is cleared!');
    }

    public function entrega()
    {
        $cartCollection = \Cart::getContent();
        if ($cartCollection->count()) {
            $costo_envio = Parametro::where('campo', 'costo_envio')->first()->valor;
            $cliente = cliente::where('user_id', Auth()->user()->id)->get();

            return view('shop.shipping', compact('cartCollection', 'costo_envio', 'cliente'));
        }
        return back()->with('error_msg', 'Debe completar el paso 1');
    }

    public function entrega_save(Request $request)
    {
        $this->validate($request, [
            'radio' => 'required',
        ]);

        //$tipo_envio = $request->radio;
        $cartCollection = \Cart::getContent();
        // le carga la direccion de entrega a todos los productos
        // $item = reset($cartCollection);
        // $item = array_keys($item)[0];
        foreach ($cartCollection as $item) {
            \Cart::update(
                $item->id,
                array(
                    'entrega' => array(
                        'desc' => explode('|', $request->radio)[2],
                        'id' => explode('|', $request->radio)[0],
                        'value' => explode('|', $request->radio)[1]
                    ),
                )
            );
        }

        if ($request->opcion == 1) {
            return redirect()->route('cart.index');
        } else {
            return redirect()->route('cart.confirm');
        }
        //return $this->pago($tipo_envio); 
    }

    public function pago()
    {
        $cartCollection = \Cart::getContent();
        $ok_2 = false;
        foreach ($cartCollection as $item) {
            if (isset($item['entrega'])) {
                $ok_2 = true;
            }
        }
        if ($ok_2) {
            $cliente = Cliente::where("user_id", Auth()->user()->id)->first();
            if ($cliente->forma_pago_tarjeta) {
                $formaPagos['forma_pago_tarjeta'] = "(Cards) Stripe";
            }
            if ($cliente->forma_pago_cheque) {
                $formaPagos['forma_pago_cheque'] = "Check";
            }
            if ($cliente->forma_pago_ctacte) {
                $formaPagos['forma_pago_ctacte'] = "Saving Account";
            }
            $opcion = "";

            return view('shop.payment', compact('cartCollection', 'formaPagos', 'opcion'));
        }
        return back()->with('error_msg', 'Debe completar el paso 2');
    }

    public function forma_pago(request $request)
    {
        $opcion = $request->radio;

        // Asigna un valor a la variable de sesión 'opcion'
        $_SESSION['opcion'] = 'valor_que_quieres_asignar';

        $total = \Cart::getTotal();
        if ($opcion == 'forma_pago_tarjeta' && $total > 1000000) {
            $opcion = "";
            return back()->with('error_msg', 'No estar permitido el pago con Tarjeta por un total a pagar > a 1 millón');
        }

        return back()->with(compact("opcion"))->withInput();
    }

    public function stripePost(Request $request, string $opcion): RedirectResponse
    {
        DB::beginTransaction(); // Inicia la transacción

        try{
            $total = \Cart::getTotal();
            $nro_trasaccion = "0";
            if ($opcion === 'forma_pago_tarjeta') {
                Stripe\Stripe::setApiKey(config('services.stripe.secret'));

                $resultado = Stripe\Charge::create([
                    "amount" => $total * 100,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "Test payment from itsolutionstuff.com."
                ]);
                $nro_trasaccion = $resultado->id;
                //ver que tipos de errores puede dar stripe
                if ($resultado){
                    //////////////////////////////////////  .?
                }
            }

            $cartCollection = \Cart::getContent();
            //obtengo direcc de envio y costo
            $entrega = ['id' => null, 'value' => null];
            foreach ($cartCollection as $elemento) {
                if (isset($elemento['entrega'])) {
                    $entrega = $elemento['entrega'];
                    break;
                }
            }

            $orden = new ordenes_compras;
            $orden->users_id = Auth()->user()->id;
            $orden->forma_pago = $opcion;
            $orden->tipo_envio = $entrega['id'];
            $orden->costo_envio = $entrega['value'];
            $orden->estados_id = 8;                     //in review
            $orden->stripe_id = $nro_trasaccion;
            $orden->total_descuento = 0;
            $orden->total = $total;
            $orden->save();
            $letra = 'A'; 

            foreach ($cartCollection as $item) {
                $atrib = [];
                if (isset($item['attributes'])) {
                    $atrib = $item['attributes'];
                }

                $oc_det = new ordenes_compras_det;
                $oc_det->ordenes_compras_id = $orden->id;
                $oc_det->productos_id = $item->id;
                $oc_det->codigo = $orden->id . '_' . $letra;
                $oc_det->obs = isset($item['options']['observation']) ? $item['options']['observation'] : null;
                $oc_det->cantidad = $item->quantity;
                $oc_det->precio = $item->price;
                $oc_det->descuento = isset($atrib['descuento']) ? $atrib['descuento'] : null;
                // $oc_det->descuento_tipo = isset($atrib['descuento_tipo']) ? $atrib['descuento_tipo'] : null;
                $oc_det->prod_type = isset($atrib['prod_type']) ? $atrib['prod_type'] : null;
                $oc_det->width_feet = isset($atrib['width_feet']) ? $atrib['width_feet'] : 0;
                $oc_det->width_inches = isset($atrib['width_inches']) ? $atrib['width_inches'] : 0;
                $oc_det->height_feet = isset($atrib['height_feet']) ? $atrib['height_feet'] : 0;
                $oc_det->height_inches = isset($atrib['height_inches']) ? $atrib['height_inches'] : 0;
                $oc_det->obs = isset($item['observation']) ? $item['observation'] : null;
                $oc_det->path_print = isset($item['path_print']) ? $item['path_print'] : null;
                $oc_det->path_cut = isset($item['path_cut']) ? $item['path_cut'] : null;
                $oc_det->cli_shop = isset($item['cli_shop']) ? $item['cli_shop'] : null;
                $oc_det->cli_po = isset($item['cli_po']) ? $item['cli_po'] : null;
                $oc_det->estados_id = 28; //in review
                $oc_det->save();            

                //cambiar esto por guardar aditionals
                if (isset($atrib['aditionals'])) {
                    foreach($atrib['aditionals'] as $adic) {
                        if($adic != null) {
                            $oc_det_adic = new ordenes_compras_det_adic;
                            $array = explode('||', $adic);
                            $oc_det_adic->ordenes_compras_det_id = $oc_det->id;
                            $oc_det_adic->descripcion = $array[0];
                            $oc_det_adic->valor = $array[1];
                            $oc_det_adic->save();
                        }
                    }
                }

                //opciones seleccionadas
                if (isset($atrib['options'])) {
                    foreach($atrib['options'] as $adic) {
                        if($adic != null) {
                            // dd($adic);
                            $oc_det_adic = new ordenes_compras_det_opciones;
                            $array = explode('||', $adic);
                            $oc_det_adic->ordenes_compras_det_id = $oc_det->id;
                            $oc_det_adic->tipo = $array[0];
                            $oc_det_adic->desc_opcion = $array[2];
                            $oc_det_adic->valor = empty($array[3]) ? null : $array[3];
                            $oc_det_adic->save();
                        }
                    }
                }
                
                $letra++;
            }

            DB::commit();
            
            // mail de orden de compra
            $email = UtilesController::traerParamValor('aprueba_registros');
            $user = Auth()->user();
            $cliente = cliente::where('user_id', $user->id)->first();
            $email_user = $user->email;
            $correo = new ordencompraMailable($orden, $cliente);
            Mail::send([], [], function ($message)  use ($email_user, $correo) {
                $message->to($email_user, 'new user')
                    ->subject('Nueva Orden de compra registrada en Imprint SIGNS !')
                    ->setBody($correo->render(), 'text/html');
            });

            \Cart::clear();
            \cart::session(Auth()->user()->id)->clear();

            return redirect()->route("cart.review", $orden->id)
                ->with('success_msg', 'Payment successful!');

        }catch(Exception $e) {   
            if(strpos($e, 'SMTP') > 0){
                return redirect()->route("cart.review", $orden->id)
                ->with('success_msg', 'Payment successful! <br/> note:Email send failed');
            } 
            DB::rollBack();
            return back()->with('error_msg','Los datos de pago ingresados son incorrectos. </br>'.$e->getMessage())
                    ->withInput();
        }
    }

    public function review($id)
    {

        if ($id > 0) {
            $orden_compra = ordenes_compras::v_orden_compra($id)->first();
            $ordenes_compras_det = ordenes_compras_det::v_ordenes_compras_det('ordenes_compras_id', $id)->get();

            return view('shop.review', compact("orden_compra", 'ordenes_compras_det'));
        }
        return back()->with('error_msg', 'Solo se ve el resumen luego de hacer el pago, en su perfil ve las Ordenes de compras');
    }

    public function confirm()
    {
        $cartCollection = \Cart::getContent();
        if (!$cartCollection->count()) {
            return back()->with('error_msg', 'No hay productos cargados en el carrito');
        }
        if ($cartCollection) {
            foreach($cartCollection as $item){
                if(isset($item['entrega']['value'])) {
                    $costo_entrega = $item['entrega']['value'];
                }else {
                    $errorMessage = 'Debe completar los pasos anteriores para ver los productos confirmados.';
                    Session::flash('error_msg', $errorMessage);

                    return redirect()->back()->withInput();
                }
            }

            $total = \Cart::getTotal();
            $total = $total + $costo_entrega;
            $valores = explode(".", $total);
            $totalInt = $valores[0];
            $totalDec = "00";
            if(isset($valores[1])) {
                $totalDec = $valores[1];
            }
            return view('shop.confirm', compact('cartCollection', 'totalInt', 'totalDec'));
        }
        return back()->with('error_msg', 'No hay productos en el carrito para mostrar');
    }

    public function descuento(request $request) {
        $this->validate($request, [
            'codigo_desc' => 'required|alpha_num|size:6',
        ]);

        $valor_desc = 0;
        $total_desc = 0;
        $descuento = UtilesController::traeDescuentoCodigo($request->codigo_desc);

        if(empty($descuento)) {
            return back()->with('error_msg', 'El código ingresado no existe o no aplica a el o los productos en el carito.');
        }
        $cartCollection = \Cart::getContent();
        if($descuento->categorias_id != null) {
            foreach($cartCollection as $item) {
                // dd($item);
                if($item['attributes']['categorias_id'] == $descuento->categorias_id){
                    if(isset($item['descuentos'])) {
                        $total_desc = $item['descuentos']['descuento'];
                        continue;
                    }
                    $valor_desc = $descuento->porcentaje;
                    $total_desc = $total_desc + ( $valor_desc * ($item['quantity'] * $item['price']) / 100);
                    $unit_price = $item['price'] - ($valor_desc * $item['price'] / 100);

                    //reemplaza valor de descuento y desc_tipo
                    $cartItem = \Cart::get($item->id);
                    $attributes = $cartItem->attributes;
                    $attributes['descuento'] = $descuento->porcentaje;
                    $attributes['descuento_por'] = $descuento->cupon;

                    \Cart::update(
                        $item->id,
                        array(
                            'price' =>  $unit_price,
                            'attributes' => $attributes
                        ),
                    );
                }
            }
        }else{
            If ($descuento->productos_id != null) {
                foreach($cartCollection as $item) {
                    if($item['attributes']['productos_id'] == $descuento->productos_id){
                        $valor_desc = $descuento->porcentaje;
                        $total_desc = $total_desc + ( $valor_desc * ($item['quantity'] * $item['price']) / 100); 
                        $unit_price = $item['price'] - ($valor_desc * $item['price'] / 100);
                        \Cart::update(
                            $item->id,
                            array(
                                'price' => $unit_price
                            ),
                        );
                    }
                } 
            }else {
                $valor_desc = $descuento->porcentaje;
            }
        }

        return back()->with('success_msg', 'Descuento aplicado.')
            ->with(['descuento' => $valor_desc, 'total_desc' => $total_desc]);
    }

    public function copiarOC($id) {
        
        $ordenes_det = ordenes_compras_det::v_ordenes_compras_det("ordenes_compras_id", $id)->get();
        $oc_numero = 0;
        foreach($ordenes_det as $oc_det) {
            $oc_numero = $oc_det->ordenes_compras_id;
            $sel_opciones = [];
            $sel_adicionales = [];
            $categorias_id = producto::find($oc_det->productos_id)->categorias_id; 
            $path_foto = ProductosFoto::where("productos_id", $oc_det->productos_id)
                                        ->where("principal", 1)
                                        ->first();
            $sel_opc = ordenes_compras_det_opciones::where('ordenes_compras_det_id', $oc_det->id)->get();
            foreach($sel_opc as $item) {
                $sel_opciones[] = $item->tipo.'||'.$item->id.'||'.$item->desc_opcion.'||'.$item->valor; 
            };
            $sel_adic = ordenes_compras_det_adic::where('ordenes_compras_det_id', $oc_det->id)->get();
            foreach($sel_adic as $item){
                // faltaria rearma para tener el id y poder traer estos valores
                // igual ver el insert en la orden, puede ser que no haga falta ya que no se guardan los id y otros solo una desc y valor
                $sel_adicionales[] =  $item->descripcion.'||'.$item->precio .'||'.$item->id;
            }

            \Cart::add(array(
                'id' => $oc_det->productos_id,
                'name' => $oc_det->categoria_desc . " / " . $oc_det->nombre,
                'price' => $oc_det->precio,
                'quantity' => $oc_det->cantidad,
                'attributes' => array(
                    'image' => $path_foto->path,
                    'descuento' => 0,
                    'descuento_tipo' => '',
                    'categorias_id' => $categorias_id,
                    'productos_id' => $oc_det->productos_id,
                    'options' => $sel_opciones,
                    'slug' => $oc_det->detalle,
                    'aditionals' => $sel_adicionales,
                    'prod_type' =>  $oc_det->prod_type,
                    'width_feet' => $oc_det->width_feet,
                    'width_inches' => $oc_det->width_inches,
                    'height_feet' => $oc_det->height_feet,
                    'height_inches' => $oc_det->height_inches,
                    'total' => $oc_det->customerprice
                )
                // ),
                // 'path_print' =>  $oc_det->path_print,
                // 'observation' =>  $oc_det->obs,
                // 'path_cut' =>  $oc_det->path_cut,
                // 'cli_shop' =>  $oc_det->cli_shop,
                // 'cli_po' =>  $oc_det->cli_po
            ));        
        
            \Cart::update(
                $oc_det->productos_id,
                [
                    'path_cut' =>  $oc_det->path_cut,
                    'cli_shop' =>  $oc_det->cli_shop,
                    'cli_po' =>  $oc_det->cli_po
                ],
            );

            \Cart::update(
                $oc_det->productos_id,
                [
                    'path_print' =>  $oc_det->path_print,
                    'observation' =>  $oc_det->obs
                ]
            );
        }
        
        // $cartCollection = \Cart::getContent();
        // dd('desde copia de oc',$cartCollection);

        //return view('shop.cart');
        return redirect()->route('cart.index')->with('success_msg', 'Se ha creado un nuevo Cart con los productos de la Orden de compra: '.$oc_numero.' !');
    }

}
