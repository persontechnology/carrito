@extends('layouts.app',['title'=>'Nueva Categoría'])
@section('breadcrumbs', Breadcrumbs::render('departamento.create'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Nueva departamento
                </div>

                <div class="card-body">
                    <form action="{{ route('departamento.store') }}" method="POST">
                        @csrf
                        <div class="md-form md-outline my-1">
                            <input type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror " value="{{ old('nombre') }}" required>
                            <label for="nombre">Nombre<i class="text-danger">*</i></label>
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Sign up button -->
                        <button class="btn btn-primary my-2 btn-block" type="submit">Guardar</button>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@prepend('linksPie')
    <script>
    $('#menuDepartamento').addClass('active');
    </script>
@endprepend
@endsection
