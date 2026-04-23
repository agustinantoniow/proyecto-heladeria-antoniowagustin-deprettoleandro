
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top py-1 border-bottom">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <img src="{{ asset('imagenes/logoheladeria.png') }}" alt="Logo Heladería Glace" width="125" height="95" class="me-4">
    </a> 
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> 
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav fs-4">
        <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active fw-bold text-info' : '' }}" href="{{ url('/') }}">Inicio</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('QuienesSomos') ? 'active fw-bold text-info' : '' }}" href="{{ url('/QuienesSomos') }}">Nosotros</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('Comercializacion') ? 'active fw-bold text-info' : '' }}" href="{{ url('/Comercializacion') }}">Comercialización</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('Productos') ? 'active fw-bold text-info' : '' }}" href="{{ url('/Productos') }}">Productos</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('login') ? 'active fw-bold text-info' : '' }}" href="{{ url('/login') }}">Iniciar Sesión <i class="bi bi-lock"></i></a></li> 
      </ul>
      
      <ul class="navbar-nav ms-lg-auto"> 
        <li class="nav-item">
            <a href="{{ url('/contacto') }}" class="btn btn-info text-white fw-bold px-4">
                Contactanos
            </a>
        </li>
      </ul>
    </div> 
 </div> 
</nav>