<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>heladeria glace</title>

    <!-- Bootstrap asset -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

    <!-- Tu CSS -->
    <link rel="stylesheet" href="{{ asset('css/Style.css') }}">
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
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <ul class="navbar-nav fs-4">
          <li class="nav-item">
          <a class="nav-link" href="heladeriaglace">inicio</a>
          </li>  
        </ul>
      </ul>
        
        <ul class="navbar-nav fs-4"> 
          <li class="nav-item">
            <a class="nav-link" href="QuienesSomos">Quienes Somos</a>
          </li>
        <ul class="navbar-nav fs-4"> 
            <li class="nav-item">
              <a class="nav-link" href="Comercializacion">Comercialización</a>
            </li>
        <ul class="navbar-nav fs-4"> 
            <li class="nav-item">
              <a class="nav-link" href="Consultas">Consultas</a>
            </li>
        <ul class="navbar-nav fs-4"> 
          <li class="nav-item">
              <a class="nav-link" href="Contacto">Contacto</a>
          </li>
        
          <ul class="navbar-nav fs-4"> 
            <li class="nav-item">
              <a class="nav-link" href="Productos">Productos</a>
            </li>
          
        </li>
      </ul>
    </div>
  </div>
</nav>


  <div 
    class="container md- fluid">
  <div>
 
  <div 
    style="margin-bottom: 30px">
  </div>

 

    

<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="3000">
      <img src="imagenes/imagenes-pagina-principal/img1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="imagenes/imagenes-pagina-principal/img2.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="imagenes/imagenes-pagina-principal/img3.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
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
    </div>
  </div>
</div>




<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="social-buttons">
    <a href="#" class="social-icon facebook"><i class="fa-brands fa-facebook-f"></i></a>
    <a href="#" class="social-icon instagram"><i class="fa-brands fa-instagram"></i></a>
    <a href="#" class="social-icon whatsapp"><i class="fa-brands fa-whatsapp"></i></a>
</div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="TerminosyUsos">Terminos y Usos</a></li>
    <li class="breadcrumb-item"><a href="Nosotros">Nosotros</a></li>
  </ol>
</nav>

<footer>
    <p>&copy; Copyright2026.Todos los derechos reservados.heladeria glace - Corrientes - Argentina</p>
</footer>

    <!-- Bootstrap JS CDN -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>