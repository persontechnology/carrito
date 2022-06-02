@extends('layouts.cli',['title'=>'Verificar'])
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">VERIFICAR</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('home') }}">Inicio</a></p>
                <p class="m-0 px-2">/</p>
                <p class="m-0"><a href="{{ route('carrito.carro') }}">Carrito de compras</a></p>
                <p class="m-0 px-2">/</p>
                <p class="m-0">Verificar</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <form action="{{ route('carrito.realizarpedido') }}" method="post">
        @csrf
        <div class="container-fluid pt-5">
            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Dirección de Envio</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="nombres">Primer nombre</label>
                                <input id="nombres" class="form-control @error('nombres') is-invalid @enderror" name="nombres" value="{{ old('nombres',Auth::user()->nombres??'')  }}" type="text" placeholder="John" required>
                                @error('nombres')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="apellidos">Apellido</label>
                                <input id="apellidos" class="form-control @error('apellidos') is-invalid @enderror" type="text" name="apellidos" value="{{ old('apellidos',Auth::user()->apellidos??'')  }}" placeholder="Doe" required>
                                @error('apellidos')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="email">Correo electrónico</label>
                                <input id="email" class="form-control @error('email') is-invalid @enderror" type="text" placeholder="example@email.com" name="email" value="{{ old('email',Auth::user()->email??'')  }}" required>
                                @error('email')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="telefono">Mobile No</label> 
                                <input id="telefono" class="form-control @error('telefono') is-invalid @enderror" type="text" name="telefono" value="{{ old('telefono', Auth::user()->telefono??'')  }}" placeholder="+123 456 789" required>
                                @error('telefono')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="direccion">Dirección Línea 1</label>
                                <input id="direccion" class="form-control @error('direccion') is-invalid @enderror" type="text" name="direccion" value="{{ old('direccion', Auth::user()->direccion??'')  }}" placeholder="123 Street" required>
                                @error('direccion')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            
                        
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-4">
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Total del pedido</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="font-weight-medium mb-3">Productos</h5>
                            <div id="productosTabla">

                            </div>
                            <hr class="mt-0">
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
                        </div>
                    </div>
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Pago</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="paypal" value="Paypal" {{ old('payment')=='Paypal'?'checked':'' }} required>
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="directcheck" value="Contra entrega" {{ old('payment')=='Contra entrega'?'checked':'' }} required>
                                    <label class="custom-control-label" for="directcheck">Contra entrega</label>
                                </div>
                            </div>
                            <div class="">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="banktransfer" value="Transferencia Bancaria" {{ old('payment')=='Transferencia Bancaria'?'checked':'' }} required>
                                    <label class="custom-control-label" for="banktransfer">Transferencia bancaria</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Realizar pedido</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Checkout End -->
    

    @push('scriptsPie')
        <script>
               function dibujarTabla(){
                $('#productosTabla').html('')
                var fila='';
                var total_c=0;
                    productos.forEach(function(p, index) {
                        fila+=` <div class="d-flex justify-content-between">
                                    <input type="hidden" name="id[${p.id}]" value="${p.id}" required class="form-control">
                                    <input type="hidden" name="cantidad[${p.id}]" value="${p.cantidad}" required class="form-control">
                                    <p>${p.nombre}</p>
                                    <p>$${(p.precio*p.cantidad).toFixed(2)}</p>
                                </div>
                        `;
                        total_c=total_c+(p.precio*p.cantidad);
                    });

                $('.total_c').html('$'+total_c.toFixed(2))
                $('#productosTabla').append(fila)
               }
               dibujarTabla();

            
        </script>
    @endpush
@endsection