<?php

namespace App\Http\Controllers;

use App\Models\FormasPago;
use Illuminate\Http\Request;

/**
 * Class FormasPagoController
 * @package App\Http\Controllers
 */
class FormasPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formasPagos = FormasPago::paginate();

        return view('formas-pago.index', compact('formasPagos'))
            ->with('i', (request()->input('page', 1) - 1) * $formasPagos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formasPago = new FormasPago();
        return view('formas-pago.create', compact('formasPago'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(FormasPago::$rules);

        $formasPago = FormasPago::create($request->all());

        return redirect()->route('formas_pagos.index')
            ->with('success', 'FormasPago created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $formasPago = FormasPago::find($id);

        return view('formas-pago.show', compact('formasPago'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $formasPago = FormasPago::find($id);

        return view('formas-pago.edit', compact('formasPago'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  FormasPago $formasPago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormasPago $formasPago)
    {
        request()->validate(FormasPago::$rules);

        $formasPago->update($request->all());

        return redirect()->route('formas_pagos.index')
            ->with('success', 'FormasPago updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $formasPago = FormasPago::find($id)->delete();

        return redirect()->route('formas_pagos.index')
            ->with('success', 'FormasPago deleted successfully');
    }
}
