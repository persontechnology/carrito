@extends('layouts.app',['title'=>'Editar Empresa'])
@section('breadcrumbs', Breadcrumbs::render('empresa'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Información de empresa
                </div>

                <div class="card-body">
                    <form action="{{ route('actualizarEmpresa') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $empresa->id }}">

                        <div class="md-form md-outline my-1">
                            <input type="text" id="empresa" name="empresa" class="form-control @error('empresa') is-invalid @enderror " value="{{ old('empresa',$empresa->empresa) }}" required>
                            <label for="empresa">Empresa<i class="text-danger">*</i></label>
                            @error('empresa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form md-outline my-1">
                                    <input id="ruc" name="ruc" class="form-control @error('ruc') is-invalid @enderror" value="{{ old('ruc',$empresa->ruc) }}"  required  type="number">
                                    <label for="ruc">Ruc<i class="text-danger">*</i></label>
                                    @error('ruc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form md-outline my-1">
                                    <input id="iva" name="iva" class="form-control @error('iva') is-invalid @enderror" value="{{ old('iva',$empresa->iva) }}" type="number" required>
                                    <label for="iva">iva<i class="text-danger">*</i></label>
                                    @error('iva')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form md-outline my-1">
                                    <input id="telefono" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono',$empresa->telefono) }}"  required  type="number">
                                    <label for="telefono">Teléfono<i class="text-danger">*</i></label>
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form md-outline my-1">
                                    <input id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$empresa->email) }}" required type="email">
                                    <label for="email">Email<i class="text-danger">*</i></label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form md-outline my-1">
                                    <input id="celular" name="celular" class="form-control @error('celular') is-invalid @enderror" value="{{ old('celular',$empresa->celular) }}"  required  type="number">
                                    <label for="celular">Celular<i class="text-danger">*</i></label>
                                    @error('celular')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form md-outline my-1">
                                    <input id="direccion" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion',$empresa->direccion) }}" required type="text">
                                    <label for="direccion">Dirección<i class="text-danger">*</i></label>
                                    @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form md-outline my-1">
                                    <textarea id="descripcion" name="descripcion" class="md-textarea form-control @error('descripcion') is-invalid @enderror" required>{{ old('descripcion',$empresa->descripcion) }}</textarea>
                                    <label for="descripcion">Descripción<i class="text-danger">*</i></label>
                                    @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mt-1">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="foto" aria-describedby="foto" name="foto">
                                      <label class="custom-file-label" for="foto">Selecione foto</label>
                                    </div>
                                </div>

                                @if (Storage::exists($empresa->foto))
                                    <a href="{{ Storage::url($empresa->foto) }}" class="test-popup-link">
                                        <img src="{{ Storage::url($empresa->foto) }}" alt="" width="30" height="20"> ver Imagén
                                    </a>
                                @endif
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
{{-- imager --}}
<link rel="stylesheet" href="{{ asset('js/Magnific-Popup/dist/magnific-popup.css') }}">
<script src="{{ asset('js/Magnific-Popup/dist/jquery.magnific-popup.min.js') }}"></script>
@endpush

@prepend('linksPie')
    <script>
    
    $('#empresa').addClass('active');
    $('.test-popup-link').magnificPopup({
        type: 'image'
    });
    </script>
@endprepend
@endsection
