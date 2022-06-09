@extends('layouts.app',['title'=>'Editar Producto'])
@section('breadcrumbs', Breadcrumbs::render('editarProducto',$pro))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar producto
                </div>

                <div class="card-body">
                    <form action="{{ route('actualizarProducto') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $pro->id }}">

                        
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="md-form md-outline my-1">
                                    <input type="text" id="codigo" name="codigo" class="form-control @error('codigo') is-invalid @enderror " value="{{ old('codigo',$pro->codigo) }}" required>
                                    <label for="codigo">Código MF<i class="text-danger">*</i></label>
                                    @error('codigo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form md-outline my-1">
                                    <input type="text" id="codigo_cc" name="codigo_cc" class="form-control @error('codigo_cc') is-invalid @enderror " value="{{ old('codigo_cc',$pro->codigo_cc) }}" required>
                                    <label for="codigo_cc">Código CC<i class="text-danger">*</i></label>
                                    @error('codigo_cc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                       


                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="md-form md-outline my-1">
                                    <input id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre',$pro->nombre) }}"  required  type="text">
                                    <label for="nombre">Nombre<i class="text-danger">*</i></label>
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form md-outline my-1">
                                    <input id="cantidad" name="cantidad" class="form-control @error('cantidad') is-invalid @enderror" value="{{ old('cantidad',$pro->cantidad) }}" type="text" required>
                                    <label for="cantidad">Cantidad<i class="text-danger">*</i></label>
                                    @error('cantidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="md-form md-outline my-1">
                                    <input id="precio_compra" name="precio_compra" class="form-control @error('precio_compra') is-invalid @enderror" value="{{ old('precio_compra',$pro->precio_compra) }}"  required  type="text">
                                    <label for="precio_compra">Precio de compra<i class="text-danger">*</i></label>
                                    @error('precio_compra')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="md-form md-outline my-1">
                                    <input id="precio_venta" name="precio_venta" class="form-control @error('precio_venta') is-invalid @enderror" value="{{ old('precio_venta',$pro->precio_venta) }}" required type="text">
                                    <label for="precio_venta">Precio de venta<i class="text-danger">*</i></label>
                                    @error('precio_venta')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="md-form md-outline my-1">
                                    <input id="talla" name="talla" class="form-control @error('talla') is-invalid @enderror" value="{{ old('talla',$pro->talla) }}"  required  type="text">
                                    <label for="talla">Unidad de medida<i class="text-danger">*</i></label>
                                    @error('talla')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md">
                                @if (count($categorias)>0)
                                    <label for="categoria" class="mb-0">Selecione cuenta contable</label>
                                    <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="categoria" id="categoria" title="Selecione una cuenta">
                                        
                                        @foreach ($categorias as $cat)
                                            <option value="{{ $cat->id }}" {{ old('categoria',$pro->categoria->id??'')==$cat->id?'selected':'' }} >{{ $cat->nombre }}-{{ $cat->codigo }}</option>
                                        @endforeach
                                    </select>

                                @else
                                    <div class="alert alert-dark" role="alert">
                                        <strong>No existe cuenta</strong>
                                    </div>
                                @endif
                                
                            </div>
                            <div class="col-md">
                                @if (count($categorias)>0)
                                    <label for="categoria_dos" class="mb-0">Selecione cuenta contable salida</label>
                                    <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="categoria_dos" id="categoria_dos" title="Selecione una cuenta">
                                        
                                        @foreach ($categorias as $cat)
                                            <option value="{{ $cat->id }}" {{ old('categoria_dos',$pro->categoria_dos->id??'')==$cat->id?'selected':'' }} >{{ $cat->nombre }}</option>
                                        @endforeach
                                    </select>

                                @else
                                    <div class="alert alert-dark" role="alert">
                                        <strong>No existe categorías</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                       


                        {{-- <div class="form-row">
                            
                            <div class="col-md-6">
                                <div class="md-form md-outline my-1">
                                    <input id="color" name="color" class="form-control @error('color') is-invalid @enderror" value="{{ old('color') }}" required type="text">
                                    <label for="color">Color<i class="text-danger">*</i></label>
                                    @error('color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div> --}}


                        <div class="form-row">
                            {{-- <div class="col-md-4">
                                <div class="md-form md-outline my-1">
                                    <input id="cuenta_contable" name="cuenta_contable" class="form-control @error('cuenta_contable') is-invalid @enderror" value="{{ old('cuenta_contable') }}"  required  type="text">
                                    <label for="cuenta_contable">Cuenta contable</label>
                                    @error('cuenta_contable')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="md-form md-outline my-1">
                                    <input id="cuenta_salida" name="cuenta_salida" class="form-control @error('cuenta_salida') is-invalid @enderror" value="{{ old('cuenta_salida') }}" required type="text">
                                    <label for="cuenta_salida">Cuenta salida</label>
                                    @error('cuenta_salida')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-md-4">
                                

                                <div class="custom-control custom-checkbox my-2">
                                    <input type="checkbox" {{ isset($pro->incluye_iva)?'checked':'' }}   class="custom-control-input @error('incluye_iva') is-invalid @enderror" name="incluye_iva" id="defaultLoginFormRemember">
                                    <label class="custom-control-label" for="defaultLoginFormRemember">Incluye IVA</label>
                                    @error('incluye_iva')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        {{-- <div class="form-row">
                            <div class="col-md-6">
                                <div class="md-form md-outline my-1">
                                    <textarea id="descripcion" name="descripcion" class="md-textarea form-control @error('descripcion') is-invalid @enderror" required>{{ old('descripcion') }}</textarea>
                                    <label for="descripcion">Descripcion<i class="text-danger">*</i></label>
                                    @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mt-1">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="foto" aria-describedby="foto" name="foto">
                                      <label class="custom-file-label" for="foto">Selecione foto</label>
                                    </div>
                                  </div>
                            </div>
                        </div> --}}



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

@endpush

@prepend('linksPie')
    <script>
    $('#almacen').addClass('active');
    $('#productos').addClass('active');
    </script>
@endprepend
@endsection
