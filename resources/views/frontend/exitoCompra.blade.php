@extends('components.layoutCliente')
@section('content')
<div class="container mt-5 mb-5 text-center">
    <div class="card shadow border-0 p-5 mx-auto" style="max-width: 600px;">
        <i class="fa-solid fa-circle-check text-success" style="font-size: 80px;"></i>
        <h1 class="mt-4 text-success">¡Compra realizada con éxito!</h1>
        <p class="fs-5 mt-3">Tu pedido ya está siendo preparado en Heladería Glace.</p>
        
        <div class="alert alert-info fs-4 fw-bold mt-3 mb-4">
            Tu código de pedido es: {{ $venta->codigo_seguimiento }}
        </div>

        <a href="{{ route('carrito.comprobante', $venta->id) }}" class="btn btn-primary btn-lg mb-3">
            <i class="fa-solid fa-file-invoice"></i> Ver Comprobante de Compra
        </a>
        <br>
        <a href="{{ route('cliente.home') }}" class="btn btn-outline-secondary">Volver al inicio</a>
    </div>
</div>
@endsection