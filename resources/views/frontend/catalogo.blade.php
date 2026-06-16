@extends('components.LayoutCliente')

@section('content')
<div class="container mt-5 mb-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold" style="font-family: 'Fredoka', sans-serif; color: #ff6b6b;">Nuestros Helados y Postres</h1>
        <p class="text-muted">Descubrí todos los sabores que tenemos preparados para vos.</p>
    </div>

    <div class="d-flex justify-content-center flex-wrap gap-2 mb-5">
        <button class="btn btn-danger btn-filtro active" data-filtro="todos">
            Todos
        </button>
        
        @foreach($categorias as $cat)
            <button class="btn btn-outline-danger btn-filtro" data-filtro="cat-{{ $cat->id }}">
                {{ $cat->nombre }}
            </button>
        @endforeach
    </div>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4" id="contenedor-productos">
        
        @foreach($productos as $prod)
            <div class="col item-producto cat-{{ $prod->categoria_id ?? 'sin-categoria' }}">
                <div class="card h-100 shadow-sm border-0 hover-efecto">
                    
                    @if($prod->imagen)
                        <img src="{{ asset('imagenes/productos/' . $prod->imagen) }}" class="card-img-top rounded-top-3" alt="{{ $prod->nombre }}" style="height: 220px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center rounded-top-3" style="height: 220px;">
                            <span class="text-muted"><i class="fa-solid fa-ice-cream fa-3x"></i></span>
                        </div>
                    @endif

                    <div class="card-body text-center d-flex flex-column">
                        <div>
                            <span class="badge bg-secondary mb-2">{{ $prod->categoria->nombre ?? 'Heladería' }}</span>
                        </div>
                        
                        <h5 class="card-title fw-bold text-dark">{{ $prod->nombre }}</h5>
                        
                        <div class="mt-auto">
                            <p class="card-text fs-4 text-success fw-bold mb-0">${{ number_format($prod->precio, 2) }}</p>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-white border-0 text-center pb-4 pt-0">
                        <form action="{{ route('carrito.agregar') }}" method="POST">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $prod->id }}">
                            
                            <input type="hidden" name="cantidad" value="1">
                            
                            <button type="submit" class="btn btn-outline-danger w-100 rounded-pill fw-bold">
                                <i class="fa-solid fa-cart-shopping me-1"></i> Lo quiero!
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    @if($productos->isEmpty())
        <div class="row">
            <div class="col-12 text-center py-5">
                <h3 class="text-muted">¡Ups! En este momento no tenemos helados publicados.</h3>
                <p>Volvé a intentar más tarde.</p>
            </div>
        </div>
    @endif

</div>

<style>
    .hover-efecto {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-efecto:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    /* Transición suave para cuando se ocultan las tarjetas */
    .item-producto {
        transition: opacity 0.4s ease-in-out;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Capturamos todos los botones y todas las tarjetas
    const botonesFiltro = document.querySelectorAll('.btn-filtro');
    const tarjetasProductos = document.querySelectorAll('.item-producto');

    botonesFiltro.forEach(boton => {
        boton.addEventListener('click', function () {
            // 1. Efecto visual en los botones: Le sacamos el color relleno a todos y se lo ponemos al que hicimos click
            botonesFiltro.forEach(b => {
                b.classList.remove('btn-danger', 'active');
                b.classList.add('btn-outline-danger');
            });
            this.classList.remove('btn-outline-danger');
            this.classList.add('btn-danger', 'active');

            // 2. Averiguamos qué categoría quiere ver (ej: "cat-1" o "todos")
            const filtroElegido = this.getAttribute('data-filtro');

            // 3. Recorremos todas las tarjetas para mostrarlas u ocultarlas
            tarjetasProductos.forEach(tarjeta => {
                if (filtroElegido === 'todos') {
                    // Si eligió "Todos", mostramos todo sacando el d-none de Bootstrap
                    tarjeta.classList.remove('d-none');
                } else {
                    // Si la tarjeta tiene la clase de la categoría elegida, la mostramos. Si no, la ocultamos.
                    if (tarjeta.classList.contains(filtroElegido)) {
                        tarjeta.classList.remove('d-none');
                    } else {
                        tarjeta.classList.add('d-none');
                    }
                }
            });
        });
    });
});
</script>
@endsection