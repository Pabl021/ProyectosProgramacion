<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * encargado de mostrame todas las categorias a un select
     * para que el admin pueda crear su producto y asignarle
     * de una vez su categoria
     */
    public function index()
    {
        $categoria = App\CategoriaModel::All();
        return view('crearProducto', compact('categoria'));
    }

    /**
     * me carga la informacion en tablas para que el admin pueda manipular esa info
     * que tenga derecho a editar, eliminar dicha información de producto.
     */
    public function index1()
    { //carga vista manipular producto
        $info = App\ProductoModel::All();
        return view('manipularPro', compact('info'));
    }

    /**
     * encargado de insertar los productos creados en su respectiva 
     * base de datos y de una vez antes de se realiza la validación de los
    inputs
     */
    public function insertarPro(Request $producto)
    {

        $producto->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required',
            'stock' => 'required|numeric',
            'precio' => 'required|numeric',
        ]);

        $ruta = Storage::disk('public')->put('Producto', $producto->file('imagen'));

        $pro = new App\ProductoModel;
        $pro->nombre = $producto->nombre;
        $pro->descripcion = $producto->descripcion;
        $pro->imagen =  $ruta;
        $pro->codigo_categoria = $producto->codigo_categoria;
        $pro->stock = $producto->stock;
        $pro->precio = $producto->precio;
        $pro->save();
        return redirect('crearPro')->with('guardado', 'Producto creado con éxito');
    }

    /**
     * encargado de eliminarme los productos de la base de datos
     * dependiendo del que el seleccione
     */
    public function eliminarPro($id)
    {
        $eliminarPro = App\ProductoModel::FindOrFail($id);
        $eliminarPro->delete();
        return redirect('manipularPro')->with('guardado', 'Producto eliminado exitosamente');
    }

    /**
     * me carga la info en el formalario del producto
     * seleccionado para editar.
     */
    public function editarPro($id) //carga datos
    {
        $categoria = App\CategoriaModel::All();
        $editar = App\ProductoModel::FindOrFail($id);
        return view('actualizarPro', compact('editar'), compact('categoria'));
    }

    /**
     * encargado de editarme los datos del producto que se selecciono y le valido
     * igual los campos antes de guardar
     */
    public function editarProducto(Request $datos) //me edita definitivo los datos
    {
        $datos->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required',
            'stock' => 'required',
            'precio' => 'required',

        ]);
        $ruta = Storage::disk('public')->put('Producto', $datos->file('imagen'));
        $ruta2 = asset($ruta);
        $insPro = App\ProductoModel::FindOrFail($datos->id);
        $insPro->nombre = $datos->nombre;
        $insPro->descripcion = $datos->descripcion;
        $insPro->imagen = $ruta2;
        $insPro->codigo_categoria = $datos->codigo_categoria;
        $insPro->stock = $datos->stock;
        $insPro->precio = $datos->precio;
        $insPro->update();
        return redirect('manipularPro')->with('guardado', 'Producto editado exitosamente');
    }
}
