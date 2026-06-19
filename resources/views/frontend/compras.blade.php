@extends('components.layoutCliente')

@section('content')
<div class="container mt-5 mb-5" style="max-width: 900px;">
    
    <div class="mb-4">
        <h1 class="fw-bold" style="font-family: 'Fredoka', sans-serif; color: #ff6b6b;">Mis Compras</h1>
        <p class="text-muted">Revisá el historial de tus pedidos confirmados y accedé al detalle de cada uno.</p>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 table-hover">
                    <thead class="table-light text-uppercase fs-7 text-muted">
                        <tr>
                            <th class="ps-4">N° Pedido</th>
                            <th>Fecha</th>
                            <th>Entrega</th>
                            <th class="text-end">Total Pagado</th>
                            <th class="text-center pe-4">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($compras as $compra)
                            <tr>
                                {{-- Número de Pedido --}}
                                <td class="ps-4">
                                    <span class="text-dark d-block fw-bold fs-6">#GLA-{{ str_pad($compra->id, 6, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                
                                {{-- Fecha y Hora --}}
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-2 me-3 d-flex align-items-center justify-content-center text-secondary" style="width: 45px; height: 45px;">
                                            <i class="fa-regular fa-calendar"></i>
                                        </div>
                                        <div>
                                            <span class="fw-bold d-block text-dark">{{ \Carbon\Carbon::parse($compra->fecha_venta)->format('d/m/Y') }}</span>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($compra->fecha_venta)->format('H:i') }} hs</small>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- Tipo de Entrega --}}
                                <td>
                                    @if($compra->tipo_entrega == 'domicilio')
                                        <span class="badge bg-success text-uppercase"><i class="fa-solid fa-motorcycle me-1"></i> Domicilio</span>
                                    @else
                                        <span class="badge bg-primary text-uppercase"><i class="fa-solid fa-shop me-1"></i> Local</span>
                                    @endif
                                </td>
                                
                                {{-- Total Pagado --}}
                                <td class="text-end fw-bold text-dark fs-5">
                                    ${{ number_format($compra->total, 2, ',', '.') }}
                                </td>
                                
                                {{-- Botón de Acción --}}
                                <td class="text-center pe-4">
                                    {{-- Este botón reutiliza la vista del comprobante que armamos antes --}}
                                    <a href="{{ route('carrito.comprobante', $compra->id) }}" class="btn btn-sm btn-outline-info fw-bold rounded-pill px-3">
                                        <i class="fa-solid fa-eye me-1"></i> Ver Detalle
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="fa-solid fa-basket-shopping fa-2x text-secondary"></i>
                                    </div>
                                    <h4 class="fw-bold text-dark">¿Todavía no probaste nuestros helados?</h4>
                                    <p class="mb-4">Tu historial de compras está vacío.</p>
                                    <a href="{{ route('catalogo.publico') }}" class="btn btn-danger rounded-pill px-4 py-2 fw-bold shadow-sm" style="background-color: #ff6b6b; border: none;">
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