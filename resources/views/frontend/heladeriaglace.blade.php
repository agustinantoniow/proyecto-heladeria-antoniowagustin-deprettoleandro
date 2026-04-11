<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>heladeria glace</title>

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
        <li class="nav-item">
          <a class="nav-link" href="recomendados">recomendados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Quienes Somos">Quienes Somos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Consultas">Consultas</a>
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


  <div 
    class="container md- fluid"><h1> Nuestros Productos <h1> 
  <div>
 
  <div 
    style="margin-bottom: 30px">
  </div>

 
<div id="carouselExampleIndicators" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="imagenes/imagenes-pagina-principal/img1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="imagenes/imagenes-pagina-principal/img2.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="imagenes/imagenes-pagina-principal/img3.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    
<div 
    style="margin-bottom: 50px">
</div>

<div class="card-group">
  <div class="card">
    <img src="imagenes/imagenes-tarjetas/img4.png" class="card-img-top" alt="..."width="400" height="250">
    <div class="card-body">
      <h3 class="card-title">Helados de agua</h3>
      <section>
      <div class="postre-card">
        <h4>Frutilla</h4>
      </div>
  </section>
      <section>
      <div class="postre-card">
        <h4>Naranja</h4>
      </div>
  </section>
      <section>
      <div class="postre-card">
        <h4>Limon</h4>
      </div>
  </section>
       
      
    </div>
  </div>
  <div class="card">
    <img src="imagenes/imagenes-tarjetas/img6.png" class="card-img-top" alt="..."width="400" height="250">
    <div class="card-body">
      <h3 class="card-title">Postres</h3>
    <section>
      <div class="postre-card">
        <h4>Tarta de Frutas</h4>
      </div>
  </section>
    <section>
    <div class="postre-card">
        <h4>Copa Helada</h4>
    </div>
  </section>
  <section>
    <div class="postre-card">
        <h4>Tiramisú</h4>
    </div>
  </section>
  <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img src="imagenes/imagenes-tarjetas/img7.png" class="card-img-top" alt="..."width="400" height="250">
    <div class="card-body">
      <h3 class="card-title">Linea familiar </h3>
      <section>
      <div class="postre-card">
        <h4>Frutos del Bosque</h4>
      </div>
  </section>
  <section>
      <div class="postre-card">
        <h4>super Dulce de Leche</h4>
      </div>
  </section>
  <section>
      <div class="postre-card">
        <h4>vainilla y chocolate</h4  >
      </div>
  </section>
     
      <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>



<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="Terminos y usos">Terminos y Usos</a></li>
    <li class="breadcrumb-item"><a href="Nosotros">Nosotros</a></li>
    <li class="breadcrumb-item"><a href="Contacto">Contacto</a></li>
    
  </ol>
</nav>
    <!-- Bootstrap JS CDN -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>