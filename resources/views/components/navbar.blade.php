
<nav class="navbar navbar-expand-lg bg-white sticky-top py-2 shadow-sm border-bottom">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <img src="{{ asset('imagenes/logoheladeria.png') }}" alt="Logo Heladería Glace" width="110" height="85" class="me-2">
      <span style="font-family: 'Fredoka', sans-serif; font-weight: 700; color: #055160; font-size: 1.5rem;">GLACE</span>
    </a> 

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button> 

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mx-auto fs-5"> <li class="nav-item">
            <a class="nav-link nav-link-glace {{ request()->is('/') ? 'active fw-bold text-info' : '' }}" href="{{ url('/') }}">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-glace {{ request()->is('QuienesSomos') ? 'active fw-bold text-info' : '' }}" href="{{ url('/QuienesSomos') }}">Nosotros</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-glace {{ request()->is('Comercializacion') ? 'active fw-bold text-info' : '' }}" href="{{ url('/Comercializacion') }}">Comercialización</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-glace {{ request()->is('Productos') ? 'active fw-bold text-info' : '' }}" href="{{ url('/Productos') }}">Productos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-glace {{ request()->is('Ingreso') ? 'active fw-bold text-info' : '' }}" href="{{ url('/Ingreso') }}">
                Ingresar <i class="fa-solid fa-right-to-bracket ms-1"></i>
            </a>
        </li> 
      </ul>
      
      <ul class="navbar-nav ms-lg-auto"> 
        <li class="nav-item">
            <a href="{{ url('/contacto') }}" class="btn btn-info text-white fw-bold px-4 rounded-pill shadow-sm" style="font-family: 'Fredoka', sans-serif;">
                Contactanos
            </a>
        </li>
      </ul>
    </div> 
  </div> 
</nav>