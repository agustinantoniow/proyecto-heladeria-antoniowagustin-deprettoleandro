@extends('components.layout')
@section('title', 'heladeria - Inicio')
@section('content')
<body class="bg-terciary">

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





    <!-- Bootstrap JS CDN -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
@endsection