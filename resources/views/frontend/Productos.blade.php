  @extends('components.layout')
@section('title', 'heladeria - Productos')
@section('content')
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
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/imagenes-productos/img9.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title subtitulo-producto-glace">Frutilla</h5>
                        <p class="card-text card-text-glace">Es una opción refrescante y de bajo contenido calórico para darse un gusto.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mb-4">
        <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/imagenes-productos/img11.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title subtitulo-producto-glace">Limón</h5>
                        <p class="card-text card-text-glace">Una explosión cítrica y helada, perfecta para combatir el calor del verano correntino.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mb-4">
        <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/imagenes-productos/img10.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title subtitulo-producto-glace">Naranja</h5>
                        <p class="card-text card-text-glace">Es una de las opciones más ligeras, ideal para hidratarse bajo el sol.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mb-4">
        <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/imagenes-productos/img12.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title subtitulo-producto-glace">Durazno</h5>
                        <p class="card-text card-text-glace">Intenso sabor a Durazno, una explosión tropical con pocas calorías.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mb-4">
        <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/imagenes-tarjetas/img8.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title subtitulo-producto-glace">Mango</h5>
                        <p class="card-text card-text-glace">Un nuevo sabor paradisíaco y delicioso, recién incorporado.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mb-4">
        <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/imagenes-tarjetas/img15.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title subtitulo-producto-glace">Ananá</h5>
                        <p class="card-text card-text-glace">Un sabor tropical y ultra refrescante para cualquier momento.</p>
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
    <div class="col-sm-6 mb-4">
        <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/imagenes-productos/img13.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title subtitulo-producto-glace">Tarta de Frutas</h5>
                        <p class="card-text card-text-glace">Delicada combinación de crema artesanal y frutos rojos sobre base crocante.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mb-4">
        <div class="card h-100 shadow-sm" style="max-width: 600px; overflow: hidden;">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/imagenes-productos/img19.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title subtitulo-producto-glace">Bombón Helado</h5>
                        <p class="card-text card-text-glace">Intensidad de chocolate con un interior suave. El brillo artesanal de Glace.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

<h4 class="text-center bg-primary text-white titulo-seccion-glace">
    Línea Familiar
</h4>

<div class="row">
    <div class="col-sm-6 mb-4">
        <div class="card h-100 shadow-sm border-info" style="max-width: 600px; overflow: hidden;">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/imagenes-productos/img16.png') }}" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title subtitulo-producto-glace">Súper Dulce de Leche</h5>
                        <p class="card-text card-text-glace">Nuestro sabor más premiado. ¡La tentación en un solo pote!</p>
                        <span class="badge bg-warning text-dark">Sabor más Recomendado</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
    
  

</body>
@endsection