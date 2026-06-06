@extends('components.layoutVisitante') {{-- Cambia por tu layout de panel si es otro --}}
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="font-family: 'Fredoka', sans-serif;">Inventario de Helados</h2>
        <a href="{{ route('admin.productos.create') }}" class="btn btn-success text-white fw-bold rounded-3">
            <i class="fa-solid fa-plus me-1"></i> Nuevo Producto
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow border-0 rounded-3 p-3">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $prod)
                <tr>
                    <td class="fw-bold">{{ $prod->nombre }}</td>
                    <td>{{ $prod->categoria->nombre ?? 'Sin categoría' }}</td>
                    <td>${{ number_format($prod->precio, 2) }}</td>
                    <td>{{ $prod->stock }} u.</td>
                    <td>
                        <span class="badge {{ $prod->activo ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                            {{ $prod->activo ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection