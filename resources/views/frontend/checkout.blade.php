@extends('components.layoutCliente')
@section('content')
<div class="container mt-5 mb-5">
    {{-- Bloque para atrapar y ver errores de validación en la terminal visual --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="fa-solid fa-triangle-exclamation me-2"></i> Por favor corregí los siguientes errores:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2 class="mb-4">Finalizar Compra</h2>
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('carrito.procesar') }}" method="POST">
                        @csrf
                        <h5 class="mb-3">Datos de Contacto</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">DNI</label>
                                <input type="number" name="dni" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="text" name="telefono" class="form-control" required>
                            </div>
                        </div>

                        {{-- ESTA ES LA SECCIÓN QUE FALTABA --}}
                        <h5 class="mb-3 mt-4">Método de Entrega</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check border p-2 rounded">
                                    <input class="form-check-input ms-1" type="radio" name="tipo_entrega" id="retiro_local" value="local" checked required>
                                    <label class="form-check-label ms-2" for="retiro_local">
                                        Retirar en el Local
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check border p-2 rounded">
                                    <input class="form-check-input ms-1" type="radio" name="tipo_entrega" id="envio_domicilio" value="domicilio">
                                    <label class="form-check-label ms-2" for="envio_domicilio">
                                        Envío a Domicilio
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dirección de Envío (Solo si elegiste envío a domicilio)</label>
                            <input type="text" name="direccion" class="form-control" placeholder="Ej: San Martín 1234">
                        </div>

                        <h5 class="mb-3 mt-4">Medio de Pago</h5>
                        <label class="form-label text-muted">Seleccioná un medio de pago (Obligatorio solo para envío a domicilio)</label>
                        <select name="medio_pago" id="medio_pago" class="form-select mb-4">
                            <option value="">Elegí un medio de pago (Solo para envío a domicilio)</option>
                            <option value="tarjeta">Tarjeta de Crédito / Débito</option>
                            <option value="mercadopago">MercadoPago</option>
                            <option value="efectivo">Efectivo (al recibir)</option>
                        </select>

                        <button type="submit" class="btn btn-success w-100 fs-5">Finalizar Compra</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Resumen del Pedido</h5>
                    <hr>
                    @foreach($venta->detalles as $item)
                        <div class="d-flex justify-content-between">
                            <span>{{ $item->cantidad }}x {{ $item->producto->nombre }}</span>
                            <span>${{ number_format($item->subtotal, 2) }}</span>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total:</span>
                        <span>${{ number_format($venta->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection