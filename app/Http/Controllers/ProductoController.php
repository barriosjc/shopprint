<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Descuento;
use App\Models\Parametro;
use Illuminate\Http\Request;
use App\Models\ProductosFoto;
use App\Models\ProductosNota;
use App\Models\ModificadoresTipo;
use App\Models\ProductosAdicionalDef;
use App\Models\ProductosRestriccione;
use App\Models\productos_adicional_val;
use App\Models\ProductosAdicionalDefSelect;

/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producto = new Producto();
        $perPage = $producto->perPage;
        $productos = Producto::withTrashed()->simplePaginate($perPage);
               
        return view('producto.index', compact('productos'))
            ->with('i', (request()->input('page', 1) - 1) * $perPage);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = new Producto();
        $categorias = Categoria::get();
        $restricciones = ProductosRestriccione::get();
        $adic_tipo = [];
        $notas = ProductosNota::get();
        $tipos = [];
        $productos_fotos = [];
        $productos_adicional_def = []; 
        $productos_adicional_def_select = []; 
        $productos_adicional_val = [];

        return view('producto.create',  compact('producto', 'restricciones', 'adic_tipo', 'notas', 'tipos', 'productos_fotos',
        'categorias', 'productos_adicional_def', 'productos_adicional_def_select', 'productos_adicional_val'));
               
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Producto::$rules);
        $producto = new Producto;
        $producto->categorias_id = $request->categorias_id;
        $producto->nombre = $request->nombre;
        $producto->orden = $request->orden;
        $producto->detalle = $request->detalle;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->destacado = isset($request->destacado) ? 1 : 0;
        $producto->restricciones_id = isset($request->restricciones_id) ? $request->restricciones_id : null;
        $producto->notas_id = isset($request->notas_id) ? $request->notas_id : null;
        $producto->save();

        // if (isset($request->adic)) {
        //     foreach ($request->adic as $key => $valor) {
        //         $adicional  = new productos_adicional_val;
        //         $adicional->productos_id = $producto->id;
        //         $adicional->adicional_descripcion = $key;
        //         $adicional->adicional_valor = $valor;
        //         $adicional->save();
        //     }
        // }


        return redirect()->route('productos.edit', $producto->id)
            ->with('success', 'Success !!!. Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        $categoria = Categoria::find($producto->categorias_id);

        return view('producto.show', compact('producto', 'categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $categorias = Categoria::get();
        $restricciones = ProductosRestriccione::get();
        $notas = ProductosNota::get();
        $tipos = ModificadoresTipo::where("productos_id", $id)->get();
        $productos_adicional_def = ProductosAdicionalDef::where('productos_id', $id)->get();

        $adic_tipo = Parametro::where('campo', 'prod_adic_tipo')->get();
        $productos_adicional_def_select = [];
        // $productos_adicional_def_select = ProductosAdicionalDefSelect::where('productos_id', $id)->get();
        $productos_adicional_val = productos_adicional_val::where('productos_id', $id)->get();
        $productos_fotos = ProductosFoto::where("productos_id", $id)->get();

        return view('producto.edit', compact('producto', 'restricciones', 'adic_tipo', 'notas', 'tipos', 'productos_fotos',
                'categorias', 'productos_adicional_def', 'productos_adicional_def_select', 'productos_adicional_val'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $categorias_id = $producto->categorias_id;
        request()->validate(Producto::$rules);

        $producto->categorias_id = $request->categorias_id;
        $producto->nombre = $request->nombre;
        $producto->orden = $request->orden;
        $producto->detalle = trim($request->detalle);
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->destacado = isset($request->destacado) ? 1 : 0;
        $producto->restricciones_id = isset($request->restricciones_id) ? $request->restricciones_id : null;
        $producto->notas_id = isset($request->notas_id) ? $request->notas_id : null;
        $producto->save();

        $productsToDelete = productos_adicional_val::where('productos_id', $producto->id)->get();
        foreach ($productsToDelete as $product) {
            $product->delete();
        }
        if (isset($request->adic)) {
            foreach ($request->adic as $key => $valor) {
                $adicional  = new productos_adicional_val;
                $adicional->productos_id = $producto->id;
                $adicional->adicional_descripcion = $key;
                $adicional->adicional_valor = $valor;
                $adicional->save();
            }
        }

        return redirect()->route('productos.index', $categorias_id)
            ->with('success', 'Producto updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        // $productsToDelete = productos_adicional_val::where('productos_id', $id)->get();
        // foreach ($productsToDelete as $product) {
        //     $product->delete();
        // }
        $producto = Producto::find($id);
        $categorias_id = $producto->categorias_id;
        $producto->delete();

        return redirect()->route('productos.index', $categorias_id)
            ->with('success', 'Producto deleted successfully');
    }

    public function restart($id)
    {
        $producto = Producto::withTrashed()->find($id);
        $categorias_id = $producto->categorias_id;
        $producto->restore();

        return redirect()->route('productos.index', $categorias_id)
            ->with('success', 'Producto restored successfully');
    }

    private function generateSlug($text, $text2)
    {
        // Convertir a minúsculas
        $text = strtolower($text);
        $text2 = strtolower($text2);
        $text = $text . ' ' . $text2;
        // Reemplazar caracteres especiales y espacios por guiones
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);

        // Eliminar guiones al principio y al final
        $text = trim($text, '-');

        return $text;
    }

    public function list($id)
    {
        $resu = false;
        $categoria = Categoria::find($id);
        if($categoria) {
            $categoria = $categoria->descripcion;
            $productos = Producto::v_listado('categorias_id', $id)->get();
            if($productos) {
                $resu = true;
            }
        }

        if (!$resu) {
            return back()->with('error_msg', 'No hay productos cargados para la categoria!');
        }
        $descuentos = UtilesController::traeDescuentos('categorias_id');
        $desc_prod = UtilesController::traeDescuentos('productos_id');

        return view('producto.front_list', compact('productos', 'categoria', 'descuentos', 'desc_prod'));
    }

    public function detalle($id)
    {
        // $producto = Producto::v_producto($id)->first();
        // $categorias = Categoria::find($producto->categorias_id);
        // $descuentos = Descuento::get();
        // $productos_adicional_def = ProductosAdicionalDef::where('productos_id', $id)->get();
        // //$productos_adicional_val = productos_adicional_val::where('productos_id', $id)->get();
        // $productos_adicional_def_select = ProductosAdicionalDefSelect::where('productos_id', $id)->get();
        // $productos_fotos = ProductosFoto::where('productos_id', $id)->get();
        // $tipos = ModificadoresTipo::where('productos_id',$id)->get();
        // $opciones= [];

        // return view('producto.front_detail', compact(
        //     'producto',
        //     'descuentos',
        //     'categorias',
        //     'productos_adicional_def',
        //     'productos_adicional_def_select',
        //     'productos_fotos',
        //     'tipos',
        //     'opciones'
        // ));

        return view('producto.front_detail', compact('id'));
    }
}
