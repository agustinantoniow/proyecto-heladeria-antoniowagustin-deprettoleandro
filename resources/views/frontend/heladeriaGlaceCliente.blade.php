@extends('components.layoutCliente')
@section('title', 'heladeria - Inicio')
@section('content')
<body class="bg-terciary">

<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="3000" >
      <img src="imagenes/imagenes-pagina-principal/img1.png" class="d-block w-100 mx-auto" alt="..."width="700" height="600">
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="imagenes/imagenes-pagina-principal/img2.png" class="d-block w-100 mx-auto" alt="..."width="700" height="600">
    </div>
    <div class="carousel-item">
      <img src="imagenes/imagenes-pagina-principal/img3.png" class="d-block w-100 mx-auto" alt="..."width="700" height="600">
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

<div class="text-center mt-5 mb-5">
    <h2 class="titulo-productos">Nuestros Productos</h2>
</div>

<div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        
        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ asset('imagenes/imagenes-tarjetas/img4.png') }}" class="card-img-top" alt="Helados de agua" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    
                    <h3 class="card-title-home fondo-amarillo text-center">Helados de agua</h3>
                    <div class="list-group list-group-flush">
                        <span class="item-sabor-home">Frutilla</span>
                        <span class="item-sabor-home">Naranja</span>
                        <span class="item-sabor-home">Limón</span>
                        <span class="item-sabor-home">Durazno</span>
                    </div>
                    <div class="text-center">
                        <a href="/ver mas...Cliente" class="btn-ver-mas">Ver catálogo completo →</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ asset('imagenes/imagenes-tarjetas/img6.png') }}" class="card-img-top" alt="Postres" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h3 class="card-title-home fondo-verde text-center">Postres</h3>
                    <div class="list-group list-group-flush">
                        <span class="item-sabor-home">Tarta de Frutas</span>
                        <span class="item-sabor-home">Copa Helada</span>
                        <span class="item-sabor-home">Tiramisú</span>
                        <span class="item-sabor-home">Bombón Helado</span>
                    </div>
                    <div class="text-center">
                        <a href="/ver mas....Cliente" class="btn-ver-mas">Ver catálogo completo →</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ asset('imagenes/imagenes-tarjetas/img7.png') }}" class="card-img-top" alt="Línea familiar" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h3 class="card-title-home fondo-azul text-center">Línea familiar</h3>
                    <div class="list-group list-group-flush">
                        <span class="item-sabor-home">Frutos del Bosque</span>
                        <span class="item-sabor-home">Súper Dulce de Leche</span>
                        <span class="item-sabor-home">Vainilla y Chocolate</span>
                        <span class="item-sabor-home">Dulce de Leche y Granizado</span>
                    </div>
                    <div class="text-center">
                        <a href="/ver mas..Cliente  " class="btn-ver-mas">Ver catálogo completo →</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div
  class="text-center mt-4 mb-4">
      <h2 class="titulo-productos">
          Recomendados
      </h2>
</div>

<div class="row">
<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="2000">
      <img src="imagenes/imagenes-pagina-principal/img4.png" class="d-block w-100" width="400" height="550" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="imagenes/imagenes-pagina-principal/img5.png" class="d-block w-100" width="400" height="550"  alt="...">
    </div>
    <div class="carousel-item">
      <img src="imagenes/imagenes-pagina-principal/img6.png" class="d-block w-100" width="400" height="550" alt="...">
    </div>
  </div>
 

<div class="container presentacion mt-4 mb-4">
    <div class="text-center p-2">
        <h2 class="titulo-novedades-v2">
            Novedades
        </h2>
    </div>
</div>

<div class="container">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        
        <div class="col">
            <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
                <div class="row g-0 h-100">
                    <div class="col-md-6">
                        <img src="{{ asset('imagenes/imagenes-tarjetas/img8.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title subtitulo-producto-glace">Helado sabor Mango</h5>
                            <p class="card-text card-text-glace">Un nuevo sabor paradisíaco y delicioso, ideal para los amantes de las frutas tropicales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
                <div class="row g-0 h-100">
                    <div class="col-md-6">
                        <img src="{{ asset('imagenes/imagenes-tarjetas/img11.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title subtitulo-producto-glace">Malteada de chocolate</h5>
                            <p class="card-text card-text-glace">Es una opción nueva y refrescante, encontrala ya disponible en nuestro menú exclusivo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
                <div class="row g-0 h-100">
                    <div class="col-md-6">
                        <img src="{{ asset('imagenes/imagenes-tarjetas/img9.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title subtitulo-producto-glace">Pote Especial Familiar</h5>
                            <p class="card-text card-text-glace">Dulce de leche, granizado y chocolate blanco: la combinación ideal para los amantes de lo chocolatoso.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
                <div class="row g-0 h-100">
                    <div class="col-md-6">
                        <img src="{{ asset('imagenes/imagenes-tarjetas/img10.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title subtitulo-producto-glace">Palito Bombón Relleno</h5>
                            <p class="card-text card-text-glace">Una capa gruesa de chocolate crujiente relleno con nuestro dulce de leche artesanal más suave.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container p-2 text-center mt-4 mb-4">
    <h2 class="titulo-ofertas-sticker">
        Ofertas Imperdibles
    </h2>
</div>

<div class="container">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        
        <div class="col">
            <div class="card h-100 shadow border-danger" style="max-width: 800px; overflow: hidden; border-width: 2px;">
                <div class="row g-0 h-100">
                    <div class="col-md-6">
                        <img src="{{ asset('imagenes/imagenes-tarjetas/img12.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h5 class="subtitulo-oferta-glace">Oferta Especial</h5>
                            <p class="card-text-glace">¡Llevate <b>1/4 de regalo</b> con la compra de 1 kilo de helado! Ideal para probar ese sabor que siempre te dio curiosidad.</p>
                            <div>
                                <span class="badge bg-danger">PROMO 1kg + 1/4</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow border-danger" style="max-width: 800px; overflow: hidden; border-width: 2px;">
                <div class="row g-0 h-100">
                    <div class="col-md-6">
                        <img src="{{ asset('imagenes/imagenes-tarjetas/img13.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h5 class="subtitulo-oferta-glace">Promo Dulce</h5>
                            <p class="card-text-glace">Con la compra de <b>1/2 kilo</b>, te damos un cupón del <b>50% OFF</b> en cualquier postre de nuestra línea artesanal.</p>
                            <div>
                                <span class="badge bg-danger">50% OFF POSTRES</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow border-danger" style="max-width: 800px; overflow: hidden; border-width: 2px;">
                <div class="row g-0 h-100">
                    <div class="col-md-6">
                        <img src="{{ asset('imagenes/imagenes-tarjetas/img14.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h5 class="subtitulo-oferta-glace">Para Compartir</h5>
                            <p class="card-text-glace">¿Vienen en grupo? Aprovechen un <b>15% de descuento</b> en el total de su compra pagando en efectivo.</p>
                            <div>
                                <span class="badge bg-danger">15% DESCUENTO</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>





   
</body>
@endsection