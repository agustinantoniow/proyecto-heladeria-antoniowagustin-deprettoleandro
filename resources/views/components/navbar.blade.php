
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
       
        <ul class="navbar-nav ms-auto">
    @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Bienvenido, {{ auth()->user()->nombre }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
      
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ url('/logout') }}" method="POST" class="d-inline">
                      @csrf <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                    </form>
                </li>
            </ul>
        </li>
    @endauth

    @guest
        <li class="nav-item">
            <a class="nav-link nav-link-glace {{ request()->is('Ingreso') ? 'active fw-bold text-info' : '' }}" href="{{ url('/Ingreso') }}">
                Ingresar <i class="fa-solid fa-right-to-bracket ms-1"></i>
            </a>
        </li> 
    @endguest
</ul>
          <li class="nav-item">
              <a class="nav-link nav-link-glace {{ request()->is('MiCarrito') ? 'active fw-bold text-info' : '' }}" href="{{ url('/MiCarrito') }}">
                  Mi Carrito <i class="fa-solid fa-cart-shopping ms-1"></i>
              </a>
        
        <nav class="navbar">
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