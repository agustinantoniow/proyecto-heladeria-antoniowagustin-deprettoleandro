@extends('components.layoutVisitante')
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
<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-productos/img13.png" class="img-fluid rounded-start">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">Tarta de Frutas</h5>
        <h6 class="card-text"> Delicada combinación de crema artesanal y semifrío de frutos rojos sobre una base crocante de galletas.</h6>
      </div>
    </div>
  </div>
</div>
</div>

<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-productos/img14.png" class="img-fluid rounded-start">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">Copa Helada</h5>
        <h6 class="card-text"> Tres bochas de chocolate artesanal, bañadas en fudge de cacao y decoradas con rulos de chocolate belga. </h6>
       
        </div>
    </div>
  </div>
</div>
</div>

<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-productos/img15.png" class="img-fluid rounded-start">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">Tiramisu</h5>
        <h6 class="card-text"> Un clásico postre italiano, con capas de bizcocho, crema de mascarpone y cacao en polvo.</h6>
      </div>
    </div>
  </div>
</div>
</div>


<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-productos/img19.png" class="img-fluid rounded-start">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">Bombon Helado</h5>
        <h6 class="card-text"> combina la intensidad del mejor chocolate con un interior irresistiblemente suave. Textura, brillo y el sabor artesanal que nos distingue en cada bocado.</h6>
      </div>
    </div>
  </div>
</div>
</div>


<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-tarjetas/img10.png" class="img-fluid rounded-start">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">Palito bombon relleno</h5>
        <h6>una capa gruesa de chocolate relleno con un dulce de leche artesanal</h6>
      </div>
    </div>
  </div>
</div>
</div>

  <div class="col-sm-6 mb-3 mb-sm-0">
<div class="card mb-3" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-tarjetas/img11.png" class="img-fluid rounded-star">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">Malteada de chocolate</h5>
        <h6 class="card-text"> Es una opción nueva y refrescante, encontrala ya en nuestro menu.</h6>
      </div>
    </div>
  </div>
</div>
</div>

<h4 class="text-center bg-primary text-white titulo-seccion-glace">
    Línea Familiar
</h4>

   <div class = "row" >
  <div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-productos/img16.png" class="img-fluid rounded-start">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">Super Dulce de Leche</h5>
        <h6 class="card-text"> Nuestro sabor más premiado.¡La tentación en un solo pote!</h6>
       
      </div>
    </div>
  </div>
</div>
</div>

  <div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-productos/img17.png" class="img-fluid rounded-start">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">Frutos del Bosque</h5>
        <h6 class="card-text"> Nuestra base cremosacon abundante mermelada de frutos del bosque y trozos de frutas silvestres. Frescura y cremosidad en un solo pote.</h6>
      </div>
    </div>
  </div>
</div>
</div>

  <div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-productos/img18.png" class="img-fluid rounded-start">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">Vainilla y Chocolate</h5>
        <h6 class="card-text"> Remolinos de crema de vainilla y chocolate fundido, el equilibrio ideal entre suavidad y textura.</h6>
       
      </div>
    </div>
  </div> 
</div>
</div>

<div class="col-sm-6 mb-3 mb-sm-0"> 
<div class="card mb-3" style="max-width: 600px; overflow: hidden;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="imagenes/imagenes-tarjetas/img9.png" class="img-fluid rounded-start">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">Pote familiar dulce de leche, granizado y chocolate blanco</h5>
        <h6>Para los amantes de lo chocolatoso esta es la opcion ideal</h6>
      </div>
    </div>
  </div>
</div>
</div>
    
  

</body>
@endsection