@extends('components.layout')
@section('title', 'heladeria - login')
@section('content')
<body>
   <div class = "container row mx-auto mt-5">
    <div class="bg-secondary mt-3 p-5 col-md-4 ms-5">
              
                 
                <div class="input-group ms-auto">
                <input type="text" class="form-control" placeholder="Nombre de Usuario" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mt-4">
                  <input type="text" class="form-control" placeholder="Contraseña" aria-label="Recipient’s username" aria-describedby="basic-addon2">
                </div>
                <div class="input-group mt-4">
                  <a href="{{ url('/Productos') }}" class="btn btn-info text-white fw-bold px-4">
                   Iniciar Sesión </a>                       
                </div>

                 <div class="input-group mt-4">
                   <p>¿No tienes una cuenta? </p>                  
                 </div>
                 
                <div>    
                  <a href="{{ url('/register') }}" class="btn btn-info text-white fw-bold px-4 ms-2">
                    Registrate</a>
                </div>          
    </div>

    <div class ="col-md-6 mt-3 ms-lg-auto" >

      <h2 class="texto-novedades text-center "> Novedades!!!</h2>

      <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <video class="d-block w-100"  width="200" height="400" autoplay muted loop playsinline>
                            <source src="imagenes/videopublicidad1.mp4" type="video/mp4">
                                Tu navegador no soporta la reproducción de este video.
                </video>
            </div>
            <div class="carousel-item">
              <img src="imagenes/imagenes-pagina-principal/img3.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="imagenes/imagenes-pagina-principal/img2.png" class="d-block w-100" alt="...">
            </div>
          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
      </div>
    </div>
  </div>
</body>

@endsection
