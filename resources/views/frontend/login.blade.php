@extends('components.layout')
@section('title', 'heladeria - logi')
@section('content')
<body>
  <div class="container row mx-auto mt-5 align-items-center justify-content-between">
    
   <div class="presentacion p-5 col-md-4 rounded-4 shadow-sm">
    <h3 class="subtitulo-producto-glace mb-4">Ingresá a tu cuenta</h3>
    
    <form action="{{ url('verificarUsuario') }}" method="POST">
        @csrf <div class="input-group mb-1">
            <span class="input-group-text bg-white border-0"><i class="fa-solid fa-user text-info"></i></span>
            <input type="text" name="usuario" value="{{ old('usuario') }}" 
                   class="form-control border-0 @error('usuario') is-invalid @enderror" 
                   placeholder="Nombre de Usuario" style="font-family: 'Montserrat', sans-serif;">
        </div>
        @error('usuario')
            <small class="text-danger ms-2 card-text-glace">{{ $message }}</small>
        @enderror

        <div class="input-group mt-4 mb-1">
            <span class="input-group-text bg-white border-0"><i class="fa-solid fa-lock text-info"></i></span>
            <input type="password" name="password" 
                   class="form-control border-0 @error('password') is-invalid @enderror" 
                   placeholder="Contraseña" style="font-family: 'Montserrat', sans-serif;">
        </div>
        @error('password')
            <small class="text-danger ms-2 card-text-glace">{{ $message }}</small>
        @enderror
           <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-info text-white fw-bold px-4 py-2" style="font-family: 'Fredoka', sans-serif;">
                Iniciar Sesión 
            </button>
        </div>
    </form>

         <div class="text-center mt-4">
        <p class="mb-2" style="font-family: 'Montserrat', sans-serif;">¿No tienes una cuenta?</p> 
        <a href="{{ url('/registrarse') }}" class="btn btn-outline-info fw-bold px-4" style="font-family: 'Fredoka', sans-serif;">
            Registrate
        </a>
        </div>          
    </div>

    <div class="col-md-7 mt-3">
        <div class="text-center mb-3">
            <h2 class="texto-novedades display-5">NOVEDADES</h2>
        </div>

        <div id="carouselExampleAutoplaying" class="carousel slide shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <video class="d-block w-100" style="height: 450px; object-fit: cover;" autoplay muted loop playsinline>
                        <source src="imagenes/videopublicidad1.mp4" type="video/mp4">
                        Tu navegador no soporta la reproducción de este video.
                    </video>
                </div>
                <div class="carousel-item">
                    <img src="imagenes/imagenes-pagina-principal/img3.png" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="Promo Glace">
                </div>
                <div class="carousel-item">
                    <img src="imagenes/imagenes-pagina-principal/img2.png" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="Sabores Glace">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>
</div>
</body>

@endsection
