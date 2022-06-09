<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ ucfirst($title ?? '') }} | {{ config('app.name', 'APP WEB') }}</title>
    

    <!-- MDB icon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome-free-5.12.1-web/css/all.min.css') }}">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="{{asset('roboto.css')}}">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('mdb/css/bootstrap.min.css') }}">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{ asset('mdb/css/mdb.min.css') }}">
    <!-- Your custom styles (optional) -->
    {{-- <link rel="stylesheet" href="{{ asset('mdb/css/style.css') }}"> --}}


	<!-- Global stylesheets -->
	<link href="{{ asset('global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{ asset('global_assets/js/main/jquery.min.js') }}"></script>
	<script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('global_assets/js/plugins/visualization/echarts/echarts.min.js') }}"></script>
	<script src="{{ asset('global_assets/js/plugins/maps/echarts/world.js') }}"></script>

	<script src="{{ asset('assets/js/app.js') }}"></script>
	
	<!-- /theme JS files -->

    <!-- notify -->
    <script src="{{ asset('js/notify.min.js') }}"></script>

    <!-- alertify -->
    <link rel="stylesheet" href="{{ asset('js/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css') }}">
    <script src="{{ asset('js/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js') }}"></script>

    <script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
    </script>
    
    @stack('linksCabeza')


