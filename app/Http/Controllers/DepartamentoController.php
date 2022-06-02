<?php

namespace App\Http\Controllers;

use App\DataTables\DepartamentoDataTable;
use App\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Departamentos']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DepartamentoDataTable $dataTable)
    {
        return $dataTable->render('departamento.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departamento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['nombre'=>'required|string|max:255|unique:departamentos,id,']);
        $dep=Departamento::create($request->all());
        $request->session()->flash('success',$dep->nombre.' ingresado exitosamente');
        return redirect()->route('departamento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
       
        try {
            DB::beginTransaction();
            $departamento->delete();
            DB::commit();
            request()->session()->flash('success','Categoría eliminado');
        } catch (\Exception $th) {
            request()->session()->flash('error',$departamento->nombre. ' no eliminado');
            DB::rollback();
        }
        return redirect()->route('departamento.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        return view('departamento.edit',['dep'=>$departamento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
        $request->validate([
            'nombre'=>'required|string|max:255|unique:departamentos,nombre,'.$departamento->id
        ]);
        $departamento->nombre=$request->nombre;
        $departamento->save();
        $request->session()->flash('success',$departamento->nombre.' actualizado exitosamente');
        return redirect()->route('departamento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        //
    }
}
