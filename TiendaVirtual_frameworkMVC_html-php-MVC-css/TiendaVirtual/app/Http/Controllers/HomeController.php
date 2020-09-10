<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

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
     * encargado de mostrarle al admin todos los datos de os productos
     * vendidos, cuanto dinero a generado y todos los clientes que se 
     * encuentran registrados
     */
    public function index()
    {
        $idLog = auth()->user()->id;
        $cantPro = App\CarritoModel::Where('compra', true)->get();
        $total = App\CarritoModel::Where('compra', true)->sum('monto');
        $user = App\User::All();

        return view('home', compact('user', 'total', 'cantPro'));
    }
}
