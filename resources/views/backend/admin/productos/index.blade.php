@extends('components.layoutAdmin')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="font-family: 'Fredoka', sans-serif;">Inventario de Helados</h2>
        <a href="{{ route('admin.productos.create') }}" class="btn btn-success">
                + Nuevo Producto
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div id="alertas-ajax" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;"></div>

    <div class="card shadow border-0 rounded-3 p-3">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Imagen</th> 
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th class="text-center" style="min-width: 180px;">Acciones</th> 
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $prod)
                <tr data-id="{{ $prod->id }}" class="fila-producto">
                    <td>
                        {{-- DIV contenedor para ocultar la imagen al editar --}}
                        <div class="text-lectura div-imagen-lectura">
                            @if($prod->imagen)
                                <img src="{{ asset('uploads/productos/' . $prod->imagen) }}" alt="{{ $prod->nombre }}" class="rounded-2" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <span class="text-muted small">Sin foto</span>
                            @endif
                        </div>
                        {{-- INPUT FILE oculto --}}
                        <input type="file" class="form-control form-control-sm d-none input-imagen" accept="image/*" style="max-width: 180px;">
                    </td>
                    
                    <td>
                        <span class="text-lectura fw-bold text-dark">{{ $prod->nombre }}</span>
                        <input type="text" class="form-control form-control-sm d-none input-nombre fw-bold" value="{{ $prod->nombre }}">
                    </td>
                    
                    <td>
                        <span class="text-lectura">{{ $prod->categoria->nombre ?? 'Sin categoría' }}</span>
                        <select class="form-select form-select-sm d-none input-categoria">
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id }}" {{ (isset($prod->categoria) && $prod->categoria->id == $cat->id) ? 'selected' : '' }}>
                                    {{ $cat->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    
                    <td>
                        <span class="text-lectura fw-bold text-success">${{ number_format($prod->precio, 2) }}</span>
                        <div class="input-group input-group-sm d-none div-precio" style="max-width: 110px;">
                            <span class="input-group-text bg-light text-success fw-bold">$</span>
                            <input type="number" step="0.01" class="form-control input-precio text-success fw-bold" value="{{ $prod->precio }}">
                        </div>
                    </td>
                    
                    <td>
                        <span class="text-lectura">{{ $prod->stock }} u.</span>
                        <div class="d-flex align-items-center d-none div-stock" style="max-width: 90px;">
                            <input type="number" class="form-control form-control-sm input-stock text-center fw-semibold" value="{{ $prod->stock }}">
                            <span class="text-muted small ms-1">u.</span>
                        </div>
                    </td>
                    
                    <td>
                        <span class="badge {{ $prod->activo ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                            {{ $prod->activo ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-sm btn-outline-primary btn-editar-fila" title="Modificar datos">
                                <i class="fa-solid fa-pen-to-square me-1"></i> Editar
                            </button>

                            <button type="button" class="btn btn-sm btn-danger btn-cancelar-fila d-none" title="Cancelar cambios">
                                Cancelar
                            </button>
                            
                            <form action="{{ route('admin.productos.toggleStatus', $prod->id) }}" method="POST" class="d-inline form-toggle-status">
                                @csrf
                                @method('PATCH')
                                
                                @if($prod->activo)
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Pausar / Dar de baja">
                                        <i class="fa-solid fa-pause"></i> Pausar
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-sm btn-outline-success" title="Activar / Dar de alta">
                                        <i class="fa-solid fa-play"></i> Activar
                                    </button>
                                @endif
                            </form>
                            <form action="{{ route('admin.productos.destroy', $prod->id) }}" method="POST" class="d-inline form-eliminar-producto" onsubmit="return confirmarEliminacion(event, '{{ $prod->nombre }}')">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-sm btn-outline-danger btn-tacho-eliminar" title="Eliminar definitivamente">
                                     <i class="fa-solid fa-trash-can"></i>
                                 </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .destello-guardado {
        animation: destello 1s ease-in-out;
    }
    @keyframes destello {
        0% { background-color: transparent; }
        30% { background-color: #d1e7dd; }
        100% { background-color: transparent; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabla = document.querySelector('.table');

    tabla.addEventListener('click', function(e) {
        const btnEditar = e.target.closest('.btn-editar-fila');
        const btnCancelar = e.target.closest('.btn-cancelar-fila');
        
        if (!btnEditar && !btnCancelar) return;

        const fila = (btnEditar || btnCancelar).closest('tr');
        const productoId = fila.dataset.id;

        const textosLectura = fila.querySelectorAll('.text-lectura');
        const divImagenLectura = fila.querySelector('.div-imagen-lectura');
        const inputImagen = fila.querySelector('.input-imagen');
        const inputNombre = fila.querySelector('.input-nombre');
        const inputCategoria = fila.querySelector('.input-categoria');
        const inputImagen = fila.querySelector('.input-imagen');
        const contenedorImagen = fila.querySelector('.contenedor-imagen');
        const divPrecio = fila.querySelector('.div-precio');
        const inputPrecio = fila.querySelector('.input-precio');
        const divStock = fila.querySelector('.div-stock');
        const inputStock = fila.querySelector('.input-stock');
        const btnCancelarFila = fila.querySelector('.btn-cancelar-fila');
        const formToggleStatus = fila.querySelector('.form-toggle-status');
        const botonEditarCambiante = fila.querySelector('.btn-editar-fila');

        // ACCIÓN: CANCELAR
        if (btnCancelar) {
            textosLectura.forEach(el => el.classList.remove('d-none'));
            inputImagen.classList.add('d-none');
            inputImagen.value = ''; // Limpiamos la imagen seleccionada
            inputNombre.classList.add('d-none');
            inputCategoria.classList.add('d-none');
            inputImagen.classList.add('d-none');
            inputImagen.value = ''; // Limpiamos selección de archivo
            divPrecio.classList.add('d-none');
            divStock.classList.add('d-none');
            btnCancelarFila.classList.add('d-none');
            formToggleStatus.classList.remove('d-none');
            
            botonEditarCambiante.className = "btn btn-sm btn-outline-primary btn-editar-fila";
            botonEditarCambiante.innerHTML = `<i class="fa-solid fa-pen-to-square me-1"></i> Editar`;
            return;
        }

        // ACCIÓN: EDITAR
        if (botonEditarCambiante.classList.contains('btn-outline-primary')) {
            // Guardamos valores actuales por si cancela
            inputNombre.dataset.original = inputNombre.value;
            inputCategoria.dataset.original = inputCategoria.value;
            inputPrecio.dataset.original = inputPrecio.value;
            inputStock.dataset.original = inputStock.value;

            // Intercambiamos visibilidades
            textosLectura.forEach(el => el.classList.add('d-none'));
            inputNombre.classList.remove('d-none');
            inputCategoria.classList.remove('d-none');
            inputImagen.classList.remove('d-none');
            divPrecio.classList.remove('d-none');
            divStock.classList.remove('d-none');
            btnCancelarFila.classList.remove('d-none');
            formToggleStatus.classList.add('d-none'); 

            botonEditarCambiante.className = "btn btn-sm btn-success text-white btn-editar-fila shadow-sm";
            botonEditarCambiante.innerHTML = `<i class="fa-solid fa-floppy-disk me-1"></i> Guardar`;
            inputNombre.focus();
        } 
        // ACCIÓN: GUARDAR CAMBIOS
        else {
            // Empaquetamos todo en un FormData para poder subir el archivo físico
            const formData = new FormData();
            formData.append('nombre', inputNombre.value);
            formData.append('precio', inputPrecio.value);
            formData.append('stock', inputStock.value);
            
            // AGREGADO: Engañamos a Laravel de forma segura para que acepte el PATCH con imagen
            formData.append('_method', 'PATCH'); 
            
            // Si el usuario eligió una foto nueva, la sumamos al paquete
            if (inputImagen.files.length > 0) {
                formData.append('imagen', inputImagen.files[0]);
            }

            fetch(`/admin/productos/${productoId}/update-fast`, {
                method: 'POST', // Mantenemos POST
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-HTTP-Method-Override': 'PATCH' // Laravel interpreta POST con esto como PATCH
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizamos los textos estáticos en la vista leída
                    fila.querySelectorAll('.text-lectura')[0].innerText = inputNombre.value;
                    fila.querySelectorAll('.text-lectura')[1].innerText = inputCategoria.options[inputCategoria.selectedIndex].text;
                    fila.querySelectorAll('.text-lectura')[2].innerText = `$${parseFloat(inputPrecio.value).toFixed(2)}`;
                    fila.querySelectorAll('.text-lectura')[3].innerText = `${inputStock.value} u.`;

                    // Si se actualizó la imagen, renderizamos la miniatura nueva que devuelve el backend
                    if (data.imagen_url) {
                        contenedorImagen.innerHTML = `<img src="${data.imagen_url}" class="rounded-2 img-preview" style="width: 50px; height: 50px; object-fit: cover;">`;
                    }

                    // Si el servidor devolvió una nueva URL de imagen, actualizamos el HTML
                    if (data.imagen_url) {
                        divImagenLectura.innerHTML = `<img src="${data.imagen_url}" alt="${inputNombre.value}" class="rounded-2" style="width: 50px; height: 50px; object-fit: cover;">`;
                    }

                    // Volvemos a modo lectura
                    textosLectura.forEach(el => el.classList.remove('d-none'));
                    inputImagen.classList.add('d-none');
                    inputImagen.value = ''; 
                    inputNombre.classList.add('d-none');
                    inputCategoria.classList.add('d-none');
                    inputImagen.classList.add('d-none');
                    inputImagen.value = '';
                    divPrecio.classList.add('d-none');
                    divStock.classList.add('d-none');
                    btnCancelarFila.classList.add('d-none');
                    formToggleStatus.classList.remove('d-none');

                    botonEditarCambiante.className = "btn btn-sm btn-outline-primary btn-editar-fila";
                    botonEditarCambiante.innerHTML = `<i class="fa-solid fa-pen-to-square me-1"></i> Editar`;

                    fila.classList.add('destello-guardado');
                    setTimeout(() => fila.classList.remove('destello-guardado'), 1000);

                    mostrarNotificacion('¡Producto modificado con éxito!', 'success');
                } else {
                    mostrarNotificacion(data.message, 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarNotificacion('Hubo un problema al aplicar los cambios.', 'danger');
            });
        }
    });

    function mostrarNotificacion(mensaje, tipo) {
        const contenedor = document.getElementById('alertas-ajax');
        const id = Date.now();
        const html = `
            <div id="toast-${id}" class="alert alert-${tipo} shadow py-2 px-3 mb-2 rounded-3 small fade show" role="alert">
                <i class="fa-solid ${tipo === 'success' ? 'fa-check' : 'fa-triangle-exclamation'} me-1"></i> ${mensaje}
            </div>
        `;
        contenedor.insertAdjacentHTML('beforeend', html);
        setTimeout(() => { document.getElementById(`toast-${id}`)?.remove(); }, 2500);
    }
});
</script>
@endsection