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