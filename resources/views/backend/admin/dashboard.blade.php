@extends('components.layoutAdmin')

@section('content')
<div class="container-fluid mt-4">
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de Control - Heladería Glace</h1>
    </div>

    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-start border-4 border-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Bandeja de Entrada
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Ver Consultas
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.consultas') }}" class="stretched-link"></a>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-start border-4 border-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Inventario
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Gestión de Productos
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ice-cream fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.productos.index') }}" class="stretched-link"></a>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-start border-4 border-info">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Clientes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Gestión de Usuarios
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.usuarios.index') }}" class="stretched-link"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-start border-4 border-info">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Listar Ventas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                               Historial Ventas
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.ventas.index') }}" class="stretched-link"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-dark text-white">
                    <h6 class="m-0 font-weight-bold">¡Bienvenido al Sistema de Gestión!</h6>
                </div>
                <div class="card-body">
                    <p>Hola, <strong>{{ Auth::user()->usuario ?? 'Administrador' }}</strong>. Estás en el centro de control principal.</p>
                    <p class="mb-0">Desde aquí podrás administrar todos los recursos del sitio. Hacé clic en la tarjeta de "Bandeja de Entrada" o usá el menú de navegación para empezar a leer los mensajes de los clientes.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection