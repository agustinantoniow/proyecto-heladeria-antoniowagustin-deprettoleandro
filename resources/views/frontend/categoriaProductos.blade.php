@extends('components.layoutCliente') {{-- Tu layout para clientes --}}

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <span class="badge bg-warning text-dark text-uppercase px-3 py-2 rounded-pill mb-2">Categoría</span>
        <h1 class="display-4 fw-bold text-uppercase text-dark" style="font-family: 'Fredoka', sans-serif;">
            {{ $categoria->nombre }}
        </h1>
        <p class="text-muted">Disfruta de nuestra variedad de sabores seleccionados de la casa</p>
    </div>

    <div class="row">
        @forelse($productos as $prod)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                    
                    @if($prod->imagen)
                        <img src="{{ asset('uploads/productos/' . $prod->imagen) }}" alt="{{ $prod->nombre }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span class="text-muted small">Sin foto</span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column justify-content-between text-center">
                        <div>
                            <h5 class="card-title fw-bold text-dark text-capitalize mb-2">{{ $prod->nombre }}</h5>
                        </div>
                        <div class="mt-3">
    <p class="card-text text-success fw-bold fs-5 mb-3">${{ number_format($prod->precio, 2) }}</p>
    
    {{-- Lógica de botones según estado y stock --}}
    @if(!$prod->activo)
        {{-- Si el producto está PAUSADO (activo = false) --}}
        <button class="btn btn-secondary btn-sm w-100 rounded-pill fw-bold" disabled>
            <i class="fa-solid fa-ban me-1"></i> No disponible
        </button>
        <small class="text-danger d-block mt-1">Publicación pausada</small>

    @elseif($prod->stock <= 0)
        {{-- Si el producto está activo, pero NO HAY STOCK --}}
        <button class="btn btn-danger btn-sm w-100 rounded-pill fw-bold" disabled>
            <i class="fa-solid fa-box-open me-1"></i> Sin Stock
        </button>
        <small class="text-muted d-block mt-1">Agotado temporalmente</small>

    @else
        {{-- Si está activo y tiene stock mayor a 0 --}}
        <button class="btn btn-outline-info btn-sm w-100 rounded-pill fw-bold">
            <i class="fa-solid fa-basket-shopping me-1"></i> Añadir al pedido
        </button>
    @endif
</div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center my-5">
                <div class="alert alert-light p-5 shadow-sm rounded-3">
                    <i class="fa-solid fa-ice-cream text-muted display-1 mb-3"></i>
                    <h4 class="text-dark">¡Por el momento no hay sabores disponibles!</h4>
                    <p class="text-muted">Estamos preparando más producción para esta sección de {{ $categoria->nombre }}.</p>
                    <a href="/" class="btn btn-primary btn-sm mt-2 rounded-pill">Volver al inicio</a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection