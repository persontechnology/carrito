@extends('layouts.cli',['title'=>'Carro'])
@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">CARRITO DE COMPRAS</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('welcome') }}">Inicio</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Carrito de compras</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Productos</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Quitar</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="tableProductos">
                        
                        
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Código promocional">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Aplicar cupón</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Resumen de la compra</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium total_c"></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Transporte</h6>
                            <h6 class="font-weight-medium">$0</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold total_c"></h5>
                        </div>
                        
                        <a href="{{ route('carrito.verificar') }}" class="btn btn-block btn-primary my-3 py-3">Pasar por la caja</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Cart End -->

    @push('scriptsPie')
        <script>
            
               function dibujarTabla(){
                $('#tableProductos').html('')
                var fila='';
                var total_c=0;
                    productos.forEach(function(p, index) {
                        fila+=` <tr>
                            <td class="align-middle">
                                <img src="img/product-1.jpg" alt="" style="width: 50px;"> 
                                ${p.nombre??p.id}
                            </td>
                            <td class="align-middle">$${p.precio}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" onclick="restar('${p.id}','${p.cantidad}','${p.precio}','${p.nombre}')">
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" readonly class="form-control form-control-sm bg-secondary text-center" value="${p.cantidad}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus" onclick="addmas('${p.id}','${p.cantidad}','${p.precio}','${p.nombre}')">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">$${(p.precio*p.cantidad).toFixed(2)}</td>
                            <td class="align-middle"><button class="btn btn-sm btn-primary" onclick="quitarFila(${p.id})"><i class="fa fa-times"></i></button></td>
                        </tr>
                        `;
                        total_c=total_c+(p.precio*p.cantidad);
                    });

                $('.total_c').html('$'+total_c.toFixed(2))
                $('#tableProductos').append(fila)
               }
               dibujarTabla();

               function quitarFila(id){
                    remove(id);
               }

               function addmas(id,ca,pre,nom){
                   add(id,1,pre,nom)
               }
               function restar(id,ca,pre,nom){
                   if(ca>1){
                    menorar(id,1,pre,nom)
                   }
                
               }
            
        </script>

        @if (Session::has('success'))
            <script>
                productos=[];
                localStorage.removeItem('productos');
                dibujarTabla();
                contadorCarrito()
            </script>    
        @endif

    @endpush
@endsection