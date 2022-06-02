<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Configuracion;
class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Empresa']);
    }
    public function index()
    {
        $data = array('empresa' => Configuracion::first());
        return view('almacen.empresa.index',$data);
    }
    public function actualizar(Request $request)
    {
        try {
            DB::beginTransaction();
            $emp=Configuracion::findOrFail($request->id);
            $emp->iva=$request->iva;
            $emp->empresa=$request->empresa;
            $emp->descripcion=$request->descripcion;
            $emp->ruc=$request->ruc;
            $emp->telefono=$request->telefono;
            $emp->celular=$request->celular;
            $emp->direccion=$request->direccion;
            $emp->email=$request->email;
            $emp->save();

            if ($request->hasFile('foto')) {
                if ($request->file('foto')->isValid()) {
                    Storage::delete($emp->foto);
                    $extension = $request->foto->extension();
                    $path = Storage::putFileAs(
                        'public/empresa', $request->file('foto'), $emp->id.'.'.$extension
                    );
                    $emp->foto=$path;
                    $emp->save();
                }
            }
            DB::commit();
            $request->session()->flash('success',$emp->empresa.' actualizado exitosamente');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Empresa no actualizado');
        }
        return redirect()->route('empresa');
    }
}
