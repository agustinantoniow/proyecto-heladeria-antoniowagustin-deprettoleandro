@extends('components.layoutCliente')
@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow mx-auto" style="max-width: 700px; border-top: 5px solid #7bc4c4;">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold">Heladería Glace</h2>
                <p class="text-muted">Comprobante de Venta #{{ str_pad($venta->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>
            
            <div class="row mb-4">
                <div class="col-sm-6">
                    <strong>Cliente:</strong> {{ auth()->user()->name }}<br>
                    <strong>DNI:</strong> {{ $venta->dni }}<br>
                    <strong>Teléfono:</strong> {{ $venta->telefono }}
                </div>
                <div class="col-sm-6 text-sm-end">
                    <strong>Fecha:</strong> {{ $venta->updated_at->format('d/m/Y H:i') }}<br>
                    <strong>Código:</strong> {{ $venta->codigo_seguimiento }}<br>
                    <strong>Medio de Pago:</strong> {{ strtoupper($venta->metodo_pago) }}
                </div>
            </div>

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th class="text-center">Cant.</th>
                        <th class="text-end">Precio Unit.</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta->detalles as $item)
                    <tr>
                        <td>{{ $item->producto->nombre }}</td>
                        <td class="text-center">{{ $item->cantidad }}</td>
                        <td class="text-end">${{ number_format($item->precio_unitario, 2) }}</td>
                        <td class="text-end">${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end fs-5">TOTAL</th>
                        <th class="text-end fs-5">${{ number_format($venta->total, 2) }}</th>
                    </tr>
                </tfoot>
            </table>

            <div class="text-center mt-5 d-print-none">
                <button onclick="window.print()" class="btn btn-secondary">
                    <i class="fa-solid fa-print"></i> Imprimir Ticket
                </button>
            </div>
        </div>
    </div>
</div>
@endsection