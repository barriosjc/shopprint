<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Descuento;
use App\Models\Producto;
use Illuminate\Http\Request;

/**
 * Class DescuentoController
 * @package App\Http\Controllers
 */
class DescuentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $descuentos = Descuento::v_descuentos()->paginate();

        return view('descuento.index', compact('descuentos'))
            ->with('i', (request()->input('page', 1) - 1) * $descuentos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $descuento = new Descuento();
        $clientes = cliente::get();
        $categorias = Categoria::get();
        $productos = Producto::get();

        return view('descuento.create', compact('descuento', 'clientes', 'categorias', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
            'cupon' => 'nullable|alpha_num|size:6',
            'porcentaje' => 'required|integer|between:1,100',
            'prioridad' => 'required|integer|between:1,10',
            'vigencia_desde' => 'required|date',
            'vigencia_hasta' => 'required|date|after_or_equal:vigencia_desde',
            'clientes_id' => 'nullable',
            'categorias_id' => 'nullable',
            'productos_id' => 'nullable',
            ]);
        $validated['users_id'] = Auth()->user()->id;
    // dd($validated);
        $descuento = Descuento::create($validated);

        return redirect()->route('descuentos.index')
            ->with('success', 'Descuento created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $descuento = Descuento::find($id);

        return view('descuento.show', compact('descuento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $descuento = Descuento::find($id);

        return view('descuento.edit', compact('descuento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Descuento $descuento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Descuento $descuento)
    {
        request()->validate(Descuento::$rules);

        $descuento->update($request->all());

        return redirect()->route('descuentos.index')
            ->with('success', 'Descuento updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $descuento = Descuento::find($id)->delete();

        return redirect()->route('descuentos.index')
            ->with('success', 'Descuento deleted successfully');
    }
}
