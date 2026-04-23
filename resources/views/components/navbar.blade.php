<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top py-1 border-bottom">
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
            <li class="nav-item"><a class="nav-link" href="{{ url('/QuienesSomos') }}">Quiénes Somos</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/Comercializacion') }}">Comercialización</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/Consultas') }}">Consultas</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/Productos') }}">Productos</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/login') }} "> Iniciar Sesión  </a>  </li> <i class="bi bi-lock"> </i>
          </ul>
          
            <ul class="ms-lg-auto"> 
              <a href="{{ url('/contacto') }}" class="btn btn-info text-white fw-bold px-4">
                    Contactanos
              </a>
            </ul>
</nav>