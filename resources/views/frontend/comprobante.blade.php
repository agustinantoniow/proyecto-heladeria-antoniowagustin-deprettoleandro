@extends('components.layoutCliente')
@section('content')
<div class="container mt-5 mb-5 d-flex justify-content-center">
    <div class="col-md-7">
        
        {{-- Alerta verde de éxito al finalizar la transacción --}}
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4 text-center fw-bold" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Estructura del Comprobante tipo Factura / Ticket --}}
        <div class="card shadow border-0 rounded-3 overflow-hidden" id="ticketVenta">
            <div class="card-header bg-dark text-white text-center py-4">
                <h4 class="mb-1 fw-bold text-uppercase tracking-wide">Heladería Glace</h4>
                <p class="mb-0 small text-muted">Comprobante de Venta No Válido como Factura</p>
            </div>
            <div class="card-body p-4">
                
                {{-- Encabezado del ticket --}}
                <div class="row mb-4">
                    <div class="col-6">
                        <span class="text-muted small d-block text-uppercase fw-bold">Código de Pedido</span>
                        <strong class="fs-5 text-primary">#GLA-{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</strong>
                    </div>
                    <div class="col-6 text-end">
                        <span class="text-muted small d-block text-uppercase fw-bold">Fecha y Hora</span>
                        <strong class="small">{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y H:i') }} hs</strong>
                    </div>
                </div>

                <hr class="border-dashed">

                {{-- Detalles del Cliente y Entrega --}}
                <h6 class="fw-bold text-uppercase text-secondary mb-3 small"><i class="fa-solid fa-user me-2"></i> Información del Cliente</h6>
                <div class="row mb-4 bg-light p-3 rounded mx-0 border">
                    <div class="col-sm-6 mb-2">
                        <span class="text-muted d-block small">Nombre completo:</span>
                        <span class="fw-bold">{{ auth()->user()->nombre }} {{ auth()->user()->apellido }}</span>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <span class="text-muted d-block small">DNI registrado:</span>
                        <span class="fw-bold">{{ $venta->dni }}</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="text-muted d-block small">Teléfono de contacto:</span>
                        <span class="fw-bold">{{ $venta->telefono }}</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="text-muted d-block small">Método de entrega:</span>
                        <span class="badge {{ $venta->tipo_entrega == 'domicilio' ? 'bg-success' : 'bg-primary' }} text-uppercase fw-bold">
                            {{ $venta->tipo_entrega == 'domicilio' ? 'Envío a Domicilio' : 'Retiro en Local' }}
                        </span>
                    </div>
                </div>

                {{-- Detalles de Logística o Pago si aplica --}}
                @if($venta->tipo_entrega == 'domicilio')
                    <h6 class="fw-bold text-uppercase text-secondary mb-3 small"><i class="fa-solid fa-truck me-2"></i> Datos de Envío</h6>
                    <div class="row mb-4 bg-light p-3 rounded mx-0 border">
                        <div class="col-12 mb-2">
                            <span class="text-muted d-block small">Dirección física:</span>
                            <span class="fw-bold"><i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $venta->direccion }}</span>
                        </div>
                        <div class="col-12">
                            <span class="text-muted d-block small">Medio de pago seleccionado:</span>
                            <span class="fw-bold text-capitalize">{{ $venta->medio_pago }}</span>
                        </div>
                    </div>
                @endif

                <hr class="border-dashed">

                {{-- Tabla con los helados comprados --}}
                <h6 class="fw-bold text-uppercase text-secondary mb-3 small"><i class="fa-solid fa-ice-cream me-2"></i> Detalle de Productos</h6>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead>
                            <tr class="border-bottom text-muted small text-uppercase">
                                <th>Gusto / Producto</th>
                                <th class="text-center">Cant.</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($venta->detalles as $detalle)
                                <tr class="border-bottom-sm">
                                    <td>
                                        <span class="fw-bold d-block">{{ $detalle->producto->nombre }}</span>
                                        <small class="text-muted">{{ $detalle->producto->categoria->nombre ?? 'Glace Premium' }}</small>
                                    </td>
                                    <td class="text-center fw-bold text-muted">{{ $detalle->cantidad }}</td>
                                    <td class="text-end fw-bold">${{ number_format($detalle->subtotal, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Fila del Total General --}}
                <div class="row mt-4 pt-3 border-top mx-0 bg-dark text-white rounded p-3 d-flex align-items-center">
                    <div class="col-6">
                        <span class="fs-5 fw-bold text-uppercase tracking-wider">Total Abonado</span>
                    </div>
                    <div class="col-6 text-end">
                        <span class="fs-4 fw-bold">${{ number_format($venta->total, 2, ',', '.') }}</span>
                    </div>
                </div>

            </div>
            {{-- Footer del ticket con acciones útiles --}}
            <div class="card-footer bg-light p-3 d-flex justify-content-between gap-2 border-top">
                <a href="{{ route('ProductosCliente') }}" class="btn btn-outline-secondary fw-bold btn-sm">
                    <i class="fa-solid fa-arrow-left me-1"></i> Volver al Catálogo
                </a>
                <button onclick="window.print();" class="btn btn-dark fw-bold btn-sm">
                    <i class="fa-solid fa-print me-1"></i> Imprimir Ticket
                </button>
            </div>
        </div>

    </div>
</div>

<style>
    /* Estilos estéticos de simulación de ticket físico */
    .border-dashed {
        border-top: 2px dashed #cbd5e1;
        margin: 25px 0;
    }
    .border-bottom-sm {
        border-bottom: 1px solid #f1f5f9;
    }
    @media print {
        /* Esconde el menú de navegación y botones al momento de imprimir el ticket */
        body * {
            visibility: hidden;
        }
        #ticketVenta, #ticketVenta * {
            visibility: visible;
        }
        #ticketVenta {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            box-shadow: none !important;
        }
        .card-footer {
            display: none !important;
        }
    }
</style>
@endsection