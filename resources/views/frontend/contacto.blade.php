@extends('components.layout')
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
        <div class="card shadow p-4 mx-auto" style="max-width: 600px;">
            <h1 class="text-center mb-4">Formulario de Consultas</h1>

            <form action="{{ url('/Consultas') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="num" class="form-label">Número de teléfono</label>
                    <input type="text" class="form-control" id="num" name="num" required>
                </div>
        <select class="form-select form-select-lg mb-3" aria-label="Large select example">
            <option selected>Seleccione una opcion</option>
            <option value="1">Problemas al realizar un pedido</option>
            <option value="2">Consultas sobre stock de un producto</option>
            <option value="3">Sugerencias</option>
        </select>
                <div class="mb-3">
                    <label for="mensaje" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                </div>

            <div class="text-center">
                <a href="/exito" class="btn btn-dark">Enviar</a>
            </div>
            </form>
        </div>
    </div>

   
    
</div>
@endsection
</body>