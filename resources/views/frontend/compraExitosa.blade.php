<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heladería Glace - ¡Compra Exitosa!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f9f6f0; color: #1e293b; font-family: 'Segoe UI', sans-serif; }
        .card-exito { border: none; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); background-color: white; }
        .icono-check { background-color: #f0fdfa; color: #7bc4c4; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; }
        .btn-glace { background-color: #7bc4c4; color: white; font-weight: bold; border-radius: 8px; padding: 12px 24px; transition: all 0.2s; text-decoration: none; display: inline-block; }
        .btn-glace:hover { background-color: #69b3b3; color: white; box-shadow: 0 4px 6px rgba(105, 179, 179, 0.2); }
    </style>
</head>
<body class="d-flex align-items-center min-vh-100 py-5">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            
            <div class="card card-exito p-5">
                <div class="card-body">
                    
                    <div class="icono-check mb-4">
                        <i class="fa-solid fa-circle-check fa-3x"></i>
                    </div>

                    <h2 class="fw-bold mb-2">¡Pedido Realizado!</h2>
                    <p class="text-muted mb-4">Tu compra en <strong>Heladería Glace</strong> ha sido procesada con éxito. Ya estamos preparando tus sabores favoritos.</p>

                    @if(isset($carrito))
                        <div class="p-3 bg-light rounded-3 mb-4 text-start">
                            <div class="d-flex justify-content-between text-secondary small mb-1">
                                <span>Código de Pedido:</span>
                                <span class="fw-bold">#{{ $carrito->id ?? '006' }}</span>
                            </div>
                            <div class="d-flex justify-content-between text-secondary small">
                                <span>Total abonado:</span>
                                <span class="text-success fw-bold">${{ number_format($carrito->total ?? 2500, 2) }}</span>
                            </div>
                        </div>
                    @endif

                    <a href="{{ route('catalogo.publico') }}" class="btn btn-glace w-100">
                        <i class="fa-solid fa-ice-cream me-2"></i> Volver a los Productos
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>