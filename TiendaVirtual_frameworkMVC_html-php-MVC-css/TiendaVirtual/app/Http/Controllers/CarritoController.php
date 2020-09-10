<?php

namespace App\Http\Controllers;

use App\CarritoModel;
use Illuminate\Http\Request;
use App;
use Carbon\Carbon;
use SebastianBergmann\Environment\Console;

class CarritoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * encargado de guardarme los productos comprados
     * por el cliente con su id 
     */
    public function cargarId($id)
    {
        $fecha = Carbon::now();
        $pro = App\ProductoModel::where('id', $id)->get();
        $ins = new App\CarritoModel;
        $ins->id_Log = auth()->user()->id;
        $ins->id_Pro = $id;
        $ins->nombre = $pro[0]->nombre;
        $ins->cant = 1;
        $ins->monto = $pro[0]->precio * 1;
        $ins->compra = false;
        $ins->fecha = $fecha;
        $ins->save();
        return redirect()->back();
    }

    /**
     * método encargado de cargarme los productos a los usuarios
     * el id que recibo como parametro identifica la categoria 
     * del producto que el quiere
     */
    public function cargarPro()
    {
        $idLog = auth()->user()->id;
        $producto = App\CarritoModel::where('id_Log', $idLog)->Where('compra', false)->get()->sortBy('nombre');
        $total = App\CarritoModel::where('id_Log', $idLog)->Where('compra', false)->sum('monto');
        return view('modal', compact('producto'), compact('total'));
    }

    /**
     * encargado de eliminar productos de los productos que
     * el cliente tiene selecionados para comprarlo en el carrito
     */
    public function eliminarProSel($id)
    {
        $eliminarPro = App\CarritoModel::FindOrFail($id);
        $eliminarPro->delete();
        return redirect('cargarPro');
    }

    /**
     * encargado de restar el stock a los productos
     * que ya fueron comprados por el cliente 
     */
    public function productoComprado()
    {
        $idLog = auth()->user()->id;
        $producto = App\CarritoModel::where('id_Log', $idLog)->Where('compra', false)->get();

        foreach ($producto as $pro) {
            $insPro = App\ProductoModel::where('id', $pro->id_Pro)->get()[0];
            $insPro->stock -= 1;
            $insPro->update();
        }

        App\CarritoModel::where('id_Log', $idLog)->Where('compra', false)->update(array('compra' => true));
        return redirect('cliente');
    }
}
