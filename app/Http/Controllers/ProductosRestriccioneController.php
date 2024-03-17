<?php

namespace App\Http\Controllers;

use App\Models\ProductosRestriccione;
use Illuminate\Http\Request;

/**
 * Class ProductosRestriccioneController
 * @package App\Http\Controllers
 */
class ProductosRestriccioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productosRestricciones = ProductosRestriccione::paginate();

        return view('productos-restriccione.index', compact('productosRestricciones'))
            ->with('i', (request()->input('page', 1) - 1) * $productosRestricciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productosRestriccione = new ProductosRestriccione();
        return view('productos-restriccione.create', compact('productosRestriccione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ProductosRestriccione::$rules);

        $productosRestriccione = ProductosRestriccione::create($request->all());

        return back()
            ->with('success', 'Restriction created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productosRestriccione = ProductosRestriccione::find($id);

        return view('productos-restriccione.show', compact('productosRestriccione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productosRestriccione = ProductosRestriccione::find($id);

        return view('productos-restriccione.edit', compact('productosRestriccione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProductosRestriccione $productosRestriccione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productosRestriccione)
    {
        request()->validate(ProductosRestriccione::$rules);

        $productosRestriccione = ProductosRestriccione::where("id", $productosRestriccione)->first();
        $productosRestriccione->update($request->all());

        return back()
            ->with('success', 'Restriction updated successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $productosRestriccione = ProductosRestriccione::find($id)->delete();

        return back()
            ->with('success', 'Restriction deleted successfully.');
    }
}
