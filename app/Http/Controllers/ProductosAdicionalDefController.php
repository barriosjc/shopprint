<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Parametro;
use Illuminate\Http\Request;
use App\Models\ProductosAdicionalDef;
use Illuminate\Support\Facades\Response;
use App\Models\ProductosAdicionalDefSelect;
use Illuminate\Validation\ValidationException;

/**
 * Class ProductosAdicionalDefController
 * @package App\Http\Controllers
 */
class ProductosAdicionalDefController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ProductosAdicionalDef = ProductosAdicionalDef::v_ProductosAdicionalDef()
        ->paginate();

        return view('productos-adicional-def.index', compact('ProductosAdicionalDef'))
            ->with('i', (request()->input('page', 1) - 1) * $ProductosAdicionalDef->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productosAdicionalDef = new ProductosAdicionalDef();
        $adic_tipo = Parametro::where('campo', 'prod_adic_tipo')->get();
        $productos = Producto::all();

        return view('productos-adicional-def.create', compact('productosAdicionalDef', 'adic_tipo', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ProductosAdicionalDef::$rules);
        if($request->definicion_tipo == "select"){
            if ($request->j_tabla == "{}") {
                $errorMessage = 'Si ingresa un dato adicional Tipo de valor de atributo debe ingresar los valores como se indica para poder guardarlo.';
                throw ValidationException::withMessages(['campo1' => $errorMessage]);
            }
        }

        $productosAdicionalDef = ProductosAdicionalDef::create($request->all());
        // $select = UtilesController::traerParamValor("pro_adic_tipo_id_select");
        if ($request->j_tabla != "{}") {
            $datosTabla = json_decode($request->input('j_tabla'), true);
            foreach($datosTabla as $item){
                $valores = new ProductosAdicionalDefSelect;
                $valores->productos_adicionales_def_id = $productosAdicionalDef->id;
                $valores->productos_id = $request->productos_id;
                $valores->descripcion = $item['descripcion'];
                $valores->precio = $item['precio'];
                $valores->costo = $item['costo'];
                $valores->save();
            }
        }

        // return redirect()->route('ProductosAdicionalDef.index')
        //     ->with('success', 'Productos Adicional created successfully.');
        return back()
            ->with('success', 'Productos Adicional created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productosAdicionalDef = ProductosAdicionalDef::find($id);

        return view('productos-adicional-def.show', compact('productosAdicionalDef'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $productosAdicionalDef = ProductosAdicionalDef::find($id);
        // $adic_tipo = Parametro::where('campo', 'prod_adic_tipo')->get();
        $adic_tipo = UtilesController::traerParamValores( 'prod_adic_tipo');
        // $productos = Producto::all();
        $productosAdicionalVal = ProductosAdicionalDefSelect::where('productos_adicionales_def_id' , $id)->get();
        $productosAdicionalDef->valores = $productosAdicionalVal;
        //return view('productos-adicional-def.edit', compact('productosAdicionalDef', 'adic_tipo', 'productos'));
        
        return (response()->json($productosAdicionalDef));
        // return Response::json($productosAdicionalDef);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProductosAdicionalDef $productosAdicionalDef
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate(ProductosAdicionalDef::$rules);
        $productosAdicionalDef = ProductosAdicionalDef::find($id);
        $productosAdicionalDef->update($request->all());
        if ($request->j_tabla != "{}") {
            $datosTabla = json_decode($request->input('j_tabla'), true);
            foreach($datosTabla as $item){
                if ($item["id"] == "") {
                    $valores = new ProductosAdicionalDefSelect;
                    $valores->productos_adicionales_def_id = $productosAdicionalDef->id;
                    $valores->productos_id = $request->productos_id;
                    $valores->descripcion = $item['descripcion'];
                    $valores->precio = $item['precio'];
                    $valores->costo = $item['costo'];
                    $valores->save();
                }
            }
        }

        // return redirect()->route('ProductosAdicionalDef.index')
        //     ->with('success', 'ProductosAdicionalDef updated successfully');
        return back()
            ->with('success', 'Productos Adicional updated successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $productosAdicionalDef = ProductosAdicionalDef::find($id)->delete();

        // return redirect()->route('ProductosAdicionalDef.index')
        //     ->with('success', 'ProductosAdicionalDef deleted successfully');

        return back()
            ->withInput()
            ->with('success', 'ProductosAdicionalDef deleted successfully');
    }
}
