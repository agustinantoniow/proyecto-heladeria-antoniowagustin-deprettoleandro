@extends('components.layoutCliente') {{-- Reemplazá por tu layout principal si se llama distinto --}}

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="fa-solid fa-user-gear me-2"></i> Mi Perfil</h5>
                </div>
                <div class="card-body p-4">

                    {{-- Alertas de éxito o error --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('perfil.actualizar') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nombre" class="form-label font-weight-bold">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label font-weight-bold">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
                        </div>

                        <hr class="my-4">
                        <p class="text-muted small"><i class="fa-solid fa-info-circle"></i> Si no deseas cambiar tu contraseña, deja los siguientes campos en blanco.</p>

                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Mínimo 6 caracteres">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repite la contraseña">
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Cambios
                            </button>
                            <a href="{{ route('ProductosCliente') }}" class="btn btn-outline-secondary">
                                Volver al catálogo
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection