    @extends('components.layout')
@section('title', 'heladeria - QuienesSomos')
@section('content')
<head>
    
    <style>
    .seccion-nosotros {
    /* Mismo celeste base */
    background-color: #add8e6;
    border: 1px solid #87ceeb;
    border-radius: 12px;
   
    
    /* Alineación y ancho controlado */
    margin: 0px;
    
    max-width: 750px; 
    padding: 20px;   
    
   
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.7;
    color: #2c3e50;
  }

 
  .seccion-nosotros h2 {
    margin-top: 0;
    margin-bottom: 25px; 
    color: #005f73;
    font-size: 28px;
    border-bottom: 2px solid #87ceeb;
    padding-bottom: 10px;
    display: inline-block;
  }

 
  .seccion-nosotros p {
    font-size: 18px;
    margin-top: 0;
    margin-bottom: 0; 
  }

 
  .seccion-nosotros .contenedor-imagen-equipo {
    display: block;
    margin-left: auto;
    margin-right: auto;
    
    /* CONTROL DE TAMAÑO: No muy ancho, ni muy alto */
    width: 85%;          /* No ocupa el 100%, deja un margen interno estético */
    max-width: 600px;    /* Limita el ancho máximo para evitar que se vea gigantesca en PC */
    height: auto;        /* Mantiene proporción */
    
    /* Espaciado vertical suave para separarla de los textos */
    margin-top: 25px;
    margin-bottom: 25px;
    
    /* Estilos visuales de la "foto" */
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.12); /* Sombra suave */
    border: 4px solid #ffffff;                /* Borde blanco profesional */
    
    /* Ajuste de contenido para encuadre panorámico suave */
    overflow: hidden; /* Corta si es necesario si forzamos height, pero mejor usar ratio */
  }
  
  /* Esto asegura que la imagen interna se adapte al contenedor */
  .contenedor-imagen-equipo img {
    display: block;
    width: 100%;
    height: auto;
  }
    </style>
</head>
<body>

  
 

    <style>
  body {
    background-color: #add8e6;
    margin: 0;
    padding: 20px;
  }
</style>
 
<div class="seccion-nosotros">
  <h2>Quiénes Somos</h2>
  <p>
    somos una pequeña empresa formada por cinco amigos los cuales que decidieron emprender en el mundo de los helados, empezamos hace menos de 6 meses pero es algo a lo que dediamos todo nuestro tiempo y ganas
        con el objetivo de poder crecer en este gran negocio y brindar un buen servicio
        a nuestros clientes, trabajamos arduamente para poder ofrecer los mejores productos y calidad, siendo la satisfaccion de las personas que eligen comprar nuestros productos lo mas importante para nosotros.
        tenemos la idea de seguir creciendo y poder abrir mas sucursales dentro de la ciudad principalmente y luego poder expandirnos a otras localidades y ciudades, pero con el mismo enfoque como equipo.
        
  </p>
  <div class="contenedor-imagen-equipo">
    <img src="{{ asset('imagenes/imagenes-quienesSomos/img8.png') }}" alt="Nuestro Equipo">
    </div>
  
    este es nuestro grupo de trabajo, que mas que amigos nos volvimos familia ya que a todos nos apasiona lo mismo y nos complementamos a pesar de que hace no mucho estamos en el negocio, cada uno tiene su rol y se desempeña de la mejor forma para que todo funcione, cada uno aporta su granito de arena para que todo salga bien, y
    hoy en dia estamos todo el tiempo practicamente juntos para apoyar al otro en lo que necesite, y esto se refleja en todos los aspectos de nuestro trabajo y servicio.
  </p>
</div>

   

     
</section>

</body>
@endsection