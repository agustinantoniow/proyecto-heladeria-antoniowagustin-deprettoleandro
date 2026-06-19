@extends('components.layoutVisitante')
@section('title', 'heladeria - Productos')
@section('content')
{{-- PRUEBA DE FUEGO PARA LA SESIÓN --}}
@if(session()->has('success'))
    <div style="background: red; color: white; font-size: 40px; padding: 50px; position: fixed; top: 0; left: 0; z-index: 999999; width: 100%; text-align: center;">
        ¡SÍ LLEGA EL MENSAJE!: {{ session('success') }}
    </div>
@else
    <div style="background: black; color: white; font-size: 20px; padding: 10px; text-align: center;">
        ESTADO: NO HAY NINGÚN MENSAJE EN SESIÓN.
    </div>
@endif
{{-- Atrapa y muestra el mensaje de Producto Agregado (Éxito) --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center shadow-sm" role="alert" id="alerta-carrito" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
        <strong><i class="fa-solid fa-cart-arrow-down me-2"></i> ¡Genial!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Atrapa mensajes de Error (ej: No estás logueado, Falta stock) --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show text-center shadow-sm" role="alert" id="alerta-error" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
        <strong><i class="fa-solid fa-triangle-exclamation me-2"></i> Atención:</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<body>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;700&family=Montserrat:wght@600;800&display=swap" rel="stylesheet">

  <div class="container mx-auto" >
    <div class="text-center mt-4 mb-4">
    <h2 class="titulo-productos">
        Nuestros Productos 
    </h2>
</div>
    
 <h4 class="text-center bg-info text-white titulo-seccion-glace">
    Helados de agua
</h4>

<div class="row">
    <div class="col-sm-6 mb-4">
        <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
            <div class="row g-0 h-100">
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/imagenes-productos/img9.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body d-flex flex-column h-100">
                        <h5 class="card-title subtitulo-producto-glace">Frutilla</h5>
                        <p class="card-text card-text-glace flex-grow-1">Es una opción refrescante y de bajo contenido calórico para darse un gusto.</p>
                        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
                            @csrf
                            <input type="hidden" name="producto_id" value="1"> 
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mb-4">
        <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
            <div class="row g-0 h-100">
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/imagenes-productos/img11.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body d-flex flex-column h-100">
                        <h5 class="card-title subtitulo-producto-glace">Limón</h5>
                        <p class="card-text card-text-glace flex-grow-1">Una explosión cítrica y helada, perfecta para combatir el calor del verano correntino.</p>
                        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
                            @csrf
                            <input type="hidden" name="producto_id" value="2"> 
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mb-4">
        <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
            <div class="row g-0 h-100">
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/imagenes-productos/img10.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body d-flex flex-column h-100">
                        <h5 class="card-title subtitulo-producto-glace">Naranja</h5>
                        <p class="card-text card-text-glace flex-grow-1">Es una de las opciones más ligeras, ideal para hidratarse bajo el sol.</p>
                        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
                            @csrf
                            <input type="hidden" name="producto_id" value="3"> 
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mb-4">
        <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
            <div class="row g-0 h-100">
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/imagenes-productos/img12.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body d-flex flex-column h-100">
                        <h5 class="card-title subtitulo-producto-glace">Durazno</h5>
                        <p class="card-text card-text-glace flex-grow-1">Intenso sabor a Durazno, una explosión tropical con pocas calorías.</p>
                        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
                            @csrf
                            <input type="hidden" name="producto_id" value="4"> 
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mb-4">
        <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
            <div class="row g-0 h-100">
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/imagenes-tarjetas/img8.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body d-flex flex-column h-100">
                        <h5 class="card-title subtitulo-producto-glace">Mango</h5>
                        <p class="card-text card-text-glace flex-grow-1">Un nuevo sabor paradisíaco y delicioso, recién incorporado.</p>
                        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
                            @csrf
                            <input type="hidden" name="producto_id" value="5"> 
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mb-4">
        <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
            <div class="row g-0 h-100">
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/imagenes-tarjetas/img15.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body d-flex flex-column h-100">
                        <h5 class="card-title subtitulo-producto-glace">Ananá</h5>
                        <p class="card-text card-text-glace flex-grow-1">Un sabor tropical y ultra refrescante para cualquier momento.</p>
                        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
                            @csrf
                            <input type="hidden" name="producto_id" value="6"> 
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h4 class="text-center bg-success text-white titulo-seccion-glace">
    Postres Artesanales
</h4>

<div class="row">   
<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3 shadow-sm h-100" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0 h-100">
    <div class="col-md-6">
      <img src="{{ asset('imagenes/imagenes-productos/img13.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
    </div>
    <div class="col-md-6">
      <div class="card-body d-flex flex-column h-100">
        <h5 class="card-title">Tarta de Frutas</h5>
        <h6 class="card-text flex-grow-1"> Delicada combinación de crema artesanal y semifrío de frutos rojos sobre una base crocante de galletas.</h6>
        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
            @csrf
            <input type="hidden" name="producto_id" value="7"> 
            <input type="hidden" name="cantidad" value="1">
            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3 shadow-sm h-100" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0 h-100">
    <div class="col-md-6">
      <img src="{{ asset('imagenes/imagenes-productos/img14.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
    </div>
    <div class="col-md-6">
      <div class="card-body d-flex flex-column h-100">
        <h5 class="card-title">Copa Helada</h5>
        <h6 class="card-text flex-grow-1"> Tres bochas de chocolate artesanal, bañadas en fudge de cacao y decoradas con rulos de chocolate belga. </h6>
        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
            @csrf
            <input type="hidden" name="producto_id" value="8"> 
            <input type="hidden" name="cantidad" value="1">
            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3 shadow-sm h-100" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0 h-100">
    <div class="col-md-6">
      <img src="{{ asset('imagenes/imagenes-productos/img15.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
    </div>
    <div class="col-md-6">
      <div class="card-body d-flex flex-column h-100">
        <h5 class="card-title">Tiramisu</h5>
        <h6 class="card-text flex-grow-1"> Un clásico postre italiano, con capas de bizcocho, crema de mascarpone y cacao en polvo.</h6>
        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
            @csrf
            <input type="hidden" name="producto_id" value="9"> 
            <input type="hidden" name="cantidad" value="1">
            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>


<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3 shadow-sm h-100" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0 h-100">
    <div class="col-md-6">
      <img src="{{ asset('imagenes/imagenes-productos/img19.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
    </div>
    <div class="col-md-6">
      <div class="card-body d-flex flex-column h-100">
        <h5 class="card-title">Bombon Helado</h5>
        <h6 class="card-text flex-grow-1"> Combina la intensidad del mejor chocolate con un interior irresistiblemente suave.</h6>
        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
            @csrf
            <input type="hidden" name="producto_id" value="10"> 
            <input type="hidden" name="cantidad" value="1">
            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>


<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3 shadow-sm h-100" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0 h-100">
    <div class="col-md-6">
      <img src="{{ asset('imagenes/imagenes-tarjetas/img10.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
    </div>
    <div class="col-md-6">
      <div class="card-body d-flex flex-column h-100">
        <h5 class="card-title">Palito bombon relleno</h5>
        <h6 class="card-text flex-grow-1">Una capa gruesa de chocolate relleno con un dulce de leche artesanal</h6>
        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
            @csrf
            <input type="hidden" name="producto_id" value="11"> 
            <input type="hidden" name="cantidad" value="1">
            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<div class="col-sm-6 mb-3 mb-sm-0">
<div class="card mb-3 shadow-sm h-100" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0 h-100">
    <div class="col-md-6">
      <img src="{{ asset('imagenes/imagenes-tarjetas/img11.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
    </div>
    <div class="col-md-6">
      <div class="card-body d-flex flex-column h-100">
        <h5 class="card-title">Malteada de chocolate</h5>
        <h6 class="card-text flex-grow-1"> Es una opción nueva y refrescante, encontrala ya en nuestro menu.</h6>
        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
            @csrf
            <input type="hidden" name="producto_id" value="12"> 
            <input type="hidden" name="cantidad" value="1">
            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<h4 class="text-center bg-primary text-white titulo-seccion-glace mt-3">
    Línea Familiar
</h4>

<div class="row">
<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3 shadow-sm h-100" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0 h-100">
    <div class="col-md-6">
      <img src="{{ asset('imagenes/imagenes-productos/img16.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
    </div>
    <div class="col-md-6">
      <div class="card-body d-flex flex-column h-100">
        <h5 class="card-title">Super Dulce de Leche</h5>
        <h6 class="card-text flex-grow-1"> Nuestro sabor más premiado. ¡La tentación en un solo pote!</h6>
        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
            @csrf
            <input type="hidden" name="producto_id" value="13"> 
            <input type="hidden" name="cantidad" value="1">
            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3 shadow-sm h-100" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0 h-100">
    <div class="col-md-6">
      <img src="{{ asset('imagenes/imagenes-productos/img17.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
    </div>
    <div class="col-md-6">
      <div class="card-body d-flex flex-column h-100">
        <h5 class="card-title">Frutos del Bosque</h5>
        <h6 class="card-text flex-grow-1"> Nuestra base cremosa con abundante mermelada de frutos del bosque.</h6>
        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
            @csrf
            <input type="hidden" name="producto_id" value="14"> 
            <input type="hidden" name="cantidad" value="1">
            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3 shadow-sm h-100" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0 h-100">
    <div class="col-md-6">
      <img src="{{ asset('imagenes/imagenes-productos/img18.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
    </div>
    <div class="col-md-6">
      <div class="card-body d-flex flex-column h-100">
        <h5 class="card-title">Vainilla y Chocolate</h5>
        <h6 class="card-text flex-grow-1"> Remolinos de crema de vainilla y chocolate fundido, el equilibrio ideal.</h6>
        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
            @csrf
            <input type="hidden" name="producto_id" value="15"> 
            <input type="hidden" name="cantidad" value="1">
            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
        </form>
      </div>
    </div>
  </div> 
</div>
</div>

<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3 shadow-sm h-100" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0 h-100">
    <div class="col-md-6">
      <img src="{{ asset('imagenes/imagenes-tarjetas/img9.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
    </div>
    <div class="col-md-6">
      <div class="card-body d-flex flex-column h-100">
        <h5 class="card-title">Pote familiar dulce de leche</h5>
        <h6 class="card-text flex-grow-1">Para los amantes de lo chocolatoso esta es la opcion ideal</h6>
        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
            @csrf
            <input type="hidden" name="producto_id" value="16"> 
            <input type="hidden" name="cantidad" value="1">
            <button type="submit" class="btn btn-primary w-100 rounded-pill">Lo quiero</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
    
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Función reutilizable para ocultar cualquier alerta a los 3 segundos
        function ocultarAlerta(id) {
            const alerta = document.getElementById(id);
            if (alerta) {
                setTimeout(function() {
                    let alertInstance = new bootstrap.Alert(alerta);
                    alertInstance.close();
                }, 3000);
            }
        }
        
        // Llamamos a la función para la de éxito y la de error
        ocultarAlerta('alerta-carrito');
        ocultarAlerta('alerta-error');
    });
</script>
</body>
@endsection