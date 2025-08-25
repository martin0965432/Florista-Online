<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Florista Online</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Font awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script src="https://kit.fontawesome.com/4cd00acc12.js" crossorigin="anonymous"></script>



    <!-- Scripts y estilos (Laravel Mix) -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
    /* === Estilo navbar === */
    .navbar-custom {
        background-color: #198754 !important; /* Verde oscuro */
    }

    .navbar-custom .navbar-brand,
    .navbar-custom .nav-link {
        color: #fff !important;
    }

    .navbar-custom .nav-link:hover {
        background-color: #157347 !important;
    }

    /* === Dropdown personalizado === */
    .navbar-custom .dropdown-menu {
        background-color: #ffffff !important;  /* Fondo blanco del menú */
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .navbar-custom .dropdown-item {
        color: #212529 !important;  /* Texto negro visible */
    }

    .navbar-custom .dropdown-item:hover {
        background-color: #ddf7e8ff !important; /* Verde claro al pasar */
        color: #198754 !important;              /* Texto verde */
    }

    /* === Fondo global === */
    body {
        background-color: #ddf7e8ff; /* Verde claro pastel */
    }

    .card {
        background-color: #ffffff; /* Tarjetas blancas */
    }
</style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-custom shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    Florista Online 🌸
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                        aria-controls="navbarContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon text-white"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <!-- Enlaces Izquierda -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Enlaces Derecha -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                                </li>
                            @endif
                        @else
                            <!-- Botón Ver carrito al lado izquierdo del nombre -->
                            <li class="nav-item d-flex align-items-center">
                                <a class="nav-link text-white d-flex align-items-center" href="{{ route('carrito.ver') }}">
                                    <i class="fa fa-shopping-cart me-2 text-white"></i> Ver carrito
                                    @php
                                        $carrito = session('carrito', []);
                                        $cantidad = array_sum(array_column($carrito, 'cantidad'));
                                    @endphp
                                    @if($cantidad > 0)
                                        <span class="badge bg-danger rounded-pill ms-2">{{ $cantidad }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                    <!-- Ícono hamburguesa -->
                                         <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                             class="bi bi-list" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M2.5 12.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5z" />
                                         </svg>
                                 </a>
                                 
                                <div class="dropdown-menu dropdown-menu-end">
    {{-- Opción para cerrar sesión --}}
    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Cerrar sesión
    </a>

    {{-- Acceso al panel de usuario --}}
    <a class="dropdown-item" href="{{ url('/home') }}">Panel de usuario</a>

     <a class="dropdown-item" href="{{ route('arreglo.formulario') }}">Arreglos Personalizados </a>


    {{-- Acceso al panel de administración (solo admins) --}}
    @if(Auth::check() && Auth::user()->role === 'admin')
        <a class="dropdown-item" href="{{ url('/admin') }}">Panel administrativo</a>

    @endif

    {{-- Formulario oculto para logout --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>

                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Contenido principal --}}
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
