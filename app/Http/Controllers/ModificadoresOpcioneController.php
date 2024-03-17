<?php

namespace App\Http\Controllers;

use App\Models\ModificadoresOpcione;
use App\Models\ModificadoresTipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Class ModificadoresOpcioneController
 * @package App\Http\Controllers
 */
class ModificadoresOpcioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modificadoresOpciones = ModificadoresOpcione::v_modificadoresOpciones()->paginate();

        return view('modificadores-opcione.index', compact('modificadoresOpciones'))
            ->with('i', (request()->input('page', 1) - 1) * $modificadoresOpciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = ModificadoresTipo::get();
        $modificadoresOpcione = new ModificadoresOpcione();
        return view('modificadores-opcione.create', compact('modificadoresOpcione', 'tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ModificadoresOpcione::$rules);

        $modificadoresOpcione = ModificadoresOpcione::create($request->all());

        return back()
            ->with('success', 'Modificadores option created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modificadoresOpcione = ModificadoresOpcione::find($id);

        return view('modificadores-opcione.show', compact('modificadoresOpcione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modificadoresOpcione = ModificadoresOpcione::find($id);

        return (response()->json($modificadoresOpcione));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ModificadoresOpcione $modificadoresOpcione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate(ModificadoresOpcione::$rules);
        $modificadoresOpcione = ModificadoresOpcione::find($id);
        $modificadoresOpcione->update($request->all());

        return back()
            ->with('success', 'Modificadores option updated successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $modificadoresOpcione = ModificadoresOpcione::find($id)->delete();

        return back()
            ->with('success', 'Modificadores Option deleted successfully.');
    }

    public function lista($tipo_id)
    {
        $tipoid = $tipo_id;
        $opciones = ModificadoresOpcione::where('modif_tipos_id', $tipoid)->get();
        // $resu = json_encode($opciones);

        return Response::json($opciones);
    }
}
