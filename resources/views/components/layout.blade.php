<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Heladería Glace')</title>

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
          <img src="{{ asset('imagenes/logoheladeria.png') }}" alt="Logo" width="100" height="90" class="me-4">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav fs-4">
            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/recomendados') }}">Recomendados</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/QuienesSomos') }}">Quiénes Somos</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/Comercializacion') }}">Comercialización</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/Consultas') }}">Consultas</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/Contacto') }}">Contacto</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/Productos') }}">Productos</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <main>
        @yield('content')
    </main>

    <div class="social-buttons text-center mt-4">
        <a href="#" class="social-icon facebook"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#" class="social-icon instagram"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" class="social-icon whatsapp"><i class="fa-brands fa-whatsapp"></i></a>
    </div>
    <nav aria-label="breadcrumb" class="container mt-3">
      <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="/terminosYusos">Términos y Usos</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/Nosotros') }}">Nosotros</a></li>
      </ol> </nav>
    <footer class="text-center bg-light py-3 mt-4">
        <p class="mb-0">&copy; Copyright 2026. Todos los derechos reservados. Heladería Glace - Corrientes - Argentina</p>
    </footer>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
