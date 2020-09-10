<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\ProductoModel;

class CategoriaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * encargado de mandar a mostrar la vista de categoria 
     */
    public function index()
    {
        return view('categoria');
    }

    /**
     * me carga la vista de manipular las categorias
      para que este pueda eliminar, editar o crear
     */
    public function index1()
    {
        $objeto = App\CategoriaModel::All();
        return view('manipularCat', compact('objeto'));
    }

    /**
     * me valida el input de insertar la categoria que no vaya vacio.
     * ya luego me captura los datos y me los guarda en la base de datos.
     */
    public function insertarCategoria(Request $datos)
    {

        $datos->validate([
            'categoria' => 'required'
        ]);
        $insCat = new App\CategoriaModel;
        $insCat->nombre = $datos->categoria;
        $insCat->save();
        return redirect('home')->with('guardado', 'Categoría creada exitosamente');
    }

    /**
     * encargado de eliminarme la categoria que este selecciona
     * eso si, me valida si la categoria no pertenece a algun producto.
     */
    public function eliminarCat($id)
    {
        $verificar = ProductoModel::where('codigo_categoria', $id)->get();
        if (count($verificar) < 1) {
            $eliminarCat = App\CategoriaModel::FindOrFail($id);
            $eliminarCat->delete();
            return redirect('manipular')->with('guardado', 'Categoría eliminada exitosamente');
        }
        return redirect('manipular')->with('noGuardado', 'No se puede eliminar la categoría porque tiene un producto asociado');
    }

    /**
     * me carga los datos que se van a editar en el formulario.
     */
    public function editarCat($id) //carga datos
    {
        $editar = App\CategoriaModel::FindOrFail($id);
        return view('actualizarCat', compact('editar'));
    }

    /**
     * me edita los datos que este decide cambiar y lo modifica en la base de datos.
     */
    public function editarCategoria(Request $datos) //me edita definitivo los datos
    {
        $datos->validate([
            'categoria' => 'required'
        ]);
        $insCat = App\CategoriaModel::FindOrFail($datos->id);
        $insCat->nombre = $datos->categoria;
        $insCat->update();
        return redirect('manipular')->with('guardado', 'Categoría editada exitosamente');
    }
}
