@extends('components.layout')
@section('title', 'Heladería Glace - Registrarse')
@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i> 
        <strong>{{ session('success') }}</strong>
        <hr>
        <p class="mb-0">¿Ya querés probar tu cuenta? <a href="{{ url('/Ingreso') }}" class="alert-link fw-bold">Clic aquí para ingresar</a></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form action="{{ route('registro.store') }}" method="POST" class="row g-3 needs-validation mt-4" novalidate>
  @csrf

  <div class="col-md-4">
    <label for="Nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control @error('Nombre') is-invalid @enderror"
           id="Nombre" name="Nombre" value="{{ old('Nombre') }}">
    @error('Nombre')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-4">
    <label for="Apellido" class="form-label">Apellido</label>
    <input type="text" class="form-control @error('Apellido') is-invalid @enderror"
           id="Apellido" name="Apellido" value="{{ old('Apellido') }}">
    @error('Apellido')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>



<div class="col-md-4">
    <label for="emaiL" class="form-label">Correo Electrónico</label>
    <div class="input-group has-validation">
        <span class="input-group-text" id="inputGroupPrepend">@</span>
        <input type="email" class="form-control @error('email') is-invalid @enderror"
               id="email" name="email" value="{{ old('email') }}">
        @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <label for="usuario" class="form-label">Nombre de Usuario</label>
    <div class="input-group has-validation">
        <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-user"></i></span>
        <input type="text" class="form-control @error('usuario') is-invalid @enderror"
               id="usuario" name="usuario" placeholder="Ej: joaco123" value="{{ old('usuario') }}">
        @error('usuario')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <label for="password" class="form-label">Contraseña</label>
    <div class="input-group has-validation">
        <span class="input-group-text" id="inputGroupPrepend">***</span>
        <input type="password" class="form-control @error('password') is-invalid @enderror"
               id="password" name="password">
        @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
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