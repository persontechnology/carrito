@extends('layouts.app',['title'=>'Detalle de factura'])
@section('breadcrumbs', Breadcrumbs::render('verFactura',$factura))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" onchange="cambiarEstado(this);" data-url="{{ route('estadoFactura') }}" name="estado" data-estado="Entregado" id="Entregado" value="{{ $factura->id }}" {{ $factura->estado=='Entregado'?'checked':'' }}>
                        <label class="form-check-label" for="Entregado">Entregado</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" onchange="cambiarEstado(this);" data-url="{{ route('estadoFactura') }}" name="estado" data-estado="Anulado" id="Anulado" value="{{ $factura->id }}" {{ $factura->estado=='Anulado'?'checked':'' }}>
                        <label class="form-check-label" for="Anulado">Anulado</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" onchange="cambiarEstado(this);" data-url="{{ route('estadoFactura') }}" name="estado" data-estado="Solicitado" id="Solicitado" value="{{ $factura->id }}" {{ $factura->estado=='Solicitado'?'checked':'' }}>
                        <label class="form-check-label" for="Solicitado">Solicitado</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" onchange="cambiarEstado(this);" data-url="{{ route('estadoFactura') }}" name="estado" data-estado="Rechazado" id="Rechazado" value="{{ $factura->id }}" {{ $factura->estado=='Rechazado'?'checked':'' }}>
                        <label class="form-check-label" for="Rechazado">Rechazado</label>
                    </div>

                    <a role="button" onclick="imprimirFactura(this);" class="float-right" data-url="{{ route('imprimirFactura',$factura->id) }}" data-toggle="tooltip" data-placement="top" data-title="Imprimir {{ $factura->tipo }}">
                        <i class="fas fa-print"></i>
                    </a>
                    
                </div>

                <div class="card-body">
                    <div>
                        @include('ventas.facturas.detalle',['factura'=>$factura])
                    </div>
                    <div class="card-footer text-muted">
                        @if ($factura->observacion)
                            <strong>Observación de la {{ $facturta->tipo }}: </strong>{{ $factura->observacion }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Central Modal Small -->
<div class="modal fade" id="modalFactura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">
            <strong id="tituloFactura">IMPRIMIR FACTURA</strong>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" id="contenedorFactura" src="" allowfullscreen></iframe>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
        </div>
    </div>
    </div>
</div>
<!-- Central Modal Small -->


@push('linksCabeza')

{{-- block --}}
<script src="{{ asset('js/jquery.blockUI.js') }}"></script>

@endpush

@prepend('linksPie')
    <script>
    @if($factura->tipo==='Ingreso')
    $('#facturasIngreso').addClass('active');
    @else
    $('#facturasSalida').addClass('active');
    @endif

    function imprimirFactura(arg){
        $('#modalFactura').modal('show');
        $('#contenedorFactura').attr('src',$(arg).data('url'));
        $('#tituloFactura').html($(arg).data('title'));
    }

    function cambiarEstado(arg){
        var id=$(arg).val();
        var estado=$(arg).data('estado');
        
        var url=$(arg).data('url');
        
        $.blockUI({message:'<h1>Espere por favor.!</h1>'});
        $.post( url, { id,estado })
        .done(function( data ) {
            console.log(data)
            if(data.success){
                $.notify(data.success,"success");
            }
            if(data.error){
                $.notify(data.error,"error");
            }
            
        }).always(function(){
            $.unblockUI();
        }).fail(function(){
            $.notify("Ocurrio un error, porfavor vuelva intentar","error");
        });

    }



    </script>

@endprepend



@endsection
