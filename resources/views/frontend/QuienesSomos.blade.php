@extends('components.layout')
@section('title', 'heladeria - QuienesSomos')
@section('content')

<body> 

<div class="seccion-nosotros col-md-11 mx-auto mt-4">

  <h2 class="col-md-2 mx-auto mt-4">Quiénes Somos</h2>
  <p class="col-md-10 mx-auto mt-4">
    Somos una pequeña empresa formada por cinco amigos los cuales que decidieron emprender en el mundo de los helados, empezamos hace menos de 6 meses pero es algo a lo que dediamos todo nuestro tiempo y ganas
        con el objetivo de poder crecer en este gran negocio y brindar un buen servicio
        a nuestros clientes, trabajamos arduamente para poder ofrecer los mejores productos y calidad, siendo la satisfaccion de las personas que eligen comprar nuestros productos lo mas importante para nosotros.
        tenemos la idea de seguir creciendo y poder abrir mas sucursales dentro de la ciudad principalmente y luego poder expandirnos a otras localidades y ciudades, pero con el mismo enfoque como equipo.
        
  </p>

  <div class="contenedor-imagen-equipo mt-4">
    <img src="{{ asset('imagenes/imagenes-quienesSomos/img8.png') }}" alt="Nuestro Equipo">
  </div>


  <p class="col-md-10 mx-auto mt-4">
    Este es nuestro grupo de trabajo, que mas que amigos nos volvimos familia ya que a todos nos apasiona lo mismo y nos complementamos a pesar de que hace no mucho estamos en el negocio, cada uno tiene su rol y se desempeña 
    de la mejor forma para que todo funcione, cada uno aporta su granito de arena para que todo salga bien, y
    hoy en dia estamos todo el tiempo practicamente juntos para apoyar al otro en lo que necesite, y esto se refleja en todos los aspectos de nuestro trabajo y servicio.
  </p>

</div>   

</section>
</body>

@endsection