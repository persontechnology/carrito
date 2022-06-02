@extends('layouts.app',['title'=>'Bienvenido'])
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')


<!-- Blocks with chart -->
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex pb-1">
                <div>
                    <span class="card-title font-weight-semibold">Total usuarios</span>
                    <h1 class="font-weight-bold text-info mb-0">{{ $totalUser }}</h1>
                </div>
            </div>

        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex pb-1">
                <div>
                    <span class="card-title font-weight-semibold">Total Categorías</span>
                    <h1 class="font-weight-bold text-danger mb-0">{{ $totalCategoria }}</h1>
                </div>
            </div>
        </div>
    </div>
        
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex pb-1">
                <div>
                    <span class="card-title font-weight-semibold">Total productos</span>
                    <h2 class="font-weight-bold text-success mb-0"> {{ $totalProducto }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /blocks with chart -->


<!-- Sales by country -->
<div class="card">
    <div class="card-header">
        <h6 class="card-title font-weight-semibold">Total facturas $.</h6>
    </div>

    <div class="card-body">
        <div class="row">
            

            <div class="col-xl-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center justify-content-sm-center mb-3">
                            <span class="bg-pink-100 text-pink line-height-1 rounded p-2 mr-3">
                                <i class="icon-cart top-0"></i>
                            </span>
                            <div>
                                <h6 class="font-weight-bold mb-0">$ {{ $totalFacturasIngresosEntregados }}</h6>
                                <span class="text-muted">Total facturas ingresos entregados</span>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center justify-content-sm-center mb-3">
                            <span class="bg-pink-100 text-pink line-height-1 rounded p-2 mr-3">
                                <i class="icon-cart top-0"></i>
                            </span>
                            <div>
                                <h6 class="font-weight-bold mb-0">$ {{ $totalFacturasIngresosAnulados }}</h6>
                                <span class="text-muted">Total facturas ingresos anulados</span>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center justify-content-sm-center mb-3">
                            <span class="bg-teal-100 text-teal line-height-1 rounded p-2 mr-3">
                                <i class="icon-cash3 top-0"></i>
                            </span>
                            <div>
                                <h6 class="font-weight-bold mb-0">$ {{ $totalFacturasSalidasEntregados }}</h6>
                                <span class="text-muted">Total facturas salidas entregados</span>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center justify-content-sm-center mb-3">
                            <span class="bg-teal-100 text-teal line-height-1 rounded p-2 mr-3">
                                <i class="icon-cash3 top-0"></i>
                            </span>
                            <div>
                                <h6 class="font-weight-bold mb-0">$ {{ $totalFacturasSalidasAnulados }}</h6>
                                <span class="text-muted">Total facturas salidas anulados</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="chart-container">
                    {{-- <div class="chart" id="progress_bar_sorted" style="height: 333px;"></div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /sales by country -->


<!-- Latest orders -->
<div class="card">
    <div class="card-header d-flex py-0">
        <h6 class="card-title font-weight-semibold py-3">Productos que estan por agotarse con cantidad menor a 10</h6>
    
    </div>

    <div class="table-responsive border-top-0">
        <table class="table text-nowrap">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio compra</th>
                    <th>Precio venta</th>
                    <th>Cantidad</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($productosCaducar as $pc)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            @if (Storage::exists($pc->foto))
                                <a href="{{ route('editarProducto',$pc->id) }}" class="mr-3">
                                    <img src="{{ Storage::url($pc->foto) }}" class="rounded-circle" width="32" height="32" alt="">
                                </a>    
                            @endif
                            

                            <div>
                                <a href="{{ route('editarProducto',$pc->id) }}" class="text-body font-weight-semibold">{{ $pc->nombre }}</a>
                                <div class="text-muted font-size-sm">{{ $pc->codigo }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $pc->precio_compra }}
                    </td>
                    <td>
                        {{ $pc->precio_venta }}
                    </td>
                    <td><span class="badge badge-success-100 text-success">{{ $pc->cantidad }}</span></td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- /latest orders -->




@push('linksCabeza')
    {{-- <script src="{{ asset('global_assets/js/demo_charts/pages/dashboard_6/light/area_gradient.js') }}"></script> --}}
@endpush

@prepend('linksPie')
    <script>
    $('#menuInicio').addClass('active');
    </script>
    
@endprepend

@endsection
