@extends('components.layout')
@section('title', 'Heladería Glace - Registrarse')
@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i> 
        <strong>{{ session('success') }}</strong>
        <hr>
        <p class="mb-0">¿Ya querés probar tu cuenta? <a href="{{ url('/loginNavbar') }}" class="alert-link fw-bold">Clic aquí para ingresar</a></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form action="{{ route('registro.store') }}" method="POST" class="row g-3 needs-validation mt-4" novalidate>
  @csrf

  <div class="col-md-4">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" required>
  </div>

  <div class="col-md-4">
    <label for="apellido" class="form-label">Apellido</label>
    <input type="text" class="form-control" id="apellido" name="apellido" required>
  </div>

  <div class="col-md-4">
    <label for="usuario" class="form-label">Nombre de Usuario</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-user"></i></span>
      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ej: joaco123" required>
    </div>
  </div>

  <div class="col-md-4">
    <label for="email" class="form-label">Correo Electrónico</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend">@</span>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
  </div>

  <div class="col-md-4">
    <label for="password" class="form-label">Contraseña</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend">***</span>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
  </div>

  <div class="col-12 mt-3">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Acepto los términos y condiciones
      </label>
    </div>
  </div>

  <div class="col-12 mt-4">
    <button type="submit" class="btn btn-primary fw-bold">Registrarme en Glace</button>
  </div>
   
</form>

@endsection