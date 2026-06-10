@extends('components.layoutCliente')
@section('title', 'Nuestros Productos - Heladería Glace')
@section('content')

<div class="container mt-5 mb-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-info" style="font-family: 'Fredoka', sans-serif;">Nuestros Sabores</h1>
        <p class="text-muted" style="font-family: 'Montserrat', sans-serif;">Disfrutá del verdadero helado artesanal</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
                            
          <div class="mt-3">
    @if($prod->activo)
        {{-- Formulario vinculado al método agregar de tu CarritoController --}}
        <form action="{{ route('carrito.agregar') }}" method="POST">
            @csrf
            {{-- CRÍTICO: Enviamos el ID del producto que espera el $request->validate() --}}
            <input type="hidden" name="producto_id" value="{{ $prod->id }}">

            <div class="d-flex gap-2">
                
                <div class="input-group" style="width: 130px;">
                    <button class="btn btn-outline-secondary px-2" type="button" onclick="decrementarCantidad({{ $prod->id }})">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                    <input type="number" 
                           id="cantidad-{{ $prod->id }}" 
                           name="cantidad" 
                           class="form-control text-center p-1" 
                           value="1" 
                           min="1" 
                           max="{{ $prod->stock }}" 
                           readonly 
                           style="font-weight: bold;">
                    <button class="btn btn-outline-secondary px-2" type="button" onclick="incrementarCantidad({{ $prod->id }}, {{ $prod->stock }})">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

                <button type="submit" class="btn btn-primary flex-grow-1">
                    <i class="fa-solid fa-cart-plus me-1"></i> Agregar
                </button>
                
            </div>
        </form>
    @else
        <div class="alert alert-warning text-center py-2 px-3 m-0 rounded-3 shadow-sm" role="alert" style="font-size: 0.9rem;">
            <i class="fa-solid fa-circle-pause me-1"></i> Producto pausado
        </div>
        <button type="button" class="btn btn-secondary w-100 mt-2" disabled>
            No disponible
        </button>
    @endif
</div>
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

<script>
 function incrementarCantidad(id, stockMaximo) {
    const input = document.getElementById(`cantidad-${id}`);
    let valorActual = parseInt(input.value);
    
    // Suma solo si el valor actual es estrictamente menor al stock real
    if (valorActual < stockMaximo) {
        input.value = valorActual + 1;
    }
    // Si llegó al máximo, no hace nada ni muestra alertas flotantes
}

function decrementarCantidad(id) {
    const input = document.getElementById(`cantidad-${id}`);
    let valorActual = parseInt(input.value);
    
    // Resta solo si es mayor a 1
    if (valorActual > 1) {
        input.value = valorActual - 1;
    }
}
</script>

@endsection