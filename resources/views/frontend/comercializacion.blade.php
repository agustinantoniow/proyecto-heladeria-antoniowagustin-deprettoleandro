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

<div class="container mt-5">
    <div class="row align-items-center"> 
        
        <div class="col-md-5">
            <div class="presentacion p-4 mb-4 rounded-4 shadow-sm">
                <h2 class="subtitulo-producto-glace">Tipos de Entregas</h2>
                <p class="card-text-glace mb-1">- Retiro en mostrador</p>
                <p class="card-text-glace mb-0">- Envío a domicilio</p>
            </div>

            <div class="presentacion p-4 mb-4 rounded-4 shadow-sm">
                <h2 class="subtitulo-producto-glace">Formas de envío</h2>
                <p class="card-text-glace mb-1">- Moto mandado</p>
                <p class="card-text-glace mb-1">- Delivery propio</p>
                <p class="card-text-glace mb-0">- Take away</p>
            </div>

            <div class="presentacion p-4 mb-4 rounded-4 shadow-sm">
                <h2 class="subtitulo-producto-glace">Pagos</h2>
                <p class="card-text-glace mb-1">- Efectivo</p>
                <p class="card-text-glace mb-1">- Débito / Crédito</p>
                <p class="card-text-glace mb-0">- Transferencia bancaria</p>
            </div>
        </div>

        <div class="col-md-7">
            <div id="carouselExampleComercial" class="carousel slide shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('imagenes/carrusel-comercializacion/img1.png') }}" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Logística Glace">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('imagenes/carrusel-comercializacion/img2.png') }}" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Pagos">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('imagenes/carrusel-comercializacion/img3.png') }}" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Delivery">
                    </div>
                </div>
                
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleComercial" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleComercial" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>

    </div> 
</div>

@endsection


</body>
</html>