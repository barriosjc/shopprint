<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ordenes_compras;
use App\Models\ordenes_compras_det;
use App\Models\ordenes_compras_det_adic;
use App\Models\ordenes_compras_det_opciones;
use App\Models\Parametro;
use App\Models\Tickets_det;
use Illuminate\Support\Facades\DB;

class OrdenesController extends Controller
{
    public function abiertas()
    {
        //$estado_fin = UtilesController::traerParamValor('estado_oc_fin');
        //DB::enableQueryLog();
        $ordenes = ordenes_compras::v_ordenes_compras_front(Auth()->user()->id)
            ->whereIn('estados_id', [8, 11, 13])->paginate(); //Recibido, Cancelado
        $valores = UtilesController::ProfileCants();
        $activo = 'open';
        // dd(DB::getQueryLog());
     
        return view('profile.ordenes', compact('ordenes', 'valores', 'activo'))
            ->with('i', (request()->input('page', 1) - 1) * $ordenes->perPage());
    }

    public function historial()
    {
        $estado_fin = UtilesController::traerParamValor('estado_oc_fin');
        $ordenes = ordenes_compras::v_ordenes_compras_front(Auth()->user()->id)
            ->whereIn('estados_id', [6,7])->paginate();
        $valores = UtilesController::ProfileCants();
        $activo = 'history';

        return view('profile.ordenes', compact('ordenes', 'valores', 'activo'))
            ->with('i', (request()->input('page', 1) - 1) * $ordenes->perPage());
    }

    public function details($ordenes_id, $activo) {

        $orden = ordenes_compras::v_orden_compra($ordenes_id)->first();
        $ordenes_det = ordenes_compras_det::v_ordenes_compras_det('ordenes_compras_id',$ordenes_id)->get();
        $valores = UtilesController::ProfileCants();
        $activo = 'details';

        return view('profile.product-client-order',  compact('orden', 'ordenes_det', 'valores', 'activo'));
    }


    public function product_details($detalle_id, $activo) {

        $ordenes_det = ordenes_compras_det::v_ordenes_compras_det('ordenes_compras_det.id', $detalle_id)->first();
        $orden = ordenes_compras::v_orden_compra($ordenes_det->ordenes_compras_id)->first();
        $ordenes_det_adic = ordenes_compras_det_adic::where('ordenes_compras_det_id', $detalle_id)->get();
        $valores = UtilesController::ProfileCants();
        $ordenes_det_opciones = ordenes_compras_det_opciones::where('ordenes_compras_det_id', $detalle_id)->get();
        // dd($ordenes_det_opciones);

        return view('profile.product-approval',  compact('orden','ordenes_det', 'ordenes_det_adic', 'valores', 'activo', 'ordenes_det_opciones'));
    }

    // backend
    // ---------------------------------------------------------------------

    public function back_index($tipo)
    {
        switch ($tipo) {
            case 'admin':
                $filtro = [6,7,8,9];
                break;
            case 'prod':
                $filtro = [10];
                break;
            case 'shipp':
                $filtro = [11];
                break;
            default:
                $filtro = null;
                break;
        }

        if ($filtro) {
            $ordenes = ordenes_compras::v_ordenes_compras()
                ->whereIn('estados_id', $filtro)->get();
        }else{
            $ordenes = ordenes_compras::v_ordenes_compras()
                    ->get();
        }

        //cantidad de tickets y lo carga en nuevo atrib
        $tickets = new TicketsController;
        foreach($ordenes as $item){
            $cant = $tickets->traer_cant_msg_oc($item->id, 'c');
            $item->cant_msg = $cant;
        }

        $estados = UtilesController::traerParamValores('oc_estados');
        $activo = 'history';

        return view('ordenes.orders-list', compact('ordenes', 'activo', 'estados'));
            // ->with('i', (request()->input('page', 1) - 1) * $ordenes->perPage());
    }

    public function back_details($ordenes_id, $activo) {

        $orden = ordenes_compras::v_orden_compra($ordenes_id)->first();
        $estados = UtilesController::traerParamValores('det_estado');
        $internos = UtilesController::traerParamValores('oc_int_estados');
        $ordenes_det = ordenes_compras_det::v_ordenes_compras_det('ordenes_compras_id',$ordenes_id)->get();
        $valores = UtilesController::ProfileCants();

        return view('ordenes.product-client-order',  compact('orden', 'ordenes_det', 'activo', 'estados', 'internos'));
    }

