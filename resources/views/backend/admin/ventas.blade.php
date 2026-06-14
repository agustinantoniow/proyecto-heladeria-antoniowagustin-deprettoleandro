@extends('components.LayoutAdmin') {{-- Mantengo tu LayoutAdmin --}}

@section('content')
<div class="container mt-5 mb-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold" style="font-family: 'Fredoka', sans-serif; color: #ff6b6b;">Historial de Ventas</h1>
            <p class="text-muted mb-0">Control de pedidos, cantidades y recaudación en tiempo real desde venta_detalles.</p>
        </div>
<span class="badge bg-danger rounded-pill">{{ $totalVentas }} Ventas Totales</span>    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase fs-7 text-muted">
                        <tr>
                            <th class="ps-4">ID Detalle</th>
                            <th>Fecha y Hora</th>
                            <th>Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-end">Precio Unitario</th>
                            <th class="text-end pe-4">Total Cobrado (Subtotal)</th>
                        </tr>
                    </thead>
                    <tbody>
                       @forelse($ventas as $venta)
    <tr>
        <td class="ps-4">
            <span class="text-dark d-block small fw-bold">Detalle #{{ $venta->detalle_id }}</span>
            <small class="text-muted">Pedido #{{ $venta->cabecera_id }}</small>
        </td>

        <td>
            <span class="text-secondary small">
                {{ $venta->fecha_pago ? date('d/m/Y H:i', strtotime($venta->fecha_pago)) : 'N/A' }} hs
            </span>
        </td>

        <td>
            <div class="d-flex align-items-center">
                @if($venta->producto_imagen)
                    <img src="{{ asset('uploads/productos/' . $venta->producto_imagen) }}" class="rounded-2 me-2" style="width: 40px; height: 40px; object-fit: cover;">
                @else
                    <div class="bg-light rounded-2 me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="fa-solid fa-ice-cream text-muted"></i>
                    </div>
                @endif
                <div>
                    <span class="fw-bold d-block text-dark small">{{ $venta->producto_nombre ?? 'Producto Eliminado' }}</span>
                    <small class="badge bg-light text-secondary border fs-8">{{ $venta->categoria_nombre ?? 'General' }}</small>
                </div>
            </div>
        </td>

        <td class="text-center fw-bold text-dark">{{ $venta->cantidad }} u.</td>

        <td class="text-end text-secondary">${{ number_format($venta->precio_unitario, 2) }}</td>

        <td class="text-end fw-bold text-success pe-4">
            ${{ number_format($venta->subtotal, 2) }}
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center py-5 text-muted">
            <i class="fa-solid fa-receipt fa-3x mb-3 text-light"></i>
            <h4 class="fw-bold">Aún no se registrarán ventas en el sistema.</h4>
            <p class="text-muted">¡Los pedidos de los clientes aparecerán acá apenas confirmen el carrito!</p>
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