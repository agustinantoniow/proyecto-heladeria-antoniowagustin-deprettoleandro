@extends('components.layout')
@section('title', 'heladeria - Inicio')
@section('content')
<body class="bg-terciary">

  
 

    

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







<h2 class = "mb-4 text-center">  Nuestros Productos </h2>
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
      <div class="postre-card">
        <h4>Durazno</h4>
      </div>
      <p><a href="pagina-helados-agua">Ver mas...</a></p>

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
  
  
    <div class="postre-card">
        <h4>Tiramisú</h4>
    </div>
    <div class="postre-card">
        <h4>Bombon Helado</h4>
    </div>
    <p><a href="pagina-postres">Ver mas....</a></p>
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
   <section>
      <div class="postre-card">
        <h4>dulce de leche y granizado</h4  >
      </div>
      <p><a href="pagina-linea-familiar">Ver mas..</a></p>
  </section>
    </div>
  </div>
  
</div>

<h2 class = "mb-4 text-center">  Recomendados </h2>
<div class="row">
<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="200">
      <img src="imagenes/imagenes-pagina-principal/img4.png" class="d-block w-100" width="400" height="550" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="imagenes/imagenes-pagina-principal/img5.png" class="d-block w-100" width="400" height="550"  alt="...">
    </div>
    <div class="carousel-item">
      <img src="imagenes/imagenes-pagina-principal/img6.png" class="d-block w-100" width="400" height="550" alt="...">
    </div>
  </div>
 


<h2 class = "mb-4 text-center">  Novedades </h2>

<div class="row">
<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-tarjetas/img8.png" class="img-fluid rounded-start">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">Helado sabor Mango</h5>
        <h6 class="card-text">Un nuevo sabor paradisiaco y delicioso</h6>
      </div>
    </div>
  </div>
</div>
</div>



  <div class="col-sm-6 mb-3 mb-sm-0">
<div class="card mb-3" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-tarjetas/img11.png" class="img-fluid rounded-star">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">Malteada de chocolate</h5>
        <h6 class="card-text"> Es una opción nueva y rerescante, encontrala ya en nuestro menu.</h6>
      </div>
    </div>
  </div>
</div>
</div>


<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-tarjetas/img9.png" class="img-fluid rounded-start">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">Pote familiar dulce de leche, granizado y chocolate blanco</h5>
        <h6>para los amantes de lo chocolatoso esta es la opcion ideal</h6>
      </div>
    </div>
  </div>
</div>
</div>

<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-tarjetas/img10.png" class="img-fluid rounded-start">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">Palito bombon relleno</h5>
        <h6>una capa gruesa de chocolate relleno con un dulce de leche artesanal</h6>
      </div>
    </div>
  </div>
</div>
</div>
 </div>



<h2 class = "mb-4 text-center">  Ofertas </h2>

<div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3" style="max-width: 800px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-tarjetas/img12.png" class="img-fluid rounded-start">
    </div>
    <div class="col-md-4">
      <div class="card-body">
        <h5 class="card-title">Oferta Especial</h5>
        <h6 class="card-text">Oferta imperdible con la compra de un 1 kilo de helado te lleva 1/4 de regalo</h6>
        <span class="badge bg-warning text-dark">Oferta</span>
      </div>
    </div>
  </div> 
</div>
</div>



  <div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3" style="max-width: 800px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-tarjetas/img13.png" class="img-fluid rounded-start">
    </div>
    <div class="col-md-4">
      <div class="card-body">
        <h5 class="card-title">Oferta Especial</h5>
        <h6 class="card-text">Con la compra de 1/2 kilo de helado tenes un cupon de 50% off en postres</h6>
        <span class="badge bg-warning text-dark">Oferta</span>
      </div>
    </div>
  </div> 
</div>
</div>



  <div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3" style="max-width: 800px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-tarjetas/img14.png" class="img-fluid rounded-start">
    </div>
    <div class="col-md-4">
      <div class="card-body">
        <h5 class="card-title">Oferta Para Compartir</h5>
        <h6 class="card-text"> Con tu compra tenes 15% de descuento total</h6>
        <span class="badge bg-warning text-dark">Oferta</span>
      </div>
    </div>
  </div> 
</div>
</div>
</div>
</body>
@endsection