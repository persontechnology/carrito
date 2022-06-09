<?php

namespace App\Http\Controllers\Almacen;

use App\DataTables\CategoriasDataTable;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Categorias extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Cuentas']);
    }
    
    public function index(CategoriasDataTable $dataTable)
    {
        return $dataTable->render('almacen.categorias.index');
    }

    public function nuevo()
    {
        return view('almacen.categorias.nuevo');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre'=>'required|string|max:255|unique:categorias,nombre',
            'detalle'=>'nullable|string|max:255',
            'codigo'=>'nullable|string|max:255',
        ]);

        $categoria=new Categoria();
        $categoria->nombre=$request->nombre;
        $categoria->detalle=$request->detalle;
        $categoria->codigo=$request->codigo;
        $categoria->save();
        $request->session()->flash('success',$categoria->nombre.' ingresado exitosamente');
        return redirect()->route('categorias');
    }

    public function editar($idCat)
    {
        $cat=Categoria::findOrFail($idCat);
        $data = array('cat' => $cat );
        return view('almacen.categorias.editar',$data);
    }
    
    public function actualizar(Request $request)
    {
        $request->validate([
            'id'=>'required|exists:categorias,id',
            'nombre'=>'required|string|max:255|unique:categorias,nombre,'.$request->id,
            'detalle'=>'nullable|string|max:255',
            'codigo'=>'nullable|string|max:255',
        ]);
        $cat=Categoria::findOrFail($request->id);
        $cat->nombre=$request->nombre;
        $cat->detalle=$request->detalle;
        $cat->codigo=$request->codigo;
        $cat->save();
        $request->session()->flash('success',$cat->nombre.' actualizado exitosamente');
        return redirect()->route('categorias');
    }

    public function eliminar(Request $request, $idCat)
    {
        $cat=Categoria::findOrFail($idCat);
        try {
            DB::beginTransaction();
            $cat->delete();
            DB::commit();
            $request->session()->flash('success','Categoría eliminado');
        } catch (\Exception $th) {
            $request->session()->flash('error',$cat->nombre. ' no eliminado');
            DB::rollback();
        }
        return redirect()->route('categorias');

    }
}
