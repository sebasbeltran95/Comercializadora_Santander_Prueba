<!DOCTYPE html>
<html lang="es">
@include('layouts.comun.header')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="{{ route('/') }}"> <img class="img-fluid img-roundered" width="30%" src="{{ asset('img/logo.webp') }}" alt=""></a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Request::is('/')) active @endif"
                                href="{{ route('/') }}">
                                <i class="fas fa-box"></i>
                                Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Request::is('descuentos')) active @endif"
                                href="{{ route('descuentos') }}">
                                <i class="fas fa-dollar-sign"></i>
                                Descuentos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Request::is('ventas')) active @endif"
                                href="{{ route('ventas') }}">
                                <i class="fas fa-dollar-sign"></i>
                                Ventas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Request::is('clientes')) active @endif"
                                href="{{ route('clientes') }}">
                                <i class="fas fa-user"></i> 
                                Clientes
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('contenido')
            </main>
        </div>
    </div>

    @include('layouts.comun.footer')
    @stack('js')
</body>
</html>
