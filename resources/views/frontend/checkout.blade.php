@extends('components.layoutCliente')
@section('content')
<div class="container mt-5 mb-5">
    
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
                    <form action="{{ route('carrito.procesar') }}" method="POST" id="formCheckout">
                        @csrf
                        <h5 class="mb-3">Datos de Contacto</h5>
                        <div class="row">
                            {{-- Campo DNI --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">DNI <span class="text-danger">*</span></label>
                                <input type="text" inputmode="numeric" name="dni" id="inputDni" class="form-control @error('dni') is-invalid @enderror" value="{{ old('dni') }}" placeholder="Sin puntos ni espacios" required>
                                @error('dni')
                                    <div class="invalid-feedback fw-bold">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            {{-- Campo Teléfono --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Teléfono <span class="text-danger">*</span></label>
                                <input type="text" inputmode="numeric" name="telefono" id="inputTelefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" placeholder="Ej: 3794123456" required>
                                @error('telefono')
                                    <div class="invalid-feedback fw-bold">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <h5 class="mb-3 mt-4">Método de Entrega</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check border p-2 rounded">
                                    <input class="form-check-input ms-1" type="radio" name="tipo_entrega" id="retiro_local" value="local" {{ old('tipo_entrega', 'local') == 'local' ? 'checked' : '' }} required>
                                    <label class="form-check-label ms-2 fw-bold" for="retiro_local">
                                        <i class="fa-solid fa-shop me-1 text-primary"></i> Retirar en el Local
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check border p-2 rounded">
                                    <input class="form-check-input ms-1" type="radio" name="tipo_entrega" id="envio_domicilio" value="domicilio" {{ old('tipo_entrega') == 'domicilio' ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2 fw-bold" for="envio_domicilio">
                                        <i class="fa-solid fa-motorcycle me-1 text-success"></i> Envío a Domicilio
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Contenedor de campos dinámicos para Envío --}}
                        <div id="wrapper_domicilio" class="p-3 bg-light rounded border mb-4" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Dirección de Envío <span class="text-danger">*</span></label>
                                <input type="text" name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}" placeholder="Ej: San Martín 1234">
                                @error('direccion')
                                    <div class="invalid-feedback fw-bold">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label class="form-label fw-bold">Medio de Pago <span class="text-danger">*</span></label>
                                <select name="medio_pago" id="medio_pago" class="form-select @error('medio_pago') is-invalid @enderror">
                                    <option value="">Elegí un medio de pago...</option>
                                    <option value="tarjeta" {{ old('medio_pago') == 'tarjeta' ? 'selected' : '' }}>Tarjeta de Crédito / Débito</option>
                                    <option value="mercadopago" {{ old('medio_pago') == 'mercadopago' ? 'selected' : '' }}>MercadoPago</option>
                                    <option value="efectivo" {{ old('medio_pago') == 'efectivo' ? 'selected' : '' }}>Efectivo (al recibir)</option>
                                </select>
                                @error('medio_pago')
                                    <div class="invalid-feedback fw-bold">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 fs-5 fw-bold py-2 shadow-sm">Finalizar Compra 🍦</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Resumen del Pedido</h5>
                    <hr>
                    @foreach($venta->detalles as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">{{ $item->cantidad }}x {{ $item->producto->nombre }}</span>
                            <span class="fw-bold">${{ number_format($item->subtotal, 2, ',', '.') }}</span>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5 text-primary">
                        <span>Total:</span>
                        <span>${{ number_format($venta->total, 2, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radioLocal = document.getElementById('retiro_local');
        const radioDomicilio = document.getElementById('envio_domicilio');
        const inputDireccion = document.getElementById('direccion');
        const selectMedioPago = document.getElementById('medio_pago');
        const wrapperDomicilio = document.getElementById('wrapper_domicilio');

        // 1. Bloqueo absoluto de espacios en caliente para DNI y Teléfono
        ['inputDni', 'inputTelefono'].forEach(id => {
            document.getElementById(id).addEventListener('keydown', function(e) {
                if (e.key === ' ' || e.code === 'Space') {
                    e.preventDefault();
                }
            });
        });

        // 2. Control dinámico de interfaz y atributos obligatorios
        function actualizarCampos() {
            if (radioDomicilio.checked) {
                wrapperDomicilio.style.display = 'block';
                inputDireccion.setAttribute('required', 'required');
                selectMedioPago.setAttribute('required', 'required');
            } else {
                wrapperDomicilio.style.display = 'none';
                inputDireccion.removeAttribute('required');
                selectMedioPago.removeAttribute('required');
            }
        }

        actualizarCampos();

        radioLocal.addEventListener('change', actualizarCampos);
        radioDomicilio.addEventListener('change', actualizarCampos);
    });
</script>
@endsection