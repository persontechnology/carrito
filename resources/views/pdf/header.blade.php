<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link id="style-switch" rel="stylesheet" type="text/css" href="{{ public_path('mdb/css/bootstrap.css') }}">
    
</head>
<body>
    
        <div class="row mb-2">
            <div class="col-lg-6">
                
                    <img class="avatar-img" src="{{ public_path('global_assets/images/logo_light.png') }}" alt="">
                
            </div>
            <div class="col-lg-6">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>{{ App\Models\Configuracion::first()->empresa??config('app.name','') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Ruc:</strong>{{ App\Models\Configuracion::first()->ruc??'000000000001' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Teléfono:</strong>{{ App\Models\Configuracion::first()->telefono??'123456789' }} - {{ App\Models\Configuracion::first()->celular??'123456789' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong>{{ App\Models\Configuracion::first()->email??'' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Dirección:</strong>{{ App\Models\Configuracion::first()->direccion??'' }} - {{ App\Models\Configuracion::first()->celular??'123456789' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
    
</body>
</html>