@extends('components.layoutAdmin')
@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <div class="mb-3">
        <a href="{{ route('admin.productos.index') }}" class="btn btn-sm btn-outline-secondary rounded-3">
            <i class="fa-solid fa-arrow-left me-1"></i> Volver al listado
        </a>
    </div>

    <div class="card shadow border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-success text-white py-3">
            <h4 class="card-title mb-0 text-center" style="font-family: 'Fredoka', sans-serif;">Registrar Nuevo Producto</h4>
        </div>
        <div class="card-body p-4">
            
            <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nombre del Gusto</label>
                    <input type="text" name="nombre" class="form-control rounded-3" placeholder="Ej: Americana" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Categoría</label>
                    <select name="categoria_id" class="form-select rounded-3" required>
                        <option value="" selected disabled>-- Seleccioná la categoría --</option>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label class="form-label fw-semibold">Precio ($)</label>
                        <input type="number" name="precio" step="0.01" min="0" class="form-control rounded-3" placeholder="0.00" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold">Stock Inicial</label>
                        <input type="number" name="stock" min="0" class="form-control rounded-3" placeholder="Ej: 10" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Descripción</label>
                    <textarea name="descripcion" class="form-control rounded-3" rows="3" placeholder="Opcional..."></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Imagen del Gusto (Foto)</label>
                    <input type="file" name="imagen" class="form-control rounded-3" accept="image/*">
                    @error('imagen')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success text-white fw-bold w-100 py-2 rounded-3 shadow-sm">
                    Dar de alta producto
                </button>
            </form>
        </div>
    </div>
</div>
@endsection