</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-expand-xl navbar-dark bg-indigo navbar-static px-0">
		<div class="d-flex flex-1 pl-3">
			<div class="navbar-brand wmin-0 mr-1">
				<a href="{{ url('/') }}" class="d-inline-block">
					<img src="{{ asset('global_assets/images/logo_light.png') }}" class="d-none d-sm-block" alt="">
					<img src="{{ asset('global_assets/images/logo_icon_light.png') }}" class="d-sm-none" alt="">
				</a>
			</div>
		</div>

		<div class="d-flex w-100 w-xl-auto overflow-auto overflow-xl-visible scrollbar-hidden border-top border-top-light-100 border-top-xl-0 order-1 order-xl-0">
			@auth
			<ul class="navbar-nav flex-row text-nowrap mx-auto">

				<li class="nav-item">
					<a href="{{ route('home') }}" class="navbar-nav-link" id="menuInicio">
						<i class="fas fa-home mr-1"></i>
						Inicio
					</a>
				</li>

				
				

				@can('Usuarios')
                        
				<li class="nav-item">
					<a class="navbar-nav-link" id="menuUsuarios" href="{{ route('usuarios')}}"> <i class="fas fa-user-friends mr-1"></i>Usuarios</a>
				</li>

				@endcan

				@can('Cuentas')
					
				<li class="nav-item">
					<a class="navbar-nav-link" id="categorias" href="{{ route('categorias')}}"> <i class="fas fa-table mr-1"></i>Cuentas</a>
				</li>
				@endcan

				@can('Productos')
				<li class="nav-item">
					<a class="navbar-nav-link" id="productos" href="{{ route('productos')}}"> <i class="fas fa-tags mr-1"></i>Productos</a>
				</li>
				@endcan

				@can('Ingresos')
					
				<li class="nav-item">
					<a class="navbar-nav-link" id="facturasIngreso"  href="{{ route('facturas','Ingreso')}}"> <i class="icon-calculator3 mr-1"></i>Ingresos</a>
				</li>

				@endcan

				@can('Salidas')
					
				<li class="nav-item">
					<a class="navbar-nav-link" id="facturasSalida"  href="{{ route('facturas','Salida')}}"> <i class="icon-calculator3 mr-1"></i>Salidas</a>
				</li>

				@endcan
				
				@can('Departamentos')      
				<li class="nav-item">
					<a class="navbar-nav-link" id="menuDepartamento" href="{{ route('departamento.index')}}"> <i class="fas fa-table mr-1"></i>Departamentos</a>
				</li>
				@endcan

				@can('Empresa')
				<li class="nav-item">
					<a class="navbar-nav-link" id="empresa" href="{{ route('empresa')}}"> <i class="fas fa-university mr-1"></i> Empresa</a>
				</li>
				@endcan
				@role('Administrador')
					<li class="nav-item">
						<a class="navbar-nav-link" id="menuRolesPermisos" href="{{ route('roles')}}"> <i class="icon-lock mr-1"></i>Roles</a>
					</li>
				@endrole

				
			</ul>
			@endauth
		</div>

		<div class="d-flex flex-xl-1 justify-content-xl-end order-0 order-xl-1 pr-3">
			<ul class="navbar-nav flex-row">

				@guest
					<li class="nav-item">
						<a href="{{ route('login') }}" class="navbar-nav-link">
							<i class="icon-user-lock mr-1"></i>
							{{ __('Login') }}
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('register') }}" class="navbar-nav-link">
							<i class="icon-user-lock mr-1"></i>
							{{ __('Registrar') }}
						</a>
					</li>
				@else
				
		
				<li class="nav-item nav-item-dropdown-xl dropdown dropdown-user h-100">
					<a href="#" class="navbar-nav-link navbar-nav-link-toggler d-flex align-items-center h-100 dropdown-toggle" id="menuMiPerfil" data-toggle="dropdown">
						<img src="{{ asset('img/user.png') }}" class="rounded-circle mr-xl-2" height="38" alt="s">
						<span class="d-none d-xl-block">
							{{ Auth::user()->name }}
						</span>
					</a>
		
					<div class="dropdown-menu dropdown-menu-right">
						<a href="{{ route('miPerfil') }}" class="dropdown-item" id="menuPerfil"><i class="icon-user-plus"></i> Mi perfil</a>
						<div class="dropdown-divider"></div>
						
						<a href="{{ route('logout') }}"
						onclick="event.preventDefault();
									  document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-switch2"></i> Salir</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</li>
				@endguest
				
			</ul>
		</div>
	</div>
	<!-- /main navbar -->
		

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content container header-elements-md-inline">
						@yield('breadcrumbs')
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content container pt-0 {{ request()->routeIs('welcome')?'d-flex justify-content-center align-items-center':'' }}" id="pantallaGrande">
                    @if ($errors->any())
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
								<div class="alert bg-danger text-white alert-styled-left alert-dismissible">
									<button type="button" class="close" data-dismiss="alert"><span>×</span></button>
									<ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
								</div>

                            </div>
                        </div>
                    </div>
                        

                    @endif

                    @foreach (['success', 'warn', 'info', 'error'] as $msg)
                        @if(Session::has($msg))
                        <script>
                            $.notify("{{ Session::get($msg) }}", "{{ $msg }}");
                        </script>
                        @endif
                    @endforeach


                    @yield('content')
					
				</div>
				<!-- /content area -->


				<!-- Footer -->
				<div class="navbar navbar-expand-lg navbar-light">
					<div class="text-center d-lg-none w-100">
						<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
							<i class="icon-unfold mr-2"></i>
							Footer
						</button>
					</div>

					<div class="navbar-collapse collapse" id="navbar-footer">
						<span class="navbar-text">
							&copy; {{ date('Y') }}. <a href="{{ route('home') }}"> {{ config('app.name','') }}</a> by <a href="#" target="_blank">FREDY LEMA</a>
						</span>
					</div>
				</div>
				<!-- /footer -->

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('mdb/js/mdb.min.js') }}"></script>

    @stack('linksPie')


    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $('table').on('draw.dt', function() {
			$('[data-toggle="tooltip"]').tooltip();
        });
        
        function eliminar(arg){
			var url=$(arg).data('url');
			var msg=$(arg).data('title');
			$.confirm({
				title: msg,
				content: 'No podra recuperar el contenido',
				theme: 'modern',
				type:'dark',
				icon:'fas fa-trash',
				closeIcon:true,
				buttons: {
					confirmar: function () {
						location.replace(url);
					}
				}
			});
		}
        
    </script>

</body>
</html>
