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
                                    <input type="radio" name="tipo_entrega" value="local" class="d-none" required>
                                    <div class="opcion-caja text-center">
                                        <i class="fa-solid fa-store fa-2x mb-2" style="color: #ef4444;"></i>
                                        <h5 class="m-0">Retiro en local</h5>
                                        <small class="text-muted">Gratis - Te esperamos por la sucursal</small>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="w-100">
                                    <input type="radio" name="tipo_entrega" value="domicilio" class="d-none">
                                    <div class="opcion-caja text-center">
                                        <i class="fa-solid fa-motorcycle fa-2x mb-2" style="color: #ef4444;"></i>
                                        <h5 class="m-0">Envío a domicilio</h5>
                                        <small class="text-muted">Calculamos el costo en el próximo paso</small>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. Medio de Pago --}}
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <h4 class="mb-3">2. Medio de Pago</h4>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="w-100">
                                    <input type="radio" name="metodo_pago" value="efectivo" class="d-none" required>
                                    <div class="opcion-caja text-center p-3">
                                        <i class="fa-solid fa-money-bill-wave fs-3 mb-2 text-success"></i>
                                        <h6 class="m-0">Efectivo</h6>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="w-100">
                                    <input type="radio" name="metodo_pago" value="tarjeta" class="d-none">
                                    <div class="opcion-caja text-center p-3">
                                        <i class="fa-solid fa-credit-card fs-3 mb-2 text-primary"></i>
                                        <h6 class="m-0">Tarjeta</h6>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="w-100">
                                    <input type="radio" name="metodo_pago" value="mercadopago" class="d-none">
                                    <div class="opcion-caja text-center p-3">
                                        <i class="fa-solid fa-mobile-screen fs-3 mb-2 text-info"></i>
                                        <h6 class="m-0">Mercado Pago</h6>
                                    </div>
                                </label>
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
                        
                        <button type="submit" class="btn btn-glace w-100 py-3 fs-5">
                            Confirmar y Obtener Código <i class="fa-solid fa-lock ms-1"></i>
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

</body>
</html>