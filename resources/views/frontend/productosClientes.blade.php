
@extends('components.layoutCliente')
@section('title', 'Nuestros Productos - Heladería Glace')
@section('content')

<div class="container mt-5 mb-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-info" style="font-family: 'Fredoka', sans-serif;">Nuestros Sabores</h1>
        <p class="text-muted" style="font-family: 'Montserrat', sans-serif;">Disfrutá del verdadero helado artesanal</p>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($productos as $prod)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                    
                    @if($prod->imagen)
                        <img src="{{ asset('uploads/productos/' . $prod->imagen) }}" class="card-img-top" alt="{{ $prod->nombre }}" style="height: 240px; object-fit: cover;">
                    @else
                        <img src="{{ asset('imagenes/imagenes-pagina-principal/img2.png') }}" class="card-img-top" alt="Heladería Glace" style="height: 240px; object-fit: cover;">
                    @endif

                    <div class="card-body p-4 d-flex flex-column">
                        <span class="badge bg-info-subtle text-info mb-2 rounded-pill px-3 py-1 text-uppercase small fw-bold" style="width: fit-content;">
                            {{ $prod->categoria->nombre ?? 'Helado' }}
                        </span>
                        
                        <h4 class="card-title fw-bold text-dark mb-2" style="font-family: 'Fredoka', sans-serif;">
                            {{ $prod->nombre }}
                        </h4>
                        
                        <p class="card-text text-muted small flex-grow-1" style="font-family: 'Montserrat', sans-serif;">
                            {{ $prod->descripcion ?? 'Sin descripción disponible por el momento.' }}
                        </p>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                            <div>
                                <span class="text-muted small d-block">Precio</span>
                                <h4 class="fw-bold text-success mb-0">${{ number_format($prod->precio, 2) }}</h4>
                            </div>
                            
                            @if($prod->stock > 0)
                                <button class="btn btn-info text-white fw-bold px-4 py-2 rounded-3 shadow-sm">
                                    <i class="fa-solid fa-cart-shopping me-1"></i> Comprar
                                </button>
                            @else
                                <span class="badge bg-danger p-2 rounded-3">Sin Stock</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No hay productos disponibles para la compra en este momento.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection