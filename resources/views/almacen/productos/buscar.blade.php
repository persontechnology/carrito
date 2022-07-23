@extends('layouts.app',['title'=>'Buscar producto'])
@section('breadcrumbs', Breadcrumbs::render('productos'))
@section('content')
@livewire('producto')
@prepend('linksPie')
    <script>
        $('#productos').addClass('active');
    </script>

@endprepend
@endsection