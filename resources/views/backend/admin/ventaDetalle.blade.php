@extends('components.LayoutAdmin')

@section('content')
<div class="container mt-5 mb-5 d-flex justify-content-center">
    <div class="col-md-8">
        
        <div class="card shadow border-0 rounded-3 overflow-hidden">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-bold"><i class="fa-solid fa-file-invoice-dollar me-2"></i> Detalle del Pedido #GLA-{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</h5>
                <span class="badge bg-light text-dark">{{ \Carbon\Carbon::parse($venta->created_at)->format('d/m/Y H:i') }}</span>
            </div>
            
            <div class="card-body p-4">
                {{-- Datos del Cliente y Envío --}}
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <h6 class="fw-bold text-uppercase text-secondary mb-3 small border-bottom pb-2">Datos del Cliente</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><strong>Nombre:</strong> {{ $venta->user->nombre ?? 'N/A' }}</li>
                            <li class="mb-2"><strong>DNI:</strong> {{ $venta->dni }}</li>
                            <li class="mb-2"><strong>Teléfono:</strong> <a href="https://wa.me/{{ $venta->telefono }}" target="_blank" class="text-decoration-none text-success"><i class="fa-brands fa-whatsapp"></i> {{ $venta->telefono }}</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-md-6">
                        <h6 class="fw-bold text-uppercase text-secondary mb-3 small border-bottom pb-2">Logística y Cobro</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <strong>Entrega:</strong> 
                                <span class="badge {{ $venta->tipo_entrega == 'domicilio' ? 'bg-success' : 'bg-primary' }}">
                                    {{ $venta->tipo_entrega == 'domicilio' ? 'Envío a Domicilio' : 'Retiro en Local' }}
                                </span>
                            </li>
                            @if($venta->tipo_entrega == 'domicilio')
                                <li class="mb-2"><strong>Dirección:</strong> {{ $venta->direccion }}</li>
                            @endif
                            <li class="mb-2 text-capitalize"><strong>Medio de Pago:</strong> {{ $venta->medio_pago ?? 'N/A' }}</li>
                        </ul>
                    </div>
                </div>

                {{-- Tabla de Productos --}}
                <h6 class="fw-bold text-uppercase text-secondary mb-3 small border-bottom pb-2">Productos del Ticket</h6>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>Producto</th>
                                <th>Precio Unit.</th>
                                <th>Cant.</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($venta->detalles as $detalle)
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block">{{ $detalle->producto->nombre }}</span>
                                        <small class="text-muted">{{ $detalle->producto->categoria->nombre ?? 'Glace Premium' }}</small>
                                    </td>
                                    <td class="text-center">${{ number_format($detalle->precio_unitario, 2, ',', '.') }}</td>
                                    <td class="text-center fw-bold">{{ $detalle->cantidad }}</td>
                                    <td class="text-end fw-bold">${{ number_format($detalle->subtotal, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-dark text-white">
                            <tr>
                                <td colspan="3" class="text-end fw-bold text-uppercase tracking-wider fs-5">Total del Pedido</td>
                                <td class="text-end fw-bold fs-5">${{ number_format($venta->total, 2, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-light p-3 d-flex justify-content-between">
                <a href="{{ route('admin.ventas') }}" class="btn btn-secondary fw-bold">
                    <i class="fa-solid fa-arrow-left me-1"></i> Volver a Ventas
                </a>
                <button onclick="window.print();" class="btn btn-outline-dark fw-bold">
                    <i class="fa-solid fa-print me-1"></i> Imprimir Orden
                </button>
            </div>
        </div>

    </div>
</div>

<style>
    @media print {
        body * { visibility: hidden; }
        .card, .card * { visibility: visible; }
        .card { position: absolute; left: 0; top: 0; width: 100%; box-shadow: none !important; border: none !important; }
        .card-footer { display: none !important; }
    }
</style>
@endsection