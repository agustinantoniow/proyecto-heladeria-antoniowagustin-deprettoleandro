@extends('components.layout')
@section('title', 'heladeria - Comercialización')
@section('content')
<body>
    
<style>
  .mi-recuadro {
    
    background-color: #add8e6; 
    
    
    padding: 20px;
    
    
    border-radius: 8px;
    
   
    border: 1px solid #87ceeb;
    
    
    max-width: 400px;
    
    
    font-family: Arial, sans-serif;
    color: #333;
    
    
    margin: 20px 0 20px 10px;
  }
</style>

<div class="container">
  <div class="row align-items-start"> 
    
    <div class="col-md-5 mt-2">
      <div class="mi-recuadro">
        <h2>Tipos de Entregas</h2>
        <p>-Retiro en mostrador</p>
        <p>-Envio a domicilio</p>
      </div>

      <div class="mi-recuadro">
        <h2>Formas de envio</h2>
        <p>-Moto mandado</p>
        <p>-Delivery</p>
        <p>-Take away</p>
      </div>

      <div class="mi-recuadro">
        <h2>Pagos</h2>
        <p>-Efectivo</p>
        <p>-Debito</p>
        <p>-Transferencia bancaria</p>
      </div>
    </div>

    <div class="col-md-7 mt-2">
      <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="imagenes/carrusel-comercializacion/img1.png" class="d-block w-100 rounded" alt="Imagen 1">
          </div>
          <div class="carousel-item">
            <img src="imagenes/carrusel-comercializacion/img2.png" class="d-block w-100 rounded" alt="Imagen 2">
          </div>
          <div class="carousel-item">
            <img src="imagenes/carrusel-comercializacion/img3.png" class="d-block w-100 rounded" alt="Imagen 2">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

  </div> 
</div>




  </div>

@endsection


</body>
</html>