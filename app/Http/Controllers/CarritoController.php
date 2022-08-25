<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Configuracion;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\Producto;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CarritoController extends Controller
{
    public function detalle($id)
    {
        $p=Producto::findOrFail($id);
        return view('carrito.detalle',['p'=>$p]);
    }


    public function carro()
    {
        return view('carrito.carro');
    }

    public function verificar()
    {
        return view('carrito.verificar');
    }

    public function realizarpedido(Request $request)
    {
        $validator=$request->validate([
            'apellidos' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'telefono' => 'required|digits:10',
            'direccion' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'id'=>'required|array',
            'cantidad'=>'required|array',
            'id.*'=>'required|exists:productos,id',
            'cantidad.*'=>'required|numeric|gt:0',
            'payment'=>'required'
        ]);
        
        if(Auth::check()){
            $user=Auth::user();
        }else{
            $user=$this->verificarUsuario($request);
        }

        try {
            DB::beginTransaction();
            $ultimaFactura=Factura::where('tipo','Salida')->latest()->first();

            $factura=new Factura();
            $factura->numero=$ultimaFactura?($ultimaFactura->numero+1):1;
            $factura->forma_pago=$request->payment;
            $factura->observacion=$request->observacion;
            $factura->iva=Configuracion::first()->iva??12;
            $factura->cliente_id=$user->id;
            $factura->estado='Solicitado';
            $factura->tipo='Salida';
            
            $factura->save();

            

            $calculo_descuento=0;
            foreach ($request->id as $pro) {
                $p=Producto::find($pro);

                $df=new FacturaDetalle();
                $df->cantidad=$request->cantidad[$pro];
                $df->descripcion=$p->nombre;
                $df->valor_unitario=$p->precio_venta;
                $df->factura_id=$factura->id;
                $df->producto_id=$pro;
                
                $calculo_descuento+=$p->precio_venta*$request->cantidad[$pro];
                $df->descuento=0;

                $df->save();
            }

            $factura->total_factura=$calculo_descuento;
            
            $factura->save();
            DB::commit();
            
            $request->session()->flash('success','Pedido realizado exitosamente');
            // envie un correo
            // si no hay usuario ,enviar un email infoermacodo sus credenciales de acceso para segumiento d el a ocmra
            // estra pemdienete a su emial #
            
            return redirect()->route('carrito.carro')->withErrors($validator)->withInput();
        } catch (\Throwable $th) {   
            DB::rollback();
            $request->session()->flash('info','Ocurrio un error, porfavor vuelva intentar.'.$th->getMessage());
            return redirect()->route('carrito.verificar');
        }
        
        
    }

    public function verificarUsuario($request)
    {
        $user=User::where('email',$request->email)->first();
        if(!$user){
            $user=new User();
            $user->apellidos=$request->apellidos;
            $user->nombres=$request->nombres;
            $user->telefono=$request->telefono;
            $user->direccion=$request->direccion;
            $user->email=$request->email;
            $user->password=Hash::make(Str::random(10));
            $user->save();
        }
        return $user;
    }


    public function productos($idcat=null)
    {
        if(isset($idcat)){
            $categoria=Categoria::find($idcat);
            $data = array(
                'productos' => $categoria->productos
            );
        }else{
            $data = array('productos' => Producto::all() );
        }
        return view('carrito.productos',$data);
    }
    
}
