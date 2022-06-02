<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ ucfirst($title ?? '') }} | {{ config('app.name', 'APP WEB') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="carrito" name="carrito de compras">
    <meta content="carrito" name="carrito de compras">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome-free-5.12.1-web/css/all.min.css') }}">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('cli/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('cli/css/style.css') }}" rel="stylesheet">

    <script src="{{ asset('global_assets/js/main/jquery.min.js') }}"></script>
    <script>

        var productos = JSON.parse(localStorage.getItem("productos") || "[]");

        function add(id,cantidad,precio,nombre){
            
            var producto = {
                id: id,
                cantidad:cantidad,
                precio:precio,
                nombre:nombre
            };

            let existe=false;

            productos.find((o, i) => {
                if (o.id === id) {
                    productos[i] = { id: id, cantidad: parseInt(o.cantidad)+parseInt(cantidad), precio: precio,nombre:nombre };
                    existe=true;
                    return true;
                }
            });
            if(existe===false){
                productos.push(producto);
            }
            
            
            // console.log("add producto #" + JSON.stringify(producto));
            
            localStorage.setItem("productos", JSON.stringify(productos));
            cargarPagina()
        }

        function menorar(id,cantidad,precio,nombre){
            
            var producto = {
                id: id,
                cantidad:cantidad,
                precio:precio,
                nombre:nombre
            };

            let existe=false;

            productos.find((o, i) => {
                if (o.id === id) {
                    productos[i] = { id: id, cantidad: parseInt(o.cantidad)-parseInt(cantidad), precio: precio,nombre:nombre };
                    existe=true;
                    return true;
                }
            });
            if(existe===false){
                productos.push(producto);
            }
            
            
            // console.log("add producto #" + JSON.stringify(producto));
            
            localStorage.setItem("productos", JSON.stringify(productos));
            cargarPagina()
        }

       function cargarPagina(){
            location.replace("{{ request()->url() }}")
       };
        
        function remove(id){
            
            myArray = productos.filter(function( obj,i ) {
                productos[i] = { id: id, cantidad: 0, precio: 0,nombre:'' };
                return obj.id != id;
            });
            localStorage.removeItem('productos');
            localStorage.setItem('productos', JSON.stringify(myArray));
            cargarPagina();
        }
        
        function contadorCarrito(){
            $('#contadorCarrito').html(productos.length)
        }
        

        </script>

        @stack('scripts')
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Ayuda</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Soporte</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">C</span>{{ App\Models\Configuracion::first()->empresa??config('app.name','') }}</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar productos...">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                {{-- <a href="" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a> --}}
                <a href="{{ route('carrito.carro') }}" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge" id="contadorCarrito"></span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse {{ request()->routeIs('welcome')?'show':'' }} position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        @foreach (App\Models\Categoria::latest()->take(9)->get() as $cat)
                        <a href="" class="nav-item nav-link">{{ $cat->nombre }}</a>    
                        @endforeach
                        
                        <a href="" class="nav-item nav-link bg-primary">Ver todas las categorías</a>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">C</span>{{ App\Models\Configuracion::first()->empresa??config('app.name','') }}</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('welcome') }}" class="nav-item nav-link {{ request()->routeIs('welcome')?'active':'' }}">Inicio</a>
                            <a href="shop.html" class="nav-item nav-link">Categorías</a>
                            <a href="detail.html" class="nav-item nav-link {{ request()->routeIs('carrito.detalle')?'active':'' }}">Productos</a>
                            {{-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                    <a href="checkout.html" class="dropdown-item">Checkout</a>
                                </div>
                            </div> --}}
                            <a href="contact.html" class="nav-item nav-link">Contactos</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            @auth
                            <a href="{{ route('home') }}" class="nav-item nav-link btn btn-warning">Administración</a>
                            @else
                            <a href="{{ route('login') }}" class="nav-item nav-link">Ingresar</a>
                            <a href="{{ route('register') }}" class="nav-item nav-link">Registrar</a>
                            @endauth
                        </div>
                    </div>
                </nav>
                @if (request()->routeIs('welcome'))
                    <div id="header-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @php
                                $ix=0;
                            @endphp
                            @foreach (App\Models\Producto::latest()->take(2)->get() as $pro)
                            @php
                                $ix+=1;
                            @endphp
                                <div class="carousel-item {{ $ix==1?'active':'' }}" style="height: 410px;">
                                    @if (Storage::exists($pro->foto))
                                        <img class="img-fluid" src="{{ Storage::url($pro->foto) }}" alt="Image">
                                    @else
                                        <img class="img-fluid" src="{{ asset('img/venta.svg') }}" alt="Image">
                                    @endif
                                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                        <div class="p-3" style="max-width: 700px;">
                                            <h4 class="text-light text-uppercase font-weight-medium mb-3">{{ $pro->nombre }}</h4>
                                            <h3 class="display-4 text-white font-weight-semi-bold mb-4">$ {{ $pro->precio_venta }}</h3>
                                            <a href="{{ route('carrito.detalle',$pro->id) }}" class="btn btn-light py-2 px-3">Coprar ahora</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            

                        </div>
                        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-prev-icon mb-n2"></span>
                            </div>
                        </a>
                        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-next-icon mb-n2"></span>
                            </div>
                        </a>
                    </div>    
                @endif
                
            </div>
        </div>
    </div>
    <!-- Navbar End -->
    @foreach (['success', 'warn', 'info', 'error'] as $msg)
        @if(Session::has($msg))

        
        
        <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>{{ Session::get($msg) }}</strong>
        </div>
        @endif
    @endforeach
    @yield('content')
    


    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-8 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">C</span>{{ App\Models\Configuracion::first()->empresa??config('app.name','') }}</h1>
                </a>
                <p>CARRITO DE COMPRAS</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 ECUADOR-COTOPAXI</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@carrito.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+593 99 67890</p>
            </div>
            <div class="col-lg-4 col-md-12">
                <img class="img-fluid" src="{{ asset('cli/img/payments.png') }}" alt="">
                <hr>
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">{{ App\Models\Configuracion::first()->empresa??config('app.name','') }}</a>.
                    Reservados todos los derechos. Diseñado por
                    <a class="text-dark font-weight-semi-bold" href="#">FREDDY LEMA</a>
                    
                </p>
            </div>
        </div>
        
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('cli/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('cli/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('cli/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('cli/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('cli/js/main.js') }}"></script>

   <script>
       contadorCarrito();
   </script>
   @stack('scriptsPie')

   
   
   


</body>

</html>