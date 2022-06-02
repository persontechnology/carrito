@extends('layouts.cli',['title'=>'Detalle'])
@section('content')
      <!-- Page Header Start -->
      <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">DETALLE DE LA TIENDA</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('welcome') }}">Inicio</a></p>
                <p class="m-0 px-2">/</p>
                <p class="m-0"><a href="{{ route('welcome') }}">Productos</a></p>
                <p class="m-0 px-2">/</p>
                <p class="m-0">Detalle de la tienda</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
     <!-- Shop Detail Start -->
     <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            @if (Storage::exists($p->foto))
                                <img class="w-100 h-100" src="{{ Storage::url($p->foto) }}" alt="Image">
                            @else
                                <img class="w-100 h-100" src="{{ asset('img/venta.svg') }}" alt="Image">
                            @endif
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $p->nombre }}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">({{ $p->cantidad }} cantidades disponibles)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">${{ $p->precio_venta }}</h3>
                <p class="mb-4">
                    {{ $p->descripcion }}
                </p>
                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Talla: {{ $p->talla }}</p>
                    
                </div>
                <div class="d-flex mb-4">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Color: {{ $p->color }}</p>
                </div>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus" >
                            <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center"  id="cantidad" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-primary px-3" onclick="anadiralcarrito(this)"><i class="fa fa-shopping-cart mr-1"></i> Añadir al carrito</button>
                </div>
                
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Descripción del producto</h4>
                    <p>
                        {{ $p->descripcion }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    @push('scripts')
        <script>
            function anadiralcarrito(){
                var ca=$('#cantidad').val();
                var id="{{ $p->id }}";
                var precio="{{ $p->precio_venta }}";
                var nombre="{{ $p->nombre }}"
                add(id,ca,precio,nombre);
            }
        </script>
    @endpush
@endsection