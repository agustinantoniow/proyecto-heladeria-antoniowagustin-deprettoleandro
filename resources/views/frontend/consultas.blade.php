<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas</title>

    <!-- Bootstrap asset -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

    <!-- Tu CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<nav class="navbar bg-body-tertiary">
  
</nav>
</nav>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="{{ asset('imagenes/logoheladeria.png') }}" 
           alt="Logo" 
           width="100" 
           height="90"
           class="me-4">
      Inicio
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <ul class="navbar-nav fs-4"> <li class="nav-item">
        <a class="nav-link" href="recomendados">recomendados</a>
    </li>
      </ul>
        <ul class="navbar-nav fs-4"> <li class="nav-item">
          <a class="nav-link" href="QuienesSomos">Quienes Somos</a>
        </li>
        <ul class="navbar-nav fs-4"> <li class="nav-item">
          <a class="nav-link" href="Comercializacion">Comercialización</a>
        </li>
        <ul class="navbar-nav fs-4"> <li class="nav-item">
          <a class="nav-link" href="Consultas">Consultas</a>
        </li>
        <ul class="navbar-nav fs-4"> <li class="nav-item">
          <a class="nav-link" href="Contacto">Contacto</a>
        </li>
        
          <ul class="navbar-nav fs-4"> <li class="nav-item">
          <a class="nav-link" href="Productos">Productos</a>
        </li>
          
        </li>
      </ul>
    </div>
  </div>
</nav>

    <div class="container mt-5">
        <div class="card shadow p-4 mx-auto" style="max-width: 600px;">
            <h1 class="text-center mb-4">Formulario de Consultas</h1>

            <form action="{{ url('/Consultas') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="num" class="form-label">Número de teléfono</label>
                    <input type="text" class="form-control" id="num" name="num" required>
                </div>
        <select class="form-select form-select-lg mb-3" aria-label="Large select example">
            <option selected>Seleccione una opcion</option>
            <option value="1">Problemas al realizar un pedido</option>
            <option value="2">Consultas sobre stock de un producto</option>
            <option value="3">Sugerencias</option>
        </select>
                <div class="mb-3">
                    <label for="mensaje" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-dark">Enviar</button>
                    
                </div>
            </form>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="social-buttons">
    <a href="#" class="social-icon facebook"><i class="fa-brands fa-facebook-f"></i></a>
    <a href="#" class="social-icon instagram"><i class="fa-brands fa-instagram"></i></a>
    <a href="#" class="social-icon whatsapp"><i class="fa-brands fa-whatsapp"></i></a>
</div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="TerminosyUsos">Terminos y Usos</a></li>
    <li class="breadcrumb-item"><a href="Nosotros">Nosotros</a></li>
  </ol>
</nav>

<footer>
    <p>&copy; Copyright2026.Todos los derechos reservados.heladeria glace - Corrientes - Argentina</p>
</footer>


    <!-- Bootstrap JS CDN -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>