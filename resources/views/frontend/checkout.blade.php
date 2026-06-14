<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heladería Glace - Finalizar Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f9f6f0; color: #1e293b; font-family: 'Segoe UI', sans-serif; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .btn-glace { background-color: #7bc4c4; color: white; font-weight: bold; border-radius: 8px; padding: 12px; }
        .btn-glace:hover { background-color: #69b3b3; color: white; }
        .opcion-caja { border: 2px solid #e2e8f0; border-radius: 8px; padding: 15px; cursor: pointer; transition: all 0.2s; }
        .opcion-caja:hover { border-color: #7bc4c4; background-color: #f0fdfa; }
        input[type="radio"]:checked + .opcion-caja { border-color: #7bc4c4; background-color: #f0fdfa; box-shadow: 0 0 0 2px rgba(123, 196, 196, 0.2); }
    </style>
</head>
<body class="py-5">

<div class="container">
    <h2 class="fw-bold mb-4"><i class="fa-solid fa-check-circle me-2" style="color: #7bc4c4;"></i> Finalizar Pedido</h2>

    <form action="{{ route('carrito.procesar') }}" method="POST">
        @csrf
        <div class="row g-4">
            
            {{-- Columna Izquierda: Opciones --}}
            <div class="col-lg-8">
                
                {{-- 1. Método de Entrega --}}
                <div class="card card-custom mb-4">
                    <div class="card-body p-4">
                        <h4 class="mb-3">1. ¿Cómo querés recibir tu helado?</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="w-100">
                                    <input type="radio" name="tipo_entrega" value="local" class="d-none" id="entrega_local" required checked>
                                    <div class="opcion-caja text-center">
                                        <i class="fa-solid fa-store fa-2x mb-2" style="color: #ef4444;"></i>
                                        <h5 class="m-0">Retiro en local</h5>
                                        <small class="text-muted">Gratis - Te esperamos por la sucursal</small>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="w-100">
                                    <input type="radio" name="tipo_entrega" value="domicilio" class="d-none" id="entrega_domicilio">
                                    <div class="opcion-caja text-center">
                                        <i class="fa-solid fa-motorcycle fa-2x mb-2" style="color: #ef4444;"></i>
                                        <h5 class="m-0">Envío a domicilio</h5>
                                        <small class="text-muted">¡Te lo llevamos volando!</small>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div id="seccion-envio" class="mt-4 pt-3 border-top" style="display: none;">
                            <h5 class="mb-3 text-secondary"><i class="fa-solid fa-map-marker-alt me-2"></i>Datos de Entrega</h5>
                            <div class="row text-start">
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label">Teléfono de Contacto</label>
                                    <input type="tel" class="form-control entrada-envio" id="telefono" name="telefono" placeholder="Ej: 3794123456">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="direccion" class="form-label">Dirección Completa</label>
                                    <input type="text" class="form-control entrada-envio" id="direccion" name="direccion" placeholder="Calle, Número, Depto">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- 2. Medio de Pago --}}
                <div class="card card-custom mb-4">
                    <div class="card-body p-4">
                        <h4 class="mb-3">2. Medio de Pago</h4>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="w-100">
                                    <input type="radio" name="metodo_pago" value="efectivo" class="d-none" id="pago_efectivo" required checked>
                                    <div class="opcion-caja text-center p-3">
                                        <i class="fa-solid fa-money-bill-wave fs-3 mb-2 text-success"></i>
                                        <h6 class="m-0">Efectivo</h6>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="w-100">
                                    <input type="radio" name="metodo_pago" value="tarjeta" class="d-none" id="pago_tarjeta">
                                    <div class="opcion-caja text-center p-3">
                                        <i class="fa-solid fa-credit-card fs-3 mb-2 text-primary"></i>
                                        <h6 class="m-0">Tarjeta</h6>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="w-100">
                                    <input type="radio" name="metodo_pago" value="mercadopago" class="d-none" id="pago_mercadopago">
                                    <div class="opcion-caja text-center p-3">
                                        <i class="fa-solid fa-mobile-screen fs-3 mb-2 text-info"></i>
                                        <h6 class="m-0">Mercado Pago</h6>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div id="seccion-tarjeta" class="mt-4 pt-3 border-top" style="display: none;">
                            <h5 class="mb-3 text-secondary"><i class="fa-solid fa-credit-card me-2"></i>Detalles de la Tarjeta</h5>
                            
                            <div class="mb-3 text-start">
                                <label for="tarjeta_nombre" class="form-label">Nombre impreso en la tarjeta</label>
                                <input type="text" class="form-control entrada-tarjeta" id="tarjeta_nombre" name="tarjeta_nombre" placeholder="JUAN PEREZ">
                            </div>

                            <div class="mb-3 text-start">
                                <label for="tarjeta_numero" class="form-label">Número de Tarjeta</label>
                                <input type="text" class="form-control entrada-tarjeta" id="tarjeta_numero" name="tarjeta_numero" placeholder="0000 0000 0000 0000" maxlength="16">
                            </div>

                            <div class="row text-start">
                                <div class="col-md-6 mb-3">
                                    <label for="tarjeta_vencimiento" class="form-label">Vencimiento</label>
                                    <input type="text" class="form-control entrada-tarjeta" id="tarjeta_vencimiento" name="tarjeta_vencimiento" placeholder="MM/AA" maxlength="5">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tarjeta_cvv" class="form-label">Código de Seguridad (CVV)</label>
                                    <input type="password" class="form-control entrada-tarjeta" id="tarjeta_cvv" name="tarjeta_cvv" placeholder="123" maxlength="4">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Columna Derecha: Resumen --}}
            <div class="col-lg-4">
                <div class="card card-custom sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <h4 class="mb-4 border-bottom pb-2">Tu Pedido</h4>
                        
                        @foreach($items as $item)
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ $item->cantidad }}x {{ $item->producto->nombre }}</span>
                                <span>${{ number_format($item->subtotal, 2) }}</span>
                            </div>
                        @endforeach
                        
                        <hr>
                        <div class="d-flex justify-content-between mb-4 fs-4 fw-bold">
                            <span>Total</span>
                            <span class="text-success">${{ number_format($carrito->total, 2) }}</span>
                        </div>
                        
                        <button type="submit" class="btn btn-glace w-100 mb-2">
                            <i class="fa-solid fa-basket-shopping me-2"></i> Confirmar y Pagar
                        </button>
                        
                        <a href="{{ route('carrito.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                            Volver al carrito
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // --- CONTROL DE ENVÍO a DOMICILIO ---
        const radiosEntrega = document.querySelectorAll('input[name="tipo_entrega"]');
        const seccionEnvio = document.getElementById('seccion-envio');
        const entradasEnvio = document.querySelectorAll('.entrada-envio');

        function evaluarEnvio() {
            const seleccion = document.querySelector('input[name="tipo_entrega"]:checked').value;
            if (seleccion === 'domicilio') {
                seccionEnvio.style.display = 'block';
                entradasEnvio.forEach(input => input.setAttribute('required', 'required'));
            } else {
                seccionEnvio.style.display = 'none';
                entradasEnvio.forEach(input => {
                    input.removeAttribute('required');
                    input.value = ''; // Resetea el valor para evitar envíos basura
                });
            }
        }
        radiosEntrega.forEach(radio => radio.addEventListener('change', evaluarEnvio));

        // --- CONTROL DE TARJETA DE CRÉDITO ---
        const radiosPago = document.querySelectorAll('input[name="metodo_pago"]');
        const seccionTarjeta = document.getElementById('seccion-tarjeta');
        const entradasTarjeta = document.querySelectorAll('.entrada-tarjeta');

        function evaluarPago() {
            const seleccion = document.querySelector('input[name="metodo_pago"]:checked').value;
            if (seleccion === 'tarjeta') {
                seccionTarjeta.style.display = 'block';
                entradasTarjeta.forEach(input => input.setAttribute('required', 'required'));
            } else {
                seccionTarjeta.style.display = 'none';
                entradasTarjeta.forEach(input => {
                    input.removeAttribute('required');
                    input.value = ''; // Limpia los inputs si cambia a Efectivo/MP
                });
            }
        }
        radiosPago.forEach(radio => radio.addEventListener('change', evaluarPago));

        // Inicializar estados al cargar la página
        evaluarEnvio();
        evaluarPago();
    });
</script>
</body>
</html>