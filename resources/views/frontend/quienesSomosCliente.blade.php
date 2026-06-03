@extends('components.layoutCliente')
@section('title', 'heladeria - QuienesSomos')
@section('content')

<body> 
   

    
  
    <div class="text-center mt-4 mb-4">
    <h2 class="titulo-productos">
        Sobre Nosotros 
    </h2>
</div>
    
  <p class="text-center texto-nosotros">
    Somos una pequeña empresa formada por cinco amigos los cuales que decidieron emprender en el mundo de los helados, empezamos hace menos de 6 meses pero es algo a lo que dediamos todo nuestro tiempo y ganas
        con el objetivo de poder crecer en este gran negocio y brindar un buen servicio
        a nuestros clientes, trabajamos arduamente para poder ofrecer los mejores productos y calidad, siendo la satisfaccion de las personas que eligen comprar nuestros productos lo mas importante para nosotros.
        tenemos la idea de seguir creciendo y poder abrir mas sucursales dentro de la ciudad principalmente y luego poder expandirnos a otras localidades y provincias, pero con el mismo enfoque como equipo.  
  </p>

 <div class="contenedor-imagen-equipo mt-4 text-center">
    <img src="{{ asset('imagenes/imagenes-quienesSomos/img8.png') }}" alt="Nuestro Equipo" class="w-75 img-fluid">
</div>

  <p class="text-center texto-nosotros mt-4">
    Este es nuestro grupo de trabajo, que mas que amigos nos volvimos familia ya que a todos nos apasiona lo mismo y nos complementamos a pesar de que hace no mucho estamos en el negocio, cada uno tiene su rol y se desempeña 
    de la mejor forma para que todo funcione, cada uno aporta su granito de arena para que todo salga bien, y
    hoy en dia estamos todo el tiempo practicamente juntos para apoyar al otro en lo que necesite, y esto se refleja en todos los aspectos de nuestro trabajo y servicio. Gracias
  </p>
   
</body>
</section>
@endsection