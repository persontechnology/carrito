<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pdf</title>
    <link id="style-switch" rel="stylesheet" type="text/css" href="{{ public_path('mdb/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="card">
       
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Cuenta contable</th>
                        <th>Cuanta contable salida</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Talla</th>
                        <th>Cantidad</th>
                        <th>Precio compra</th>
                        <th>Precio venta</th>
                        <th>Incluye iva</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $pro)
                    <tr>
                        <td>{{ $pro->categoria->nombre??'' }}</td>
                        <td>{{ $pro->categoria_dos->nombre??'' }}</td>
                        <td>{{ $pro->codigo }}</td>
                        <td>{{ $pro->nombre }}</td>
                        <td>{{ $pro->talla }}</td>
                        <td>{{ $pro->cantidad }}</td>
                        <td>{{ $pro->precio_compra }}</td>
                        <td>{{ $pro->precio_venta }}</td>
                        <td>{{ isset($pro->incluye_iva)?'Si':'No' }}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        
    </div>
</body>
</html>