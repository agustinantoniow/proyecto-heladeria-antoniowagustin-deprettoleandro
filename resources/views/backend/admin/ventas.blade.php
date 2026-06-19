@extends('components.LayoutAdmin')

@section('content')
<div class="container mt-5 mb-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold" style="font-family: 'Fredoka', sans-serif; color: #ff6b6b;">Historial de Ventas</h1>
            <p class="text-muted mb-0">Control de pedidos, logística y recaudación agrupados por ticket.</p>
        </div>
        <span class="badge bg-danger rounded-pill fs-6 py-2 px-3">{{ $totalVentas }} Ventas Concretadas</span>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase fs-7 text-muted">
                        <tr>
                            <th class="ps-4">N° Pedido</th>
                            <th>Fecha y Hora</th>
                            <th>Cliente</th>
                            <th>Entrega / Pago</th>
                            <th class="text-end">Total Ticket</th>
                            <th class="text-center pe-4">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ventas as $venta)
                            <tr>
                                {{-- ID Pedido --}}
                                <td class="ps-4">
                                    <span class="text-dark d-block fw-bold fs-6">#GLA-{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</span>
                                </td>

                                {{-- Fecha --}}
                                <td>
                                    <span class="fw-bold d-block text-dark">{{ \Carbon\Carbon::parse($venta->created_at)->format('d/m/Y') }}</span>
                                    <small class="text-secondary">{{ \Carbon\Carbon::parse($venta->created_at)->format('H:i') }} hs</small>
                                </td>

                                {{-- Cliente Info --}}
                                <td>
                                    <span class="fw-bold d-block text-dark">{{ $venta->user->nombre ?? 'Usuario Eliminado' }}</span>
                                    <small class="text-muted"><i class="fa-solid fa-id-card me-1"></i> {{ $venta->dni }}</small>
                                </td>

                                {{-- Modalidad --}}
                                <td>
                                    @if($venta->tipo_entrega == 'domicilio')
                                        <span class="badge bg-success text-uppercase mb-1"><i class="fa-solid fa-motorcycle me-1"></i> Delivery</span>
                                    @else
                                        <span class="badge bg-primary text-uppercase mb-1"><i class="fa-solid fa-shop me-1"></i> Local</span>
                                    @endif
                                    <br>
                                    <small class="text-muted text-capitalize"><i class="fa-solid fa-wallet me-1"></i> {{ $venta->medio_pago ?? 'Abonado' }}</small>
                                </td>

                                {{-- Total --}}
                                <td class="text-end fw-bold text-success fs-5">
                                    ${{ number_format($venta->total, 2, ',', '.') }}
                                </td>

                                {{-- Botón Ver Detalle --}}
                                <td class="text-center pe-4">
                                    <a href="{{ route('admin.ventas.detalle', $venta->id) }}" class="btn btn-sm btn-outline-dark fw-bold rounded-pill px-3">
                                        <i class="fa-solid fa-eye me-1"></i> Ticket
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-receipt fa-3x mb-3 text-light"></i>
                                    <h4 class="fw-bold">Aún no se registraron ventas en el sistema.</h4>
                                    <p class="text-muted">¡Los pedidos de los clientes aparecerán acá apenas finalicen su compra!</p>
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