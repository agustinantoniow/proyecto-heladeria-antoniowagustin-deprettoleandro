@extends('components.layoutCliente')
@section('title', 'heladeria - Productos')
@section('content')
<body>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;700&family=Montserrat:wght@600;800&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container mx-auto">
        <div class="text-center mt-4 mb-4">
            <h2 class="titulo-productos">Nuestros Productos</h2>
        </div>
        
        <h4 class="text-center bg-info text-white titulo-seccion-glace">Paletas de agua</h4>
        <div class="row">
@forelse (($productos ?? collect())->where('categoria', 'Paletas de agua') as $prod)                
<div class="col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
                        <div class="row g-0 h-100">
                            <div class="col-md-6">
                                <img src="{{ asset($prod->imagen ?? 'imagenes/imagenes-productos/img9.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body d-flex flex-column h-100">
                                    <h5 class="card-title subtitulo-producto-glace">{{ $prod->nombre }}</h5>
                                    <p class="card-text card-text-glace mb-auto">{{ $prod->descripcion }}</p>
                                    <p class="card-text fw-bold text-success mt-2">${{ number_format($prod->precio, 2, ',', '.') }}</p>
                                    
                                    @if($rol_usuario == 'admin')
                                        <div class="mt-3 d-flex gap-2">
                                            <a href="#" class="btn btn-sm btn-warning flex-grow-1">✏️ Editar (Stock: {{ $prod->stock }})</a>
                                        </div>
                                    @else
                                        <div class="mt-3">
                                            <button class="btn btn-primary w-100" onclick="agregarAlCarrito({{ $prod->id }}, '{{ addslashes($prod->nombre) }}', {{ $prod->precio }})">
                                                Añadir al Carrito 🍦
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-4">No hay paletas de agua cargadas en el sistema.</div>
            @endforelse
        </div>

        @if($rol_usuario == 'admin')
            <div class="text-center mb-5 mt-2">
                <a href="{{ route('productos.create') }}" class="btn btn-success px-4 py-2 shadow-sm">+ Añadir nuevo sabor...</a>
            </div>
        @endif


        <h4 class="text-center bg-success text-white titulo-seccion-glace mt-5">Postres Potentes</h4>
        <div class="row">   
            @forelse (($productos ?? collect())->where('categoria', 'Postres potentes') as $prod)
                <div class="col-sm-6 mb-4"> 
                    <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
                        <div class="row g-0 h-100">
                            <div class="col-md-6">
                                <img src="{{ asset($prod->imagen ?? 'imagenes/imagenes-productos/img13.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body d-flex flex-column h-100">
                                    <h5 class="card-title subtitulo-producto-glace">{{ $prod->nombre }}</h5>
                                    <p class="card-text card-text-glace mb-auto">{{ $prod->descripcion }}</p>
                                    <p class="card-text fw-bold text-success mt-2">${{ number_format($prod->precio, 2, ',', '.') }}</p>
                                    
                                    @if($rol_usuario == 'admin')
                                        <div class="mt-3">
                                            <a href="#" class="btn btn-sm btn-warning w-100">✏️ Editar (Stock: {{ $prod->stock }})</a>
                                        </div>
                                    @else
                                        <div class="mt-3">
                                            <button class="btn btn-primary w-100" onclick="agregarAlCarrito({{ $prod->id }}, '{{ addslashes($prod->nombre) }}', {{ $prod->precio }})">
                                                🛒 Agregar al carrito
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-4">No hay postres potentes cargados en el sistema.</div>
            @endforelse
        </div>

        @if($rol_usuario == 'admin')
            <div class="text-center mb-5 mt-2">
                <a href="{{ route('productos.create') }}" class="btn btn-success px-4 py-2 shadow-sm">+ Añadir nuevo sabor a Postres Potentes</a>
            </div>
        @endif


        <h4 class="text-center bg-primary text-white titulo-seccion-glace mt-5">Familiar</h4>
        <div class="row">
            @forelse (($productos ?? collect())->where('categoria', 'Familiar') as $prod)
                <div class="col-sm-6 mb-4"> 
                    <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
                        <div class="row g-0 h-100">
                            <div class="col-md-6">
                                <img src="{{ asset($prod->imagen ?? 'imagenes/imagenes-productos/img16.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body d-flex flex-column h-100">
                                    <h5 class="card-title subtitulo-producto-glace">{{ $prod->nombre }}</h5>
                                    <p class="card-text card-text-glace mb-auto">{{ $prod->descripcion }}</p>
                                    <p class="card-text fw-bold text-success mt-2">${{ number_format($prod->precio, 2, ',', '.') }}</p>
                                    
                                    @if($rol_usuario == 'admin')
                                        <div class="mt-3">
                                            <a href="#" class="btn btn-sm btn-warning w-100">✏️ Editar (Stock: {{ $prod->stock }})</a>
                                        </div>
                                    @else
                                        <div class="mt-3">
                                            <button class="btn btn-primary w-100" onclick="agregarAlCarrito({{ $prod->id }}, '{{ addslashes($prod->nombre) }}', {{ $prod->precio }})">
                                                🛒 Agregar al carrito
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-4">No hay potes familiares cargados en el sistema.</div>
            @endforelse
        </div>

        @if($rol_usuario == 'admin')
            <div class="text-center mb-5 mt-2">
                <a href="#" class="btn btn-success px-4 py-2 bg-primary">+ Añadir nuevo sabor a Familiar</a>
            </div>
        @endif
    </div>

    <script>
        function agregarAlCarrito(id, nombre, precio) {
            // Buscamos el token CSRF generado en el meta tag para validar la seguridad de Laravel
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Hacemos una petición POST asíncrona hacia la ruta encargada de añadir ítems en el backend
            fetch('/carrito/agregar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    producto_id: id,
                    cantidad: 1 // Por defecto sumamos una unidad por click
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al procesar la solicitud.');
                }
                return response.json();
            })
            .then(data => {
                // Notificación visual rápida de éxito
                alert(`¡Excelente elección! Agregaste "${nombre}" al carrito.`);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un inconveniente al intentar añadir el producto.');
            });
        }
    </script>
</body>
@endsection