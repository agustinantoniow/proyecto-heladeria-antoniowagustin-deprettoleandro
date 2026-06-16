@extends('components.layoutCliente')
@section('title', 'Heladería Glace - Inicio')
@section('content')
<body class="bg-terciary">

{{-- Carrusel Principal Superior (Estático) --}}
<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="3000">
      <img src="{{ asset('imagenes/imagenes-pagina-principal/img1.png') }}" class="d-block w-100 mx-auto" alt="Banner 1" width="700" height="600">
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="{{ asset('imagenes/imagenes-pagina-principal/img2.png') }}" class="d-block w-100 mx-auto" alt="Banner 2" width="700" height="600">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('imagenes/imagenes-pagina-principal/img3.png') }}" class="d-block w-100 mx-auto" alt="Banner 3" width="700" height="600">
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

{{-- SECCIÓN 1: NUESTROS PRODUCTOS (Agrupados por Categoría Dinámica) --}}
<div class="text-center mt-5 mb-5">
    <h2 class="titulo-productos">Nuestros Productos</h2>
</div>

<div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @php $colores = ['fondo-amarillo', 'fondo-verde', 'fondo-azul']; @endphp
        
        @foreach($categorias as $cat)
            @php $colorActual = $colores[$loop->index % 3]; @endphp
            <div class="col" id="cat-{{ $cat->id }}">
                <div class="card h-100 shadow-sm border-0">
                    @if($cat->productos->first() && $cat->productos->first()->imagen)
                        <img src="{{ asset('imagenes/productos/' . $cat->productos->first()->imagen) }}" class="card-img-top" alt="{{ $cat->nombre }}" style="height: 250px; object-fit: cover;">
                    @else
                        <img src="{{ asset('imagenes/imagenes-tarjetas/img4.png') }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h3 class="card-title-home {{ $colorActual }} text-center">{{ $cat->nombre }}</h3>
                        <div class="list-group list-group-flush mb-3">
                            @foreach($cat->productos->take(4) as $prod)
                                <span class="item-sabor-home">{{ $prod->nombre }}</span>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <a href="{{ route('catalogo.publico') }}#cat-{{ $cat->id }}" class="btn-ver-mas">Ver catálogo completo →</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- SECCIÓN 2: RECOMENDADOS (Productos más vendidos en Carrusel) --}}
<div class="text-center mt-5 mb-4">
    <h2 class="titulo-productos">Recomendados (Los más elegidos)</h2>
</div>

<div class="container mb-5">
    <div id="carouselRecomendados" class="carousel slide shadow rounded-4 overflow-hidden" data-bs-ride="carousel">
        <div class="carousel-inner">
            @forelse($recomendados as $prod)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="2500">
                    <img src="{{ $prod->imagen ? asset('imagenes/productos/' . $prod->imagen) : asset('imagenes/imagenes-pagina-principal/img4.png') }}" class="d-block w-100" width="400" height="550" style="object-fit: cover;" alt="{{ $prod->nombre }}">
                    <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 10px;">
                        <h5>{{ $prod->nombre }}</h5>
                        <p>¡El preferido de nuestros clientes! Buscalo en nuestro menú.</p>
                    </div>
                </div>
            @empty
                <div class="carousel-item active">
                    <img src="{{ asset('imagenes/imagenes-pagina-principal/img4.png') }}" class="d-block w-100" width="400" height="550" style="object-fit: cover;">
                </div>
            @endforelse
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselRecomendados" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselRecomendados" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

{{-- SECCIÓN 3: NOVEDADES (Últimos productos agregados) --}}
<div class="container presentacion mt-4 mb-4">
    <div class="text-center p-2">
        <h2 class="titulo-novedades-v2">Novedades recién llegadas</h2>
    </div>
</div>

<div class="container">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($novedades as $prod)
            <div class="col">
                <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
                    <div class="row g-0 h-100">
                        <div class="col-md-6">
                            <img src="{{ $prod->imagen ? asset('imagenes/productos/' . $prod->imagen) : asset('imagenes/imagenes-tarjetas/img8.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover; min-height: 180px;">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h5 class="card-title subtitulo-producto-glace">{{ $prod->nombre }}</h5>
                                <p class="card-text card-text-glace">{{ $prod->descripcion ?? 'Un nuevo sabor paradisíaco y delicioso, incorporado recientemente a nuestro menú exclusivo.' }}</p>
                                <span class="text-success fw-bold mt-2">${{ number_format($prod->precio, 2, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- SECCIÓN 4: OFERTAS IMPERDIBLES (Productos de la categoría seleccionada) --}}
<div class="container p-2 text-center mt-5 mb-4">
    <h2 class="titulo-ofertas-sticker">Ofertas Imperdibles</h2>
</div>

<div class="container mb-5">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($productosOferta as $prod)
            <div class="col">
                <div class="card h-100 shadow border-danger" style="max-width: 800px; overflow: hidden; border-width: 2px;">
                    <div class="row g-0 h-100">
                        <div class="col-md-6">
                            <img src="{{ $prod->imagen ? asset('imagenes/productos/' . $prod->imagen) : asset('imagenes/imagenes-tarjetas/img12.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover; min-height: 200px;">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h5 class="subtitulo-oferta-glace">{{ $prod->nombre }}</h5>
                                <p class="card-text-glace">¡Llevate este producto de nuestra línea premium con descuento especial de temporada!</p>
                                <div class="mt-2">
                                    <span class="badge bg-danger">PROMO {{ $prod->categoria->nombre ?? 'ESPECIAL' }}</span>
                                    <span class="text-dark fw-bold ms-2">${{ number_format($prod->precio, 2, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    html { scroll-behavior: smooth; }
</style>

</body>
@endsection