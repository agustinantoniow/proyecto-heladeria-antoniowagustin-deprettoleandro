@extends('components.layoutCliente')
 @section('content')
<div class="container my-5">
    <h1 class="text-center mb-4 text-uppercase fw-bold text-primary">{{ $categoria->nombre }}</h1>
    <p class="text-center text-muted mb-5">{{ $categoria->descripcion }}</p>

    <div class="row">
        @forelse($productos as $producto)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm product-card">
                    @if($producto->imagen)
                        <img src="{{ asset('uploads/productos/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fa-solid fa-ice-cream fa-3x text-muted"></i>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title fw-bold">{{ $producto->nombre }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($producto->descripcion, 60) }}</p>
                        </div>
                        
                        <div class="mt-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-success fw-bold fs-5">${{ number_format($producto->precio, 2, ',', '.') }}</span>
                                <span class="badge {{ $producto->stock <= 5 ? 'bg-danger' : 'bg-secondary' }}">
                                    Stock: {{ $producto->stock }} u.
                                </span>
                            </div>

                            <form action="{{ route('carrito.agregar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                <input type="hidden" name="cantidad" value="1">
                                
                                <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="fa-solid fa-cart-plus"></i> Agregar al carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">Por el momento no hay productos disponibles en esta categoría.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection