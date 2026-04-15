<div class="layout-container">
    
    <header class="main-header">
        <nav>
            <div class="logo">
                <a> 
                    <img src="imagenes/logoheladeria.png" alt="logo"
                    width="100" 
                    height="90"
                    class="me-4">
                </a>
                </div>
            <ul>
                <li><a href="inicio#">Inicio</a></li>
                <li><a href="carrito">Carrito</a></li>
            </ul>
        </nav>
    </header>

    <main class="content">

    @yield('content')

    </main>
    
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
        <li class="nav-item">
          <a class="nav-link" href="recomendados">recomendados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="QuienesSomos">Quienes Somos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Comercializacion">Comercialización</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Consultas">Consultas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Contacto">Contacto</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            catalogo
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="Tortas Heladas">Tortas Heladas</a></li>
            <li><a class="dropdown-item" href="Helados de Agua">Helados de Agua</a></li>
            <li><a class="dropdown-item" href="Helados de Crema">Helados de Crema</a></li>
            <li><a class="dropdown-item" href="Postres">Postres</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <div class="social-buttons">
    <a href="#" class="social-icon facebook"><i class="fa-brands fa-facebook-f"></i></a>
    <a href="#" class="social-icon instagram"><i class="fa-brands fa-instagram"></i></a>
    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="TerminosyUsos">Terminos y Usos</a></li>
    <li class="breadcrumb-item"><a href="Nosotros">Nosotros</a></li>
    <li class="breadcrumb-item"><a href="Contacto">Contacto</a></li>
  </ol>
    </nav>
    </div>

    <footer class="main-footer">
        <p>&copy; <span id="year"></span> Todos los derechos reservados. heladeria glace - Corrientes -Argentina</p>
    </footer>

</div>