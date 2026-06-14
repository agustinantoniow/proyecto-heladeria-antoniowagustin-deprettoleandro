@extends('components.LayoutAdmin') {{-- Mantengo tu LayoutAdmin --}}

@section('content')
<div class="container mt-5 mb-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold" style="font-family: 'Fredoka', sans-serif; color: #ff6b6b;">Historial de Ventas</h1>
            <p class="text-muted mb-0">Control de pedidos, cantidades y recaudación en tiempo real desde venta_detalles.</p>
        </div>
        <span class="badge bg-danger fs-6 rounded-pill px-3 py-2">{{ $ventas->count() }} Ventas Totales</span>
    </div>

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
                                <td class="ps-4 fw-bold text-secondary">#{{ $venta->id }}</td>
                                {{-- Si la tabla venta_detalles no tiene timestamps, podés usar $venta->created_at ?? 'No registrada' --}}
                                <td>{{ $venta->created_at ? $venta->created_at->format('d/m/Y H:i') : 'N/A' }} hs</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($venta->producto && $venta->producto->imagen)
                                            <img src="{{ asset('uploads/productos/' . $venta->producto->imagen) }}" class="rounded-2 me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded-2 me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="fa-solid fa-ice-cream text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <span class="fw-bold d-block text-dark">{{ $venta->producto->nombre ?? 'Producto Eliminado' }}</span>
                                            <small class="text-muted">{{ $venta->producto->categoria->nombre ?? 'General' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center fw-bold text-muted">{{ $venta->cantidad }} u.</td>
                                <td class="text-end text-secondary">${{ number_format($venta->precio_unitario, 2) }}</td>
                                <td class="text-end fw-bold text-success pe-4">
                                    {{-- Usamos directamente la columna subtotal de tu base de datos --}}
                                    ${{ number_format($venta->subtotal, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-receipt fa-3x mb-3 text-light"></i>
                                    <h3>Aún no se registraron ventas en el sistema.</h3>
                                    <p class="mb-0">¡Los pedidos de los clientes aparecerán acá apenas confirmen el carrito!</p>
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