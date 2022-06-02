<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $factura->referencia }}</title>
    <link id="style-switch" rel="stylesheet" type="text/css" href="{{ public_path('mdb/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="mt-1">
        <br>
        @include('ventas.facturas.detalle',['factura'=>$factura])
    </div>
</body>
</html>