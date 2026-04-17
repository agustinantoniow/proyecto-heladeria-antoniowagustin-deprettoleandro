@extends('components.layout')
@section('title', 'heladeria - Comercialización')
@section('content')
<body>

<main>
    @yield('content') {{-- Aquí se inyectan las vistas como TerminosyUsos --}}
</main>

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

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endsection
</body>
</html>