    public function back_product_details($detalle_id, $activo) {

        $ordenes_det = ordenes_compras_det::v_ordenes_compras_det('ordenes_compras_det.id', $detalle_id)->first();
        $ordenes_det_adic = ordenes_compras_det_adic::where('ordenes_compras_det_id', $detalle_id)->get();
        $valores = UtilesController::ProfileCants();
        $orden = ordenes_compras::v_orden_compra( $ordenes_det->ordenes_compras_id)->first();
        $ordenes_det_opciones = ordenes_compras_det_opciones::where('ordenes_compras_det_id', $detalle_id)->get();

        switch($ordenes_det->estados_id) {
        case 27:
            $color = 'bg-info';
        break;
        case 28:
            $color = 'bg-primary';
        break;
        case 29:
            $color = 'bg-success';
        break;
        case 30:
            $color = 'bg-danger';
        break;
        default:
            $color = 'bg-accent';
        }

        switch($ordenes_det->estados_id_int) {
        case 31:
           $color_int = 'bg-inflatcut';
            break;
        case 32:
           $color_int = 'bg-inlamination';
            break;
        case 33:
           $color_int = 'bg-inpreparation';
            break;
        case 34:
           $color_int = 'bg-externalsupply';
            break;
        case 38:
           $color_int = 'bg-completed';
            break;
        case 39:
           $color_int = 'bg-cancelledinterno';
            break;
        case 40:
           $color_int = 'bg-incanonflatprint';
            break;
        case 41:
           $color_int = 'bg-incanoncolorado';
            break;
        case 42:
           $color_int = 'bg-inepson60600l';
            break;
        case 43:
           $color_int = 'bg-inmimakitxf150';
            break;
        case 44:
           $color_int = 'bg-inplottercutting';
            break;
        default;
       $color_int = 'bg-completed';
        }
        
        return view ('ordenes.product-approval',  compact('orden', 'ordenes_det', 'ordenes_det_adic', 'valores', 'activo', 'color', 
                                    'color_int', 'ordenes_det_opciones'));
    }

    public function back_entrega(Request $request) {
        $id = $request->input('orden_id');
        $nuevoentrega = $request->input('fecha_entrega');
        $orden = ordenes_compras::find($id);

        if ($orden) {
            $orden->fecha_entrega = $nuevoentrega;
            $orden->save();
    
            return back();
            // return response()->json(['message' => 'OK']);
        } else {
            //ver si retorna error
            return back();
            // return response()->json(['message' => 'Error: Orden no encontrada'], 404);
        }
    }
    
    public function back_estado(Request $request) {
        $id = $request->input('id');
        $nuevo_valor = $request->input('valor');
        $orden = ordenes_compras::find($id);
        if ($orden) {
            $orden->estados_id = $nuevo_valor;
            $orden->save();
    
            return back();
        } else {
            return back();
        }
    }
        
    public function back_estado_int(Request $request) {
        $id = $request->input('prod_id');
        $nuevo_valor = $request->input('valor');
        $orden = ordenes_compras_det::find($id);

        if ($orden) {
            $orden->estados_id_int = $nuevo_valor;
            $orden->save();
    
            return back();
        } else {
            return back();
        }
    }
       
    public function back_detalle_estado(Request $request) {
        $id = $request->input('id');
        $nuevo_valor = $request->input('valor');
        $orden = ordenes_compras_det::find($id);

        if ($orden) {
            $orden->estados_id = $nuevo_valor;
            $orden->save();
    
            return back();
        } else {
            return back();
        }
    }

    public function filtrar(request $request)
    {
        // $estado_id = $request->input('estado');
        $filtro = [$request->select_filtro];

        if(isset($request->select_filtro)){
            $ordenes = ordenes_compras::v_ordenes_compras()
                ->whereIn('estados_id', $filtro)->get();
        }else{
            $ordenes = ordenes_compras::v_ordenes_compras()
                    ->get();
        }
        $estados = UtilesController::traerParamValores('oc_estados');
        $internos = UtilesController::traerParamValores('oc_int_estados');
        $activo = 'history';

        return view('ordenes.orders-list', compact('ordenes', 'activo', 'estados', 'internos'));
    }

}
