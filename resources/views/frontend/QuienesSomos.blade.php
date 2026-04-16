  <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>heladeria glace</title>

    <!-- Bootstrap asset -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

    <!-- Tu CSS -->
    <link rel="stylesheet" href="{{ asset('css/Style.css') }}">

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
<nav class="navbar bg-body-tertiary">
  
</nav>
</nav>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="{{ asset('imagenes/logoheladeria.png') }}" 
           alt="Logo" 
           width="100" 
           height="90"
           class="me-4">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <ul class="navbar-nav fs-4">
          <li class="nav-item">
          <a class="nav-link" href="/">inicio</a>
          </li>  
        </ul>
      </ul>
        
        <ul class="navbar-nav fs-4"> 
          <li class="nav-item">
            <a class="nav-link" href="QuienesSomos">Quienes Somos</a>
          </li>
        <ul class="navbar-nav fs-4"> 
            <li class="nav-item">
              <a class="nav-link" href="Comercializacion">Comercialización</a>
            </li>
        <ul class="navbar-nav fs-4"> 
            <li class="nav-item">
              <a class="nav-link" href="Consultas">Consultas</a>
            </li>
        <ul class="navbar-nav fs-4"> 
          <li class="nav-item">
              <a class="nav-link" href="Contacto">Contacto</a>
          </li>
        
          <ul class="navbar-nav fs-4"> 
            <li class="nav-item">
              <a class="nav-link" href="Productos">Productos</a>
            </li>
          
        </li>
      </ul>
    </div>
  </div>
</nav>
  
 

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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="social-buttons">
    <a href="#" class="social-icon facebook"><i class="fa-brands fa-facebook-f"></i></a>
    <a href="#" class="social-icon instagram"><i class="fa-brands fa-instagram"></i></a>
    <a href="#" class="social-icon whatsapp"><i class="fa-brands fa-whatsapp"></i></a>
</div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="TerminosyUsos">Terminos y Usos</a></li>
    <li class="breadcrumb-item"><a href="Nosotros">Nosotros</a></li>
  </ol>
</nav>

<footer>
    <p>&copy; Copyright2026.Todos los derechos reservados.heladeria glace - Corrientes - Argentina</p>
</footer>

    <!-- Bootstrap JS CDN -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
