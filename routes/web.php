<?php

use App\Models\Producto;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $data = array('productos' => Producto::where('cantidad','>','0')->take(8)->get());
    return view('welcome',$data);
})->name('welcome');

Route::get('/carrito-productos/{idcat?}', 'CarritoController@productos')->name('carrito.productos');


// CARRITO DE COMPRAS
Route::get('/carrito-detalle/{id}', 'CarritoController@detalle')->name('carrito.detalle');
Route::get('/carrito-carro', 'CarritoController@carro')->name('carrito.carro');
Route::get('/carrito-verificar', 'CarritoController@verificar')->name('carrito.verificar');
Route::post('/carrito-realizarpedido', 'CarritoController@realizarpedido')->name('carrito.realizarpedido');



Route::get('/producto-info/{id}', function($id){
    return $id;
})->name('productoInfo');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/mi-perfil', 'HomeController@miPerfil')->name('miPerfil');
    Route::post('/actualizar-mi-perfil', 'HomeController@actualizarMiPerfil')->name('actualizarMiPerfil');
    
    // departamento
    Route::resource('departamento', 'DepartamentoController');
    
    // empresa
    Route::get('/empresa', 'EmpresaController@index')->name('empresa');
    Route::post('/empresa-actualizar', 'EmpresaController@actualizar')->name('actualizarEmpresa');

    // usuarios
    Route::get('/usuarios', 'Usuarios@index')->name('usuarios');
    Route::get('/usuarios-nuevo', 'Usuarios@nuevo')->name('nuevoUsuario');
    Route::post('/usuarios-guardar', 'Usuarios@guardar')->name('guardarUsuario');
    Route::get('/usuarios-editar/{user}', 'Usuarios@editar')->name('editarUsuario');
    Route::post('/usuarios-actualizar', 'Usuarios@actualizar')->name('actualizarUsuario');
    Route::get('/usuarios-eliminar/{user}', 'Usuarios@eliminar')->name('eliminarUsuario');
    Route::get('/usuarios-asignar-roles/{user}', 'Usuarios@asignarRoles')->name('asignarRolUsuario');
    Route::post('/usuarios-actualizar-roles', 'Usuarios@actualizarRoles')->name('actualizarRolesUsuario');


    Route::namespace('Almacen')->group(function () {

        // categorias
        Route::get('/categorias', 'Categorias@index')->name('categorias');
        Route::get('/categorias-nuevo', 'Categorias@nuevo')->name('nuevoCategoria');
        Route::post('/categorias-guardar', 'Categorias@guardar')->name('guardarCategoria');
        Route::get('/categorias-editar/{id}', 'Categorias@editar')->name('editarCategoria');
        Route::post('/categorias-actualizar', 'Categorias@actualizar')->name('actualizarCategoria');
        Route::get('/categorias-eliminar/{id}', 'Categorias@eliminar')->name('eliminarCategoria');
        Route::get('/categorias-x-producto/{id}', 'Categorias@productos')->name('categoriaXproducto');
        

        // productos
        Route::get('/productos/{idcat?}', 'Productos@index')->name('productos');
        Route::get('/productos-nuevo', 'Productos@nuevo')->name('nuevoProducto');
        Route::post('/productos-guardar', 'Productos@guardar')->name('guardarProducto');
        Route::get('/productos-editar/{id}', 'Productos@editar')->name('editarProducto');
        Route::post('/productos-actualizar', 'Productos@actualizar')->name('actualizarProducto');
        Route::get('/productos-eliminar/{id}', 'Productos@eliminar')->name('eliminarProducto');
        Route::post('/productos-duplicar', 'Productos@duplicar')->name('duplicarProducto');
        Route::get('/productos-buscar', 'Productos@buscar')->name('buscarProducto');
        

    });

    Route::namespace('Ventas')->group(function () {
        // ventas
        Route::get('/facturas/{tipo}', 'Facturas@index')->name('facturas');
        Route::get('/facturas-nuevo/{tipo}', 'Facturas@nuevo')->name('nuevaFactura');
        Route::post('/facturas-guardar', 'Facturas@guardar')->name('guardarFactura');
        Route::get('/facturas-imprimir/{id}', 'Facturas@imprimir')->name('imprimirFactura');
        Route::get('/facturas-ver/{id}', 'Facturas@ver')->name('verFactura');
        Route::post('/facturas-estado', 'Facturas@estado')->name('estadoFactura');
        Route::get('/facturas-buscar-fecha-a-fecha', 'Facturas@buscarFechaFecha')->name('buscarFechaFechaFactura');
        Route::post('/facturas-buscar-cliente', 'Facturas@buscarCliente')->name('buscarCliente');
        
        
    });


    Route::namespace('Sistema')->group(function () {
        // roles
        Route::get('/roles', 'Roles@index')->name('roles');
        Route::post('/roles-guardar', 'Roles@guardar')->name('guardarRol');
        Route::get('/roles-eliminar/{id}', 'Roles@eliminar')->name('eliminarRol');
        // permisos
        Route::get('/permisos/{idRol}', 'Permisos@index')->name('permisos');
        Route::post('/permisos-sincronizar', 'Permisos@sincronizar')->name('sincronizarPermiso');
    });

    
    
});
