<?php

namespace App\Http\Controllers;

use App\Models\Categoria;

use App\Models\Factura;
use App\Models\Producto;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $data = array(
            'totalUser' => User::count(),
            'totalCategoria'=>Categoria::count(),
            'totalProducto'=>Producto::count(),

            'totalFacturasIngresosEntregados'=>Factura::where('tipo','Ingreso')->where('estado','Entregado')->sum('total_factura'),
            'totalFacturasSalidasEntregados'=>Factura::where('tipo','Salida')->where('estado','Entregado')->sum('total_factura'),
            
            'totalFacturasIngresosAnulados'=>Factura::where('tipo','Ingreso')->where('estado','Anulado')->sum('total_factura'),
            'totalFacturasSalidasAnulados'=>Factura::where('tipo','Salida')->where('estado','Anulado')->sum('total_factura'),
            'productosCaducar'=>Producto::where('cantidad','<',10)->orderBy('cantidad','desc')->get()->take(50)
        );
        return view('home',$data);
    }


    public function miPerfil()
    {
        $data = array('user' => Auth::user() );
        return view('auth.miPerfil',$data);
    }

    public function actualizarMiPerfil(Request $request)
    {
        $request->validate([
            'apellidos' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'password_actual' => 'nullable|string|min:8',
            'password' => 'nullable|string|min:8|confirmed',
            'identificacion' => 'required|max:255|unique:users,identificacion,'.Auth::id(),
        ]);
        $user=Auth::user();
        $user->apellidos=$request->apellidos;
        $user->nombres=$request->nombres;
        $user->telefono=$request->telefono;
        $user->direccion=$request->direccion;
        $user->identificacion=$request->identificacion;

        if($request->password){
            if(Hash::check($request->password_actual,$user->password)){
                $user->password=Hash::make($request->password);
            }else{
                $request->session()->flash('info','Contraseña actual incorrecta');
                return redirect()->route('miPerfil')->withInput();        
            }
        }

        $user->save();
        $request->session()->flash('success','Perfil actualizado exitosamente');
        return redirect()->route('miPerfil');

    }

    
}
