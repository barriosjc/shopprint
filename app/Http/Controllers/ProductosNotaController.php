<?php

namespace App\Http\Controllers;

use App\Models\ProductosNota;
use Illuminate\Http\Request;

/**
 * Class ProductosNotaController
 * @package App\Http\Controllers
 */
class ProductosNotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productosNotas = ProductosNota::paginate();

        return view('productos-nota.index', compact('productosNotas'))
            ->with('i', (request()->input('page', 1) - 1) * $productosNotas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productosNota = new ProductosNota();
        return view('productos-nota.create', compact('productosNota'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ProductosNota::$rules);

        $productosNota = ProductosNota::create($request->all());

        return back()
            ->with('success', 'Note created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productosNota = ProductosNota::find($id);

        return view('productos-nota.show', compact('productosNota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productosNota = ProductosNota::find($id);

        return view('productos-nota.edit', compact('productosNota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProductosNota $productosNota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productosNota)
    {
        request()->validate(ProductosNota::$rules);

        $productosNota = ProductosNota::where("id", $productosNota)->first();
        $productosNota->update($request->all());

        return back()
            ->with('success', 'Note updated successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $productosNota = ProductosNota::find($id)->delete();

        return back()
            ->with('success', 'Note deleted successfully.');
    }
}
