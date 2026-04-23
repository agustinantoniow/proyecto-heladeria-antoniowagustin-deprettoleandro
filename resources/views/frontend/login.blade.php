@extends('components.layout')
@section('title', 'heladeria - login')
@section('content')
    <div class="content bg-secondary mt-3 p-5 col-4 ms-5">
              <body>
                <div class="input-group ms-auto">
                <input type="text" class="form-control" placeholder="Nombre de Usuario" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mt-4">
                  <input type="text" class="form-control" placeholder="Contraseña" aria-label="Recipient’s username" aria-describedby="basic-addon2">
                </div>
                <div class="input-group mt-4">
                  <a href="{{ url('/Productos') }}" class="btn btn-info text-white fw-bold px-4">
                   Iniciar Sesión </a>
                </div>


                 <div class="input-group mt-4">
                   <p>¿No tienes una cuenta? </p>

                </div>
                <div>
                  <a href="{{ url('/register') }}" class="btn btn-info text-white fw-bold px-4 ms-2">
                    Registrate</a>
                </div>
              </body>
    </div>
@endsection
