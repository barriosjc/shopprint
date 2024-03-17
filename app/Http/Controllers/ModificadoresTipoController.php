<?php

namespace App\Http\Controllers;

use App\Models\ModificadoresTipo;
use App\Models\Producto;
use Illuminate\Http\Request;

/**
 * Class ModificadoresTipoController
 * @package App\Http\Controllers
 */
class ModificadoresTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modificadoresTipos = ModificadoresTipo::v_modificadoresTipos()->paginate();

        return view('modificadores-tipo.index', compact('modificadoresTipos'))
            ->with('i', (request()->input('page', 1) - 1) * $modificadoresTipos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::get();
        $modificadoresTipo = new ModificadoresTipo();
        return view('modificadores-tipo.create', compact('modificadoresTipo', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ModificadoresTipo::$rules);
        $request->merge(['descripcion' => $request->tipos_descripcion]);

        $modificadoresTipo = ModificadoresTipo::create($request->all());

        // return redirect()->route('tipos.index')
        //     ->with('success', 'ModificadoresTipo created successfully.');
    
        return back()
            ->with('success', 'ModificadoresTipo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modificadoresTipo = ModificadoresTipo::find($id);

        return view('modificadores-tipo.show', compact('modificadoresTipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $productos = Producto::get();
        $modificadoresTipo = ModificadoresTipo::find($id);
        // return view('modificadores-tipo.edit', compact('modificadoresTipo', 'productos'));
        return (response()->json($modificadoresTipo));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ModificadoresTipo $modificadoresTipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate(ModificadoresTipo::$rules);
        $request->merge(['descripcion' => $request->tipos_descripcion]);
        $modificadoresTipo = ModificadoresTipo::find($id);
        $modificadoresTipo->update($request->all());

        return back()
            ->with('success', 'Modificadores Tipo updated successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $modificadoresTipo = ModificadoresTipo::find($id)->delete();

        return back()
            ->with('success', 'Modificadores Tipo deleted successfully.');
    }
}
