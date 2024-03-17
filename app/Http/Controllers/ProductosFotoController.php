<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\ProductosFoto;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductosFotoController
 * @package App\Http\Controllers
 */
class ProductosFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $productos_id)
    {
        $productosFotos = ProductosFoto::where("productos_id", $productos_id)->paginate();

        return view('productos-foto.index', compact('productosFotos', 'productos_id'))
            ->with('i', (request()->input('page', 1) - 1) * $productosFotos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $productos_id)
    {
        $productos = Producto::find($productos_id);
        $productosFoto = new ProductosFoto();
        $productos_fotos = ProductosFoto::where("productos_id", $productos_id)->paginate();

        return view('productos-foto.create', compact('productosFoto', 'productos_fotos', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ProductosFoto::$rules);

        $productosFoto = new ProductosFoto;
        if($request->hasFile('path')){
            $originalName = $request->file('path')->getClientOriginalName();
            $path = $originalName;
            $path = Storage::disk('productos')->put("", $request->file('path'));
            $productosFoto->path = $path;
            $productosFoto->principal = isset($request->principal) ? 1 : 0;
            $productosFoto->productos_id = $request->productos_id;

            $productosFoto->save();
        }

        // return redirect()->route('productos.fotos.create', $request->productos_id)
        //     ->with('success', 'ProductosFoto created successfully.');
        return back()
            ->with('success', 'Productos Photo updated successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productosFoto = ProductosFoto::find($id);

        return view('productos-foto.show', compact('productosFoto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productosFoto = ProductosFoto::find($id);

        return view('productos-foto.edit', compact('productosFoto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProductosFoto $productosFoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductosFoto $productosFoto)
    {
        request()->validate(ProductosFoto::$rules);

        $productosFoto->update($request->all());

        return redirect()->route('productos.fotos.index')
            ->with('success', 'ProductosFoto updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id, $productos_id)
    {
        $productosFoto = ProductosFoto::find($id)->delete();

        // return redirect()->route('productos.fotos.create', $productos_id)
        //     ->with('success', 'ProductosFoto deleted successfully');
        return back()
        ->with('success', 'Productos Photo deleted successfully.');
    }
}
