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
      
         <ul class="navbar-nav fs-4"><li class="nav-item">
          <a class="nav-link" href="QuienesSomos">Quienes Somos</a>
          </ul>
        </li>
         <ul class="navbar-nav fs-4">
          <li class="nav-item">
            <a class="nav-link" href="Comercializacion">Comercialización</a>
          </li>
        </ul>
          <ul class="navbar-nav fs-4"><li class="nav-item">
          <a class="nav-link" href="Consultas">Consultas</a>
          </ul>
        </li>
        </li>
          <ul class="navbar-nav fs-4"><li class="nav-item">
          <a class="nav-link" href="Contacto">Contacto</a>
          </ul>
        </li>
        </ul>
        <ul class="navbar-nav fs-4"> <li class="nav-item">
          <a class="nav-link" href="Productos">Productos</a>
        </li>

      </ul>
    </div>
  </div>
</nav>



<style>
  .mi-recuadro {
    
    background-color: #add8e6; 
    
    
    padding: 20px;
    
    
    border-radius: 8px;
    
   
    border: 1px solid #87ceeb;
    
    
    max-width: 400px;
    
    
    font-family: Arial, sans-serif;
    color: #333;
    
    
    margin: 20px 0 20px 10px;
  }
</style>

 

<div class="mi-recuadro">
  <h2>Tipos de Entregas</h2>
  <p>-Retiro en mostrador</p>
  <p>-Envio a domicilio</p>
</div>

<div class="mi-recuadro">
  <h2>Formas de envio</h2>
  <p>-Moto mandado</p>
  <p>-Delivery</p>
  <p>-Take away</p>
</div>

<div class="mi-recuadro">
  <h2>Pagos</h2>
  <p>-Efectivo</p>
  <p>-Debito</p>
  <p>-Credito</p>
  <p>-Transferencia bancaria</p>
</div>



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