<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heladería Glace - Carrito de Compras</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* ==========================================================================
           VARIABLES Y CONFIGURACIÓN GENERAL (Mantenemos tus estilos limpios)
           ========================================================================== */
        :root {
            --bg-color: #f9f6f0;        /* Un tono crema sutil para la heladería */
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --accent-color: #7bc4c4;    /* Turquesa pastel distintivo de Glace */
            --accent-hover: #69b3b3;
            --border-color: #e2e8f0;
            --danger-color: #ef4444;
            --success-color: #10b981;
            --radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-primary);
            padding: 40px 20px;
        }

        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .cart-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 30px;
        }

        /* Layout de Rejilla */
        .cart-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }

        @media (min-width: 992px) {
            .cart-layout {
                grid-template-columns: 2fr 1fr;
            }
        }

        /* ==========================================================================
           SECCIÓN DE PRODUCTOS (LISTADO)
           ========================================================================== */
        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .cart-item {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            position: relative;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        @media (min-width: 576px) {
            .cart-item {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }

        .item-img .product-avatar {
            width: 90px;
            height: 90px;
            border-radius: 8px;
            background-color: #fbc6a4; /* Tono durazno pastel */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
        }

        .item-details {
            flex: 1;
            min-width: 150px;
        }

        .item-name {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .item-category {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .item-price-mobile {
            display: inline-block;
            margin-top: 8px;
            font-weight: 600;
            color: var(--text-primary);
        }

        @media (min-width: 576px) {
            .item-price-mobile {
                display: none;
            }
        }

        /* ==========================================================================
           CONTROLES Y BOTONES
           ========================================================================== */
        .item-quantity {
            display: flex;
            align-items: center;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            width: fit-content;
            height: 38px;
            overflow: hidden;
            background: white;
        }

        .qty-btn {
            background: none;
            border: none;
            width: 35px;
            height: 100%;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .qty-btn:hover {
            background-color: #e2e8f0;
            color: var(--accent-color);
        }

        .qty-input {
            width: 45px;
            height: 100%;
            border: none;
            border-left: 1px solid var(--border-color);
            border-right: 1px solid var(--border-color);
            text-align: center;
            font-size: 0.95rem;
            font-weight: 600;
            outline: none;
            background-color: #fafafa;
        }

        .qty-input::-webkit-outer-spin-button,
        .qty-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .item-price {
            display: none;
            font-size: 1.15rem;
            font-weight: 600;
            min-width: 100px;
            text-align: right;
        }

        @media (min-width: 576px) {
            .item-price {
                display: block;
            }
        }

        .item-remove {
            position: absolute;
            top: 15px;
            right: 15px;
        }

        @media (min-width: 576px) {
            .item-remove {
                position: static;
            }
        }

        .remove-btn {
            background: none;
            border: none;
            color: var(--text-secondary);
            font-size: 1.15rem;
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s ease, background-color 0.2s ease;
        }

        .remove-btn:hover {
            color: var(--danger-color);
            background-color: #fef2f2;
        }

        /* Alerts informativos de Laravel */
        .alert-session {
            padding: 14px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            font-weight: 500;
            font-size: 0.95rem;
            border: none;
        }
        .alert-success { background-color: #ecfdf5; color: #065f46; }
        .alert-danger { background-color: #fef2f2; color: #991b1b; }

        /* ==========================================================================
           SECCIÓN DE RESUMEN DE LA COMPRA
           ========================================================================== */
        .cart-summary {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            padding: 30px;
            height: fit-content;
            box-shadow: 0 4px 6px rgba(0,0,0,0.01);
        }

        .cart-summary h2 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .summary-divider {
            border: 0;
            height: 1px;
            background-color: var(--border-color);
            margin: 20px 0;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 14px;
            font-size: 0.95rem;
            color: var(--text-secondary);
        }

        .free-shipping {
            color: var(--success-color);
            font-weight: 600;
        }

        .total-row {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 25px;
        }

        .checkout-btn {
            width: 100%;
            background-color: var(--accent-color);
            color: #ffffff;
            border: none;
            padding: 16px 24px;
            border-radius: 8px;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: 0 4px 6px -1px rgba(123, 196, 196, 0.2);
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .checkout-btn:hover {
            background-color: var(--accent-hover);
        }

        .checkout-btn:disabled {
            background-color: #cbd5e1;
            cursor: not-allowed;
            box-shadow: none;
        }

        .continue-shopping {
            display: block;
            text-align: center;
            margin-top: 16px;
            color: var(--text-secondary);
            font-size: 0.95rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .continue-shopping:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: var(--radius);
            border: 1px solid var(--border-color);
        }
        .empty-state i { font-size: 3.5rem; color: #cbd5e1; margin-bottom: 15px; display: block; }
    </style>
</head>
<body>

    <main class="cart-container">
        <h1 class="cart-title">Tu Carrito de Compras</h1>

        @if(session('success'))
            <div class="alert-session alert-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-session alert-danger">⚠ {{ session('error') }}</div>
        @endif
        
        @if(isset($items) && count($items) > 0)
            <div class="cart-layout">
                
                <section class="cart-items">
                    @foreach($items as $item)
                        <div class="cart-item" data-id="{{ $item->id }}">
                            <div class="item-img">
                                <div class="product-avatar">
                                    <i class="fa-solid fa-ice-cream"></i>
                                </div>
                            </div>
                            
                            <div class="item-details">
                                <h3 class="item-name">{{ $item->producto->nombre }}</h3>
                                <p class="item-category">Glace Premium</p>
                                <span class="item-price-mobile">${{ number_format($item->subtotal, 2, ',', '.') }}</span>
                            </div>

                            <div class="item-quantity">
                                <form action="{{ route('carrito.agregar') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $item->producto_id }}">
                                    <input type="hidden" name="cantidad" value="-1">
                                    <button class="qty-btn" type="submit" {{ $item->cantidad <= 1 ? 'disabled' : '' }}>-</button>
                                </form>

                                <input class="qty-input" type="text" value="{{ $item->cantidad }}" readonly>

                                <form action="{{ route('carrito.agregar') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $item->producto_id }}">
                                    <input type="hidden" name="cantidad" value="1">
                                    <button class="qty-btn" type="submit">+</button>
                                </form>
                            </div>

                            <div class="item-price">
                                <p>${{ number_format($item->subtotal, 2, ',', '.') }}</p>
                            </div>

                            <div class="item-remove">
                                <form action="{{ route('carrito.eliminar', $item->id) }}" method="POST" onsubmit="return confirmarEliminar()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove-btn" title="Eliminar producto">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </section>

                <aside class="cart-summary">
                    <h2>Resumen del pedido</h2>
                    <hr class="summary-divider">
                    
                    <div class="summary-row">
                        <span>Subtotal ({{ $items->sum('cantidad') }} productos)</span>
                        <span>${{ number_format($carrito->total, 2, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Costo de envío</span>
                        <span class="free-shipping">Gratis</span>
                    </div>

                    <hr class="summary-divider">
                    
                    <div class="summary-row total-row">
                        <span>Total</span>
                        <span>${{ number_format($carrito->total, 2, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('carrito.confirmar') }}" method="POST">
                        @csrf
                        <button class="checkout-btn" type="submit">
                            Proceder al pago <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </form>
                    
                    <a href="{{ url('/productos') }}" class="continue-shopping">Seguir comprando</a>
                </aside>
            </div>
        @else
            <div class="empty-state">
                <i class="fa-solid fa-basket-shopping"></i>
                <h2>Tu carrito de helados está vacío</h2>
                <p style="color: var(--text-secondary); margin-top: 5px;">¡Pasate por nuestro catálogo para elegir tus gustos!</p>
                <a href="{{ url('/productos') }}" class="continue-shopping" style="font-weight: 600; text-decoration: underline;">Volver a la tienda</a>
            </div>
        @endif
        
    </main>

    <script>
        // JS nativo para alertar antes de purgar un registro
        function confirmarEliminar() {
            return confirm("¿De verdad querés quitar este producto del carrito?");
        }
    </script>
    
</body>
</html>