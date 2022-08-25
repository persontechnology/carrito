@extends('layouts.cli',['title'=>'Productos'])
@section('content')
      <!-- Page Header Start -->
      <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">NUESTRA TIENDA</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('welcome') }}">Inicio</a></p>
                <p class="m-0 px-2">/</p>
                <p class="m-0"><a href="{{ route('carrito.productos') }}">Productos</a></p>
                <p class="m-0 px-2">/</p>
                <p class="m-0">Detalle de la tienda</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Productos Trandy EDITAR FREDDDY</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($productos as $prot)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                          @if (Storage::exists($prot->foto))
                              <img class="img-fluid w-100" src="{{ Storage::url($prot->foto) }}" alt="Image">
                          @else
                              <img class="img-fluid w-100" src="{{ asset('img/venta.svg') }}" alt="Image">
                          @endif  
                          
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $prot->nombre }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>${{ $prot->precio_venta }}</h6>
                                <h6 class="text-muted ml-2"><del>{{ $prot->precio_venta + 5 }}</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{ route('carrito.detalle',$prot->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Ver detalle</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Añadir al carrito</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- Products End -->
@endsection