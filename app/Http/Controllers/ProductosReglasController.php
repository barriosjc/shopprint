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
