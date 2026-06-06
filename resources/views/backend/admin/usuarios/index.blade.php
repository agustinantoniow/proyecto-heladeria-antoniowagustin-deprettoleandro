@extends('components.layoutAdmin')
@section('title', 'Glace - Gestión de Usuarios')

@section('content')
<div class="container mt-5">
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3" role="alert">
            <i class="fa-solid fa-circle-xmark me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="font-family: 'Fredoka', sans-serif; color: #17a2b8;">Gestión de Usuarios</h2>
        <button class="btn btn-info text-white fw-bold shadow-sm px-4 rounded-3" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario">
            <i class="fa-solid fa-user-plus me-2"></i> Nuevo Usuario
        </button>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light table-light">
                    <tr style="font-family: 'Fredoka', sans-serif;">
                        <th class="ps-4">ID</th>
                        <th>Nombre Completo</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Rol / Perfil</th>
                        <th>Estado</th>
                        <th class="text-center pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody style="font-family: 'Montserrat', sans-serif;">
                    @forelse($usuarios as $user)
                        <tr>
                            <td class="ps-4 fw-bold text-secondary">#{{ $user->id }}</td>
                            <td>{{ $user->nombre }} {{ $user->apellido }}</td>
                            <td><span class="badge bg-light text-dark text-lowercase">@ {{ $user->usuario }}</span></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->perfil_id == 1)
                                    <span class="badge bg-danger text-white fw-bold">Administrador</span>
                                @else
                                    <span class="badge bg-info text-white">Cliente</span>
                                @endif
                            </td>
                            <td>
                                @if($user->estado)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5">Activo</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5">Inactivo</span>
                                @endif
                            </td>
                            <td class="text-center pe-4">
                                <button class="btn btn-sm btn-outline-warning border-0 me-1 btn-editar" 
                                        data-id="{{ $user->id }}"
                                        data-nombre="{{ $user->nombre }}"
                                        data-apellido="{{ $user->apellido }}"
                                        data-email="{{ $user->email }}"
                                        data-usuario="{{ $user->usuario }}"
                                        data-perfil="{{ $user->perfil_id }}"
                                        data-bs-toggle="modal" data-bs-target="#modalEditarUsuario" title="Editar">
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <form action="{{ route('admin.usuarios.toggle', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm border-0 {{ $user->estado ? 'btn-outline-danger' : 'btn-outline-success' }}" 
                                            title="{{ $user->estado ? 'Dar de baja' : 'Reactivar usuario' }}"
                                            onclick="return confirm('¿Estás seguro de cambiar el estado de este usuario?')">
                                        <i class="fa-solid {{ $user->estado ? 'fa-user-slash' : 'fa-user-check' }}"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No hay usuarios registrados en el sistema.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCrearUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header bg-info text-white rounded-top-4">
                <h5 class="modal-title fw-bold" style="font-family: 'Fredoka', sans-serif;">Nuevo Usuario Glace</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.usuarios.store') }}" method="POST">
                @csrf
                <div class="modal-body row g-3">
                    <div class="col-6">
                        <label class="form-label fw-semibold">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold">Apellido</label>
                        <input type="text" name="apellido" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold">Nombre de Usuario</label>
                        <input type="text" name="usuario" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold">Contraseña</label>
                        <input type="password" name="password" class="form-control" required placeholder="Mín. 4 caracteres">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Rol / Perfil</label>
                        <select name="perfil_id" class="form-select" required>
                            <option value="2">Cliente</option>
                            <option value="1">Administrador</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-info text-white fw-bold rounded-3 px-4">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header bg-warning text-dark rounded-top-4">
                <h5 class="modal-title fw-bold" style="font-family: 'Fredoka', sans-serif;">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditarUsuario" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body row g-3">
                    <div class="col-6">
                        <label class="form-label fw-semibold">Nombre</label>
                        <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold">Apellido</label>
                        <input type="text" name="apellido" id="edit_apellido" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" id="edit_email" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold">Nombre de Usuario</label>
                        <input type="text" name="usuario" id="edit_usuario" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold">Contraseña <small class="text-muted">(Opcional)</small></label>
                        <input type="password" name="password" class="form-control" placeholder="Dejar en blanco para no cambiar">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Rol / Perfil</label>
                        <select name="perfil_id" id="edit_perfil" class="form-select" required>
                            <option value="2">Cliente</option>
                            <option value="1">Administrador</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning fw-bold rounded-3 px-4">Actualizar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const botonesEditar = document.querySelectorAll('.btn-editar');
        const formulario = document.getElementById('formEditarUsuario');

        botonesEditar.forEach(boton => {
            boton.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                
                // Seteamos la URL dinámica del formulario con el ID del usuario correspondiente
                formulario.action = `/admin/usuarios/${id}`;

                // Rellenamos los campos del modal con los datos de la fila seleccionada
                document.getElementById('edit_nombre').value = this.getAttribute('data-nombre');
                document.getElementById('edit_apellido').value = this.getAttribute('data-apellido');
                document.getElementById('edit_email').value = this.getAttribute('data-email');
                document.getElementById('edit_usuario').value = this.getAttribute('data-usuario');
                document.getElementById('edit_perfil').value = this.getAttribute('data-perfil');
            });
        });
    });
</script>
@endsection