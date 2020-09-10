<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;

class ClienteController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
   }

   /**
    * me carga los productos que el cliente desea escoger, dependiendo del valor 
    * que el select contenga, con base a ese id me carga los datos.
    */
   public function index(Request $dato)
   {
      $idCat = intval($dato->input('select'));
      $producto = App\ProductoModel::where('codigo_categoria', $idCat)->get();
      $info = App\CategoriaModel::All();

      return view('cliente', compact('info', 'producto'));
   }

   /**
    * le carga al cliente las estadisticas de este, total de productos comprados
      el total que ha gastado y los datos de la categoria esto dependiendo del que este logueado
    */
   public function estadistica()
   {
      $idLog = auth()->user()->id;
      $totPro = App\CarritoModel::where('id_Log', $idLog)->Where('compra', true)->get();
      $precioPro = App\CarritoModel::where('id_Log', $idLog)->Where('compra', true)->sum('monto');
      $info = App\CategoriaModel::All();
      return view('estadisticasC', compact('info', 'totPro', 'precioPro'));
   }

   /**
    * me muestra los datos de la orden de compra
      dependiendo de la fecha que el usuario digite, este me
      muestra todos los productos de esa fecha y su total.
    */
   public function ordenCompra(Request $datos)
   {
      $info = App\CategoriaModel::All();

      $fecha = date($datos->input('fecha'));
      $idLog = auth()->user()->id;
      $producto = App\CarritoModel::where('fecha', $fecha)->where('id_Log', $idLog)->where('compra', true)->get();
      $total = App\CarritoModel::where('fecha', $fecha)->where('id_Log', $idLog)->where('compra', true)->sum('monto');
      return view('ordenCompra', compact('info', 'producto', 'total'));
   }
}
