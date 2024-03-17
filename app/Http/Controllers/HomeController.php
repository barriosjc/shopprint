<?php

namespace App\Http\Controllers;

use App\Models\Descuento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRole('clientes')) {

            $descuentos = UtilesController::traeDescuentos('categorias_id');

            return view('layouts.inicial', compact('descuentos'));
        }else {
            //return view('layouts.inicial-back');
           return redirect()->route('orders.list','all');
        }
    }

    public function maquetado($nombre)
    {
        $activo = "open";
        $valores = ['cant_open' =>0,'cant_open' =>0,'cant_history' =>0,'cant_tickets' =>0];
        return view('maquetado/'.$nombre, compact('activo', 'valores'));
        
    }
}
