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
    <label for="nombreConsulta" class="form-label">Nombre</label>
    <input type="text" class="form-control @error('nombreConsulta') is-invalid @enderror" 
           id="nombreConsulta" name="nombreConsulta" value="{{ old('nombreConsulta') }}">
    @error('nombreConsulta')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

                <div class="mb-3">
                    <label for="emailConsulta" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control @error('emailConsulta') is-invalid @enderror" 
                           id="emailConsulta" name="emailConsulta" value="{{ old('emailConsulta') }}">
                    @error('emailConsulta')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="Numero_Telefono" class="form-label">Número de teléfono</label>
                    <input type="text" class="form-control @error('Numero_Telefono') is-invalid @enderror" 
                           id="Numero_Telefono" name="Numero_Telefono" value="{{ old('Numero_Telefono') }}">
                    @error('Numero_Telefono')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
        <select class="form-select form-select-lg mb-3" aria-label="Large select example">
            <option selected>Seleccione una opcion</option>
            <option value="1">Problemas al realizar un pedido</option>
            <option value="2">Consultas sobre stock de un producto</option>
            <option value="3">Sugerencias</option>
        </select>
                <div class="mb-3">
                    <label for="mensaje" class="form-label">Mensaje</label>
                    <textarea class="form-control @error('mensaje') is-invalid @enderror" id="mensaje" name="mensaje" rows="4" required>{{ old('mensaje') }}</textarea>
                    @error('mensaje')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            <div class="text-center">
              <button type="submit" #href=\exito class="btn btn-dark">Enviar</button>
            </div>
            </form>
        </div>
    </div>

   
    
</div>
@endsection
</body>