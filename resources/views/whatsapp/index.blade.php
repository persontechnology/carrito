@extends('layouts.app',['title'=>'Mensajería WhatsApp'])
@section('breadcrumbs', Breadcrumbs::render('whatsapp'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Nuevo producto
                </div>

                <div class="card-body">
                    <form action="{{ route('whatsappEnviar') }}" method="POST" id="formWhatsApp">
                        @csrf

                        @if (count($usuarios)>0)
                            <label for="usuarios" class="mb-0">Selecione usuarios<i class="text-danger">*</i></label>
                            <select class="selectpicker show-tick" data-live-search="true" required data-width="100%" name="usuarios[]" id="usuarios" title="Selecione usuarios" multiple data-selected-text-format="count > 5" data-style="btn btn-warning text-dark" data-size="5" data-actions-box="true">
                                
                                @foreach ($usuarios as $user)
                                    <option data-subtext="{{$user->identificacion}}" data-tokens="{{ $user->identificacion }}" value="{{ $user->id }}" {{ (collect(old('usuarios'))->contains($user->id)) ? 'selected':'' }}>{{ $user->apellidos }} {{ $user->nombres }}</option>
                                @endforeach
                            </select>

                        @else
                            <div class="alert alert-dark" role="alert">
                                <strong>No existe usuarios</strong>
                            </div>
                        @endif



                        @if (count($productos)>0)
                            <label for="productos" class="mb-0">Selecione productos</label>
                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="productos[]" id="productos" title="Selecione productos" multiple data-selected-text-format="count > 5" data-style="btn btn-success text-dark" data-size="5" data-actions-box="true">
                                
                                @foreach ($productos as $pro)
                                    <option data-subtext="{{$pro->codigo}}" data-tokens="{{ $pro->codigo }}" value="{{ $pro->id }}" {{ (collect(old('productos'))->contains($pro->id)) ? 'selected':'' }}>{{ $pro->nombre }}</option>
                                @endforeach
                            </select>

                        @else
                            <div class="alert alert-dark" role="alert">
                                <strong>No existe productos</strong>
                            </div>
                        @endif


                        <div class="form-row">
                            <div class="col">
                                <div class="md-form md-outline my-1">
                                    <textarea id="descripcion" name="descripcion" class="md-textarea form-control @error('descripcion') is-invalid @enderror" required>{{ old('descripcion') }}</textarea>
                                    <label for="descripcion">Descripción del mensaje<i class="text-danger">*</i></label>
                                    @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <!-- Sign up button -->
                        <button class="btn btn-primary my-2 btn-block" type="submit">Guardar</button>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('linksCabeza')
<link rel="stylesheet" href="{{ asset('js/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
<script src="{{ asset('js/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-select-1.13.9/dist/js/i18n/defaults-es_ES.min.js') }}"></script>
{{-- block --}}
<script src="{{ asset('js/jquery.blockUI.js') }}"></script>

@endpush

@prepend('linksPie')
    <script>
    $('#whatsapp').addClass('active');
    
    $('#formWhatsApp').submit(function(e){
        e.preventDefault();
        var form = $(this);
        $.blockUI({ message: '<i class="fas fa-spinner fa-spin"></i> Solo un momento ...' });
        $.ajax({
            url: form.attr("action"),
            type: form.attr("method"),
            data: form.serialize(),
            success:function(data){                              
                if(data.success){
                    $.notify(data.success, "success");
                    $("#formWhatsApp")[0].reset();
                    $('.selectpicker').selectpicker('refresh');
                }

                if(data.error){
                    $.notify(data.error, "error");
                }

                
            },
            complete:function(){
                $.unblockUI();
            },
            error: function (data,err) {
                
                $("#listaErrores").html('');
                $("#alertaErrores").show();
                var errores='';
                var datAux = data.responseJSON;
                $.each(datAux.errors, function() {
                    $.each(this, function(k, v) {
                        errores+= v;
                    });
                });

                if (errores) {
                    $.notify(errores, "error");
                }else if (err) {
                    $.notify(err, "error");
                }
            }
        });
    }); 

    </script>
@endprepend
@endsection
