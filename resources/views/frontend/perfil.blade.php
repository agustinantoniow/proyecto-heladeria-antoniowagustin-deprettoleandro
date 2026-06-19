@extends('components.layoutCliente')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="fa-solid fa-user-gear me-2"></i> Mi Perfil</h5>
                </div>
                <div class="card-body p-4">

                    {{-- Alerta de éxito --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('perfil.actualizar') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Campo: Nombre Completo --}}
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold">Nombre Completo</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                <input type="text" 
                                       class="form-control @error('nombre') is-invalid @enderror" 
                                       id="nombre" 
                                       name="nombre" 
                                       value="{{ old('nombre', $usuario->nombre) }}" 
                                       required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Campo: Nombre de Usuario --}}
                        <div class="mb-3">
                            <label for="usuario" class="form-label fw-bold">Nombre de Usuario</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="text" 
                                       class="form-control @error('usuario') is-invalid @enderror" 
                                       id="usuario" 
                                       name="usuario" 
                                       value="{{ old('usuario', $usuario->usuario) }}" 
                                       placeholder="Sin espacios"
                                       required>
                                @error('usuario')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Campo: Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $usuario->email) }}" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">
                        <p class="text-muted small"><i class="fa-solid fa-circle-info text-info"></i> Si no deseas cambiar tu contraseña, deja los siguientes campos en blanco.</p>

                        {{-- Campo: Contraseña --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Nueva Contraseña</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Mínimo 6 caracteres (Opcional)">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', 'icon-pass-perfil')">
                                    <i class="fa-solid fa-eye" id="icon-pass-perfil"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Campo: Confirmar Contraseña --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-bold">Confirmar Nueva Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-check-double"></i></span>
                                <input type="password" 
                                       class="form-control" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       placeholder="Repite la nueva contraseña">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation', 'icon-pass-conf-perfil')">
                                    <i class="fa-solid fa-eye" id="icon-pass-conf-perfil"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary fw-bold">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Cambios
                            </button>
                            <a href="{{ route('ProductosCliente') }}" class="btn btn-outline-secondary fw-bold">
                                <i class="fa-solid fa-arrow-left me-1"></i> Volver al catálogo
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

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