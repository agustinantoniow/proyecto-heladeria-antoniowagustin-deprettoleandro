@extends('components.layoutAdmin')
@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <div class="mb-3">
        <a href="{{ route('admin.categorias.index') }}" class="btn btn-sm btn-outline-secondary rounded-3">
            <i class="fa-solid fa-arrow-left me-1"></i> Volver al listado
        </a>
    </div>

    <div class="card shadow border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-primary text-white py-3">
            <h4 class="card-title mb-0 text-center" style="font-family: 'Fredoka', sans-serif;">Nueva Categoría</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.categorias.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-semibold">Nombre de la Categoría</label>
                    <input type="text" name="nombre" class="form-control rounded-3" placeholder="Ej: Cremas, Aguas, Bombones" required>
                    @error('nombre')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary text-white fw-bold w-100 py-2 rounded-3 shadow-sm">
                    Guardar Categoría
                </button>
            </form>
        </div>
    </div>
</div>
@endsection