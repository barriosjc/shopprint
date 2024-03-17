<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductosAdicionalDef;
use App\Models\ProductosAdicionalDefSelect;

/**
 * Class ProductosAdicionalDefSelectController
 * @package App\Http\Controllers
 */
class ProductosAdicionalDefSelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productosAdicionalDefSelects = ProductosAdicionalDefSelect::v_ProductosAdicionalDefSelect()
            ->paginate();

        return view('productos-adicional-def-select.index', compact('productosAdicionalDefSelects'))
            ->with('i', (request()->input('page', 1) - 1) * $productosAdicionalDefSelects->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productosAdicionalDef = ProductosAdicionalDef::get();
        $productosAdicionalDefSelect = new ProductosAdicionalDefSelect();

        return view('productos-adicional-def-select.create', compact('productosAdicionalDefSelect', 'productosAdicionalDef'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ProductosAdicionalDefSelect::$rules);
        $numeros = explode('|', $request->productos_adicionales_def_id);
        $productos_adicionales_def_id = $numeros[0]; 
        $productos_id = $numeros[1]; 
        $productosAdicionalDefSelect = new ProductosAdicionalDefSelect;
        $productosAdicionalDefSelect->productos_adicionales_def_id = $productos_adicionales_def_id;
        $productosAdicionalDefSelect->productos_id = $productos_id;
        $productosAdicionalDefSelect->descripcion = $request->descripcion;
        $productosAdicionalDefSelect->costo = $request->descripcion;
        $productosAdicionalDefSelect->precio = $request->descripcion;
        $productosAdicionalDefSelect->save();

        return redirect()->route('ProductosAdicionalDefSelect.index')
            ->with('success', 'ProductosAdicionalDefSelect created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productosAdicionalDefSelect = ProductosAdicionalDefSelect::find($id);

        return view('productos-adicional-def-select.show', compact('productosAdicionalDefSelect'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productosAdicionalDefSelect = ProductosAdicionalDefSelect::find($id);

        return view('productos-adicional-def-select.edit', compact('productosAdicionalDefSelect'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProductosAdicionalDefSelect $productosAdicionalDefSelect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductosAdicionalDefSelect $productosAdicionalDefSelect)
    {
        request()->validate(ProductosAdicionalDefSelect::$rules);
        $productosAdicionalDefSelect->update($request->all());

        return redirect()->route('ProductosAdicionalDefSelect.inicio')
            ->with('success', 'ProductosAdicionalDefSelect updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $productosAdicionalDefSelect = ProductosAdicionalDefSelect::find($id)->delete();

        // return redirect()->route('ProductosAdicionalDefSelect.inicio')
        //     ->with('success', 'ProductosAdicionalDefSelect deleted successfully');
        return back()
        ->with('success', 'Values deleted successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function borrar($id)
    {
        $productosAdicionalDefSelect = ProductosAdicionalDefSelect::find($id)->delete();

        // return redirect()->route('ProductosAdicionalDefSelect.inicio')
        //     ->with('success', 'ProductosAdicionalDefSelect deleted successfully');
        return back()
        ->with('success', 'Values deleted successfully.');
    }
}
