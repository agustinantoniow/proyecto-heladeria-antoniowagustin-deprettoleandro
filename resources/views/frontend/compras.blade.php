@extends('components.layoutCliente')
 {{-- Reemplaza por tu layout principal del cliente (ej: layouts.frontend o similar) --}}

@section('content')
<div class="container mt-5 mb-5" style="max-width: 900px;">
    
    <div class="mb-4">
        <h1 class="fw-bold" style="font-family: 'Fredoka', sans-serif; color: #ff6b6b;">Mis Compras</h1>
        <p class="text-muted">Revisá el detalle de tus pedidos confirmados y disfrutá de tus helados favoritos.</p>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light text-uppercase fs-7 text-muted">
                        <tr>
                            <th class="ps-4">Detalle</th>
                            <th>Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-end">Precio Unitario</th>
                            <th class="text-end pe-4">Total Pagado</th>
                        </tr>
                    </thead>
                    <tbody>
                   @forelse($compras as $compra)
    <tr>
        <td class="ps-4">
            <span class="text-secondary d-block small fw-bold">#{{ $compra->cabecera_id }}</span>
            
            <small class="text-muted">
                {{ $compra->fecha_pago ? date('d/m/Y', strtotime($compra->fecha_pago)) : 'N/A' }}
            </small>
        </td>
        <td>
            <div class="d-flex align-items-center">
                @if($compra->producto_imagen)
                    <img src="{{ asset('uploads/productos/' . $compra->producto_imagen) }}" class="rounded-2 me-2" style="width: 50px; height: 50px; object-fit: cover;">
                @else
                    <div class="bg-light rounded-2 me-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-ice-cream text-muted"></i>
                    </div>
                @endif
                <div>
                    <span class="fw-bold d-block text-dark">{{ $compra->producto_nombre ?? 'Producto no disponible' }}</span>
                    <small class="badge bg-light text-secondary border">{{ $compra->categoria_nombre ?? 'General' }}</small>
                </div>
            </div>
        </td>
        <td class="text-center fw-bold text-dark">{{ $compra->cantidad }} u.</td>
        <td class="text-end text-secondary">${{ number_format($compra->precio_unitario, 2) }}</td>
        <td class="text-end fw-bold text-success pe-4">
            ${{ number_format($compra->subtotal, 2) }}
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center py-5 text-muted">
            <i class="fa-solid fa-cart-shopping fa-3x mb-3 text-light"></i>
            <h4 class="fw-bold">¿Todavía no probaste nuestros helados?</h4>
            <p class="mb-3 text-muted">Tu historial de compras está vacío.</p>
            <a href="{{ route('catalogo.publico') }}" class="btn btn-danger rounded-pill px-4" style="background-color: #ff6b6b; border: none;">
                Ir al Catálogo 🍦
            </a>
        </td>
    </tr>
@endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection