@extends('components.layoutVisitante')
@section('title', 'Heladería Glace - Registrarse')
@section('content')

{{-- Alerta de éxito --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i> 
        <strong>{{ session('success') }}</strong>
        <hr>
        <p class="mb-0">¿Ya querés probar tu cuenta? <a href="{{ url('/login') }}" class="alert-link fw-bold">Clic aquí para ingresar</a></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form action="{{ route('registro.store') }}" method="POST" class="row g-3 mt-4">
  @csrf

  {{-- Campo: Nombre --}}
  <div class="col-md-6">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
           id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Sin espacios">
    @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  {{-- Campo: Apellido --}}
  <div class="col-md-6">
    <label for="apellido" class="form-label">Apellido</label>
    <input type="text" class="form-control @error('apellido') is-invalid @enderror"
           id="apellido" name="apellido" value="{{ old('apellido') }}" placeholder="Sin espacios">
    @error('apellido')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  {{-- Campo: Correo Electrónico --}}
  <div class="col-md-6">
    <label for="email" class="form-label">Correo Electrónico</label>
    <div class="input-group has-validation">
        <span class="input-group-text">@</span>
        <input type="email" class="form-control @error('email') is-invalid @enderror"
               id="email" name="email" value="{{ old('email') }}" placeholder="ejemplo@correo.com">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
  </div>

  {{-- Campo: Nombre de Usuario --}}
  <div class="col-md-6">
    <label for="usuario" class="form-label">Nombre de Usuario</label>
    <div class="input-group has-validation">
        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
        <input type="text" class="form-control @error('usuario') is-invalid @enderror"
               id="usuario" name="usuario" placeholder="Mínimo 5 letras, sin espacios" value="{{ old('usuario') }}">
        @error('usuario')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
  </div>

  {{-- Campo: Contraseña --}}
  <div class="col-md-6">
    <label for="password" class="form-label">Contraseña</label>
    <div class="input-group has-validation">
        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
        <input type="password" class="form-control @error('password') is-invalid @enderror"
               id="password" name="password">
        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', 'icon-pass')">
            <i class="fa-solid fa-eye" id="icon-pass"></i>
        </button>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
  </div>

  {{-- Campo: Repetir Contraseña --}}
  <div class="col-md-6">
    <label for="password_confirmation" class="form-label">Repetir Contraseña</label>
    <div class="input-group">
        <span class="input-group-text"><i class="fa-solid fa-check-double"></i></span>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation', 'icon-pass-conf')">
            <i class="fa-solid fa-eye" id="icon-pass-conf"></i>
        </button>
    </div>
  </div>

  {{-- Checkbox: Términos --}}
  <div class="col-12 mt-3">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="1" id="invalidCheck" name="terminos" required>
      <label class="form-check-label" for="invalidCheck">
        Acepto los términos y condiciones
      </label>
    </div>
  </div>

  <div class="col-12 mt-4 mb-5">
    <button type="submit" class="btn btn-primary fw-bold">Registrarme en Glace</button>
  </div>
   
</form>

{{-- Script para el Ojito de las contraseñas --}}
<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

@endsection