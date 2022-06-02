@extends('layouts.app',['title'=>'Editar Usuario'])
@section('breadcrumbs', Breadcrumbs::render('editarUsuario',$user))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar usuario
                </div>

                <div class="card-body">
                    <form action="{{ route('actualizarUsuario') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">

                        @if (count($departamentos)>0)
                            <label for="departamento" class="mb-0">Selecione un departamento</label>
                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="departamento" id="departamento" title="Selecione un departamento">
                                <option value="">Sin departamento</option>
                                @foreach ($departamentos as $cat)
                                    <option value="{{ $cat->id }}" {{ old('departamento',$user->departamento->id??'')==$cat->id?'selected':'' }} >{{ $cat->nombre }}</option>
                                @endforeach
                            </select>

                        @else
                            <div class="alert alert-dark" role="alert">
                                <strong>No existe departamentos</strong>
                            </div>
                        @endif


                        <div class="md-form md-outline my-1">
                            <input type="text" id="identificacion" name="identificacion" class="form-control @error('identificacion') is-invalid @enderror " value="{{ old('identificacion',$user->identificacion) }}" required>
                            <label for="identificacion">Identificación<i class="text-danger">*</i></label>
                            @error('identificacion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form md-outline my-1">
                                    <input id="apellidos" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos',$user->apellidos) }}"  required  type="text">
                                    <label for="apellidos">Apellidos<i class="text-danger">*</i></label>
                                    @error('apellidos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form md-outline my-1">
                                    <input id="nombres" name="nombres" class="form-control @error('nombres') is-invalid @enderror" value="{{ old('nombres',$user->nombres) }}" required type="text">
                                    <label for="nombres">Nombres<i class="text-danger">*</i></label>
                                    @error('nombres')
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
                                    <input id="telefono" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono',$user->telefono) }}"  required  type="number">
                                    <label for="telefono">Teléfono celular<i class="text-danger">*</i></label>
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form md-outline my-1">
                                    <input id="direccion" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion',$user->direccion) }}" required type="text">
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
                            <div class="col-md-6">
                                <div class="md-form md-outline my-1">
                                    <input id="banco" name="banco" class="form-control @error('banco') is-invalid @enderror" value="{{ old('banco',$user->banco) }}"    type="text">
                                    <label for="banco">Banco</label>
                                    @error('banco')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form md-outline my-1">
                                    <input id="numero_cuenta" name="numero_cuenta" class="form-control @error('numero_cuenta') is-invalid @enderror" value="{{ old('numero_cuenta',$user->numero_cuenta) }}"  type="text">
                                    <label for="numero_cuenta">Número de cuenta</label>
                                    @error('numero_cuenta')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="md-fsorm md-outline my-1">
                                    <label for="tipo_cuenta">Tipo de cuenta</label>
                                    <select id="tipo_cuenta" name="tipo_cuenta" class="browser-default custom-select @error('tipo_cuenta') is-invalid @enderror" >
                                        <option value="Cuenta corriente" {{ old('tipo_cuenta',$user->tipo_cuenta)=='Cuenta corriente'?'selected':'' }}>Cuenta corriente</option>
                                        <option value="Cuenta con chequera" {{ old('tipo_cuenta',$user->tipo_cuenta)=='Cuenta con chequera'?'selected':'' }}>Cuenta con chequera</option>
                                        <option value="Cuenta de ahorro" {{ old('tipo_cuenta',$user->tipo_cuenta)=='Cuenta de ahorro'?'selected':'' }}>Cuenta de ahorro</option>
                                        <option value="Cuenta de nómina" {{ old('tipo_cuenta',$user->tipo_cuenta)=='Cuenta de nómina'?'selected':'' }}>Cuenta de nómina</option>
                                        <option value="Cuentas en dólares" {{ old('tipo_cuenta',$user->tipo_cuenta)=='Cuentas en dólares'?'selected':'' }}>Cuentas en dólares</option>
                                      </select>
                                    @error('tipo_cuenta')
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
                                    <input id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$user->email) }}" type="email">
                                    <label for="email">Email</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form md-outline my-1">
                                    <input id="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" type="password">
                                    <label for="password">Contraseña</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="form-group border">
                            <label class="mx-2" for="">Selecione rol:</label> <br>

                            @foreach ($roles as $rol)
                            
                                <div class="custom-control custom-checkbox custom-control-inline mx-2">
                                    <input type="checkbox" class="custom-control-input"name="roles[{{ $rol->id }}]"  value="{{ $rol->id }}" {{ $user->hasRole($rol)?'checked':'' }} {{ old('roles.'.$rol->id)==$rol->id ?'checked':'' }} id="rol_{{ $rol->id }}">
                                    <label class="custom-control-label" for="rol_{{ $rol->id }}">
                                        {{ $rol->name }}
                                    </label>
                                </div>

                            @endforeach
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

@endpush
@prepend('linksPie')
    <script>
    $('#menuUsuarios').addClass('active');
    </script>
@endprepend
@endsection
