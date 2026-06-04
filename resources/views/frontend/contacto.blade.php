@extends('components.layoutVisitante')
@section('title', 'heladeria - Contacto')
@section('content')
<body> 
    
<div class="container row mx-auto mt-5">    
   <div class="col-md-6">

    <div class="contenedor-contacto">
        <div class="info-contacto">
            <h2>¡Hablemos de helados!</h2>
            <p>📍 Junin 1945, Corrientes Capital</p>
            <p>📞 3794 341267</p>
            <p>⏰ Lun a Dom: 12:00 a 00:00</p>
        </div>
        <section class="seccion-mapa">
          <div class="contenedor-mapa">
            <h2>Visítanos en nuestro local</h2>
            <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.027326422935!2d-58.82858648870251!3d-27.468408616552967!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456b5e52e57601%3A0x40449f1a8db1169a!2sJunin%201945%2C%20W3400AWP%20Corrientes!5e0!3m2!1ses-419!2sar!4v1775938991874!5m2!1ses-419!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"> 
            width="100%" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
            </iframe>       
          </div>       
    </div>
   </div>

  <div class="col-md-6">
    
    @include('frontend.formulario-consultas')
            
</div>
      
    </div>

   
    
</div>
@endsection
</body>