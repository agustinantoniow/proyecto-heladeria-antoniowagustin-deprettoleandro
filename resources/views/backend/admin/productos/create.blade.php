@extends('components.layoutAdmin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0"><i class="fa-solid fa-ice-cream me-2"></i> Registrar Nuevo Producto</h5>
                </div>
                <div class="card-body p-4">

                    {{-- Le agregamos un ID al form para controlarlo con JavaScript --}}
                    <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data" id="formProducto">
                        @csrf

                        {{-- Campo: Nombre del Gusto --}}
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold">Nombre del Gusto <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('nombre') is-invalid @enderror" 
                                   id="nombre" 
                                   name="nombre" 
                                   value="{{ old('nombre') }}" 
                                   placeholder="Ej: Dulce de Leche Granizado"
                                   required>
                            
                            {{-- Contenedor para el error de JavaScript (para no recargar) --}}
                            <div class="invalid-feedback fw-bold" id="error-nombre-js" style="display: none;"></div>
                            
                            {{-- Error que viene de Laravel (por si acaso) --}}
                            @error('nombre')
                                <div class="invalid-feedback fw-bold d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            {{-- Campo: Categoría --}}
                            <div class="col-md-6 mb-3">
                                <label for="categoria_id" class="form-label fw-bold">Categoría <span class="text-danger">*</span></label>
                                <select class="form-select @error('categoria_id') is-invalid @enderror" 
                                        id="categoria_id" 
                                        name="categoria_id" 
                                        required>
                                    <option value="" disabled {{ old('categoria_id') ? '' : 'selected' }}>Seleccioná una categoría...</option>
                                    @foreach($categorias as $cat)
                                        <option value="{{ $cat->id }}" {{ old('categoria_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categoria_id')
                                    <div class="invalid-feedback fw-bold d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Campo: Precio --}}
                            <div class="col-md-3 mb-3">
                                <label for="precio" class="form-label fw-bold">Precio ($) <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control @error('precio') is-invalid @enderror" 
                                       id="precio" 
                                       name="precio" 
                                       value="{{ old('precio') }}" 
                                       placeholder="Min 100"
                                       required min="100">
                                @error('precio')
                                    <div class="invalid-feedback fw-bold d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Campo: Stock --}}
                            <div class="col-md-3 mb-3">
                                <label for="stock" class="form-label fw-bold">Stock Inicial <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control @error('stock') is-invalid @enderror" 
                                       id="stock" 
                                       name="stock" 
                                       value="{{ old('stock') }}" 
                                       placeholder="Unidades"
                                       required min="1">
                                @error('stock')
                                    <div class="invalid-feedback fw-bold d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Campo: Descripción --}}
                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold">Descripción del Producto <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                      id="descripcion" 
                                      name="descripcion" 
                                      rows="3" 
                                      placeholder="Describí los ingredientes o detalles del gusto..."
                                      required minlength="5">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback fw-bold d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo: Imagen --}}
                        <div class="mb-4">
                            <label for="imagen" class="form-label fw-bold">Foto del Producto <span class="text-danger">*</span></label>
                            <input class="form-control @error('imagen') is-invalid @enderror" 
                                   type="file" 
                                   id="imagen" 
                                   name="imagen" 
                                   accept="image/png, image/jpeg, image/jpg, image/webp"
                                   required>
                            <div class="form-text">Formatos permitidos: JPG, PNG, WEBP. Tamaño máximo: 5MB.</div>
                            @error('imagen')
                                <div class="invalid-feedback fw-bold d-block">{{ $message }}</div>
                            @enderror

                            <div class="mt-3 d-none" id="preview-container">
                                <p class="mb-1 fw-bold text-muted small">Vista previa:</p>
                                <img id="imagen-preview" src="#" alt="Vista previa de la foto" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        </div>

                        {{-- Botones de Acción --}}
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary fw-bold">
                                <i class="fa-solid fa-xmark me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success fw-bold">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Producto
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script Blindado para Vista Previa y Validación --}}
<script>
    // 1. Mostrar la miniatura de la foto
    document.getElementById('imagen').addEventListener('change', function(event) {
        const input = event.target;
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('imagen-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            previewImage.src = '#';
            previewContainer.classList.add('d-none');
        }
    });

    // 2. FRENO SÚPER ESTRICTO antes de enviar a Laravel
    document.getElementById('formProducto').addEventListener('submit', function(e) {
        const nombreInput = document.getElementById('nombre');
        const errorJsDiv = document.getElementById('error-nombre-js');
        
        // Obtenemos el texto y le borramos espacios al inicio y al final
        let nombreLimpio = nombreInput.value.trim();
        
        // Contamos cuántas letras hay REALMENTE (ignorando todos los espacios intermedios)
        let cantidadLetras = nombreLimpio.replace(/\s/g, '').length;

        // Expresión regular universal: Solo letras (incluye ñ y tildes) y espacios intermedios
        const regexSoloLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+(?:[\s\-]+[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+)*$/;

        let hayError = false;
        let mensajeError = "";

        if (cantidadLetras < 6) {
            hayError = true;
            mensajeError = "❌ El nombre debe tener al menos 6 letras (sin contar espacios).";
        } else if (!regexSoloLetras.test(nombreLimpio)) {
            hayError = true;
            mensajeError = "❌ El nombre solo puede contener letras y no puede empezar ni terminar con espacios.";
        }

        if (hayError) {
            // ¡ESTA LÍNEA ES LA QUE SALVA TU FOTO! Frena el viaje al servidor
            e.preventDefault(); 
            
            // Pintamos el input de rojo
            nombreInput.classList.add('is-invalid');
            
            // Mostramos nuestro error personalizado
            errorJsDiv.textContent = mensajeError;
            errorJsDiv.style.display = 'block';
            
            // Llevamos la pantalla directo al error
            nombreInput.focus();
        } else {
            // Si está todo perfecto, ocultamos errores y dejamos que viaje
            nombreInput.classList.remove('is-invalid');
            errorJsDiv.style.display = 'none';
        }
    });

    // 3. Limpiar el error rojo cuando el usuario empieza a escribir de nuevo
    document.getElementById('nombre').addEventListener('input', function() {
        this.classList.remove('is-invalid');
        document.getElementById('error-nombre-js').style.display = 'none';
    });
</script>
@endsection