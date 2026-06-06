
<nav class="navbar navbar-expand-lg bg-white sticky-top py-2 shadow-sm border-bottom">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/admin/dashboard') }}">
      <img src="{{ asset('imagenes/logoheladeria.png') }}" alt="Logo Heladería Glace" width="110" height="85" class="me-2">
      <span style="font-family: 'Fredoka', sans-serif; font-weight: 700; color: #055160; font-size: 1.5rem;">GLACE</span>
    </a> 

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button> 

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mx-auto fs-5"> <li class="nav-item">
            <a class="nav-link nav-link-glace {{ request()->is('/') ? 'active fw-bold text-info' : '' }}" href="{{ route('admin.consultas') }}">Ver consultas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-glace {{ request()->is('ListarProductos') ? 'active fw-bold text-info' : '' }}" href="{{ url('/ListarProductos') }}">Listar Productos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.productos.create') }}">Agregar un producto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-glace {{ request()->is('EliminarProducto') ? 'active fw-bold text-info' : '' }}" href="{{ url('/EliminarProducto') }}">Eliminar un producto</a>
        </li>
       <li class="nav-item">
    <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</li>
        
      </ul>
      
    </div> 
  </div> 
</nav>