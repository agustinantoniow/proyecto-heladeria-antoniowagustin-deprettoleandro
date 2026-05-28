<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* ==========================================================================
           VARIABLES Y CONFIGURACIÓN GENERAL
           ========================================================================== */
        :root {
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --accent-color: #4f46e5; /* Índigo para los botones principales */
            --accent-hover: #4338ca;
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

        /* Layout de Rejilla (Responsivo) */
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

        .item-img img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 8px;
            background-color: #f1f5f9;
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
            color: var(--accent-color);
        }

        @media (min-width: 576px) {
            .item-price-mobile {
                display: none;
            }
        }

        /* ==========================================================================
           CONTROLES Y BOTONES (ESTILOS)
           ========================================================================== */
        
        /* Contenedor de cantidad */
        .item-quantity {
            display: flex;
            align-items: center;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            width: fit-content;
            height: 38px;
            overflow: hidden;
        }

        /* Botones + y - */
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

        .qty-btn:active {
            background-color: #cbd5e1;
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
            -moz-appearance: textfield;
        }

        /* Ocultar flechas nativas del input numérico */
        .qty-input::-webkit-outer-spin-button,
        .qty-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Precios en Desktop */
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

        /* Botón de eliminación (Tacho) */
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

        /* Cuadro de Cupón */
        .coupon-container {
            display: flex;
            gap: 8px;
            margin-top: 20px;
        }

        .coupon-input {
            flex: 1;
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 0.9rem;
            outline: none;
        }

        .coupon-input:focus {
            border-color: var(--accent-color);
        }

        .coupon-btn {
            padding: 0 16px;
            background-color: #f1f5f9;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .coupon-btn:hover {
            background-color: #e2e8f0;
        }

        /* Botón Principal Checkout */
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
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
            transition: background-color 0.2s ease, transform 0.1s ease, box-shadow 0.2s ease;
        }

        .checkout-btn:hover {
            background-color: var(--accent-hover);
            box-shadow: 0 6px 12px -2px rgba(79, 70, 229, 0.3);
        }

        .checkout-btn:active {
            transform: scale(0.98);
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
    </style>
</head>
<body>

    <main class="cart-container">
        <h1 class="cart-title">Tu Carrito de Compras</h1>
        
        <div class="cart-layout">
            
            <section class="cart-items">
                
                <div class="cart-item">
                    <div class="item-img">
                        <img src="https://via.placeholder.com/100" alt="Producto">
                    </div>
                    <div class="item-details">
                        <h3 class="item-name">Remera Oversize Negra</h3>
                        <p class="item-category">Indumentaria / Hombre</p>
                        <span class="item-price-mobile">$15500</span>
                    </div>
                    <div class="item-quantity">
                        <button class="qty-btn btn-minus" type="button">-</button>
                        <input class="qty-input" type="number" value="1" min="1">
                        <button class="qty-btn btn-plus" type="button">+</button>
                    </div>
                    <div class="item-price">
                        <p>$15500</p>
                    </div>
                    <div class="item-remove">
                        <button class="remove-btn" title="Eliminar producto">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </div>
                </div>

                <div class="cart-item">
                    <div class="item-img">
                        <img src="https://via.placeholder.com/100" alt="Producto">
                    </div>
                    <div class="item-details">
                        <h3 class="item-name">Zapatillas Urbanas Classic</h3>
                        <p class="item-category">Calzado / Unisex</p>
                        <span class="item-price-mobile">$48000</span>
                    </div>
                    <div class="item-quantity">
                        <button class="qty-btn btn-minus" type="button">-</button>
                        <input class="qty-input" type="number" value="2" min="1">
                        <button class="qty-btn btn-plus" type="button">+</button>
                    </div>
                    <div class="item-price">
                        <p>$96000</p>
                    </div>
                    <div class="item-remove">
                        <button class="remove-btn" title="Eliminar producto">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </div>
                </div>

            </section>

            <aside class="cart-summary">
                <h2>Resumen del pedido</h2>
                <hr class="summary-divider">
                
                <div class="summary-row">
                    <span>Subtotal (<span id="total-items-count">3</span> productos)</span>
                    <span id="subtotal-amount">$111500</span>
                </div>
                <div class="summary-row">
                    <span>Costo de envío</span>
                    <span class="free-shipping">Gratis</span>
                </div>
                
                <div class="coupon-container">
                    <input type="text" placeholder="Código de descuento" class="coupon-input">
                    <button type="button" class="coupon-btn">Aplicar</button>
                </div>

                <hr class="summary-divider">
                
                <div class="summary-row total-row">
                    <span>Total</span>
                    <span id="total-amount">$111500</span>
                </div>

                <button class="checkout-btn" type="button">
                    Proceder al pago <i class="fa-solid fa-arrow-right"></i>
                </button>
                
                <a href="/" class="continue-shopping">Seguir comprando</a>
            </aside>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Manejadores para sumar o restar cantidades mediante los botones
            document.querySelectorAll('.cart-item').forEach(item => {
                const input = item.querySelector('.qty-input');
                const btnMinus = item.querySelector('.btn-minus');
                const btnPlus = item.querySelector('.btn-plus');
                const btnRemove = item.querySelector('.remove-btn');

                // Evento Sumar Cantidad
                btnPlus.addEventListener('click', () => {
                    input.value = parseInt(input.value) + 1;
                    actualizarPreciosYResumen();
                });

                // Evento Restar Cantidad
                btnMinus.addEventListener('click', () => {
                    if (parseInt(input.value) > 1) {
                        input.value = parseInt(input.value) - 1;
                        actualizarPreciosYResumen();
                    }
                });

                // Evitar valores menores a 1 si se tipea manualmente
                input.addEventListener('change', () => {
                    if (parseInt(input.value) < 1 || isNaN(parseInt(input.value))) {
                        input.value = 1;
                    }
                    actualizarPreciosYResumen();
                });

                // Simular eliminación visual de producto
                btnRemove.addEventListener('click', () => {
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.95)';
                    item.style.transition = 'all 0.3s ease';
                    setTimeout(() => {
                        item.remove();
                        actualizarPreciosYResumen();
                    }, 300);
                });
            });

            // Función encargada de recalcular cantidades y totales en pantalla
            function actualizarPreciosYResumen() {
                let totalProductos = 0;
                let subtotalGeneral = 0;

                // Datos duros simulados para calcular según cada producto (reemplazable por backend)
                const preciosUnitarios = {
                    "Remera Oversize Negra": 15500,
                    "Zapatillas Urbanas Classic": 48000
                };

                document.querySelectorAll('.cart-item').forEach(item => {
                    const name = item.querySelector('.item-name').innerText;
                    const cantidad = parseInt(item.querySelector('.qty-input').value) || 0;
                    const precioUnitario = preciosUnitarios[name] || 0;
                    
                    const subtotalItem = precioUnitario * cantidad;
                    totalProductos += cantidad;
                    subtotalGeneral += subtotalItem;

                    // Actualizar el precio de este ítem en Desktop
                    const priceContainer = item.querySelector('.item-price p');
                    if(priceContainer) {
                        priceContainer.innerText = `$${subtotalItem}`;
                    }
                });

                // Actualizar bloques del panel de resumen de compras
                document.getElementById('total-items-count').innerText = totalProductos;
                document.getElementById('subtotal-amount').innerText = `$${subtotalGeneral}`;
                document.getElementById('total-amount').innerText = `$${subtotalGeneral}`;

                // Deshabilitar botón de confirmación si el carrito quedó vacío
                const checkoutBtn = document.querySelector('.checkout-btn');
                if (totalProductos === 0) {
                    checkoutBtn.disabled = true;
                    checkoutBtn.innerText = "Carrito Vacío";
                }
            }
        });
    </script>
</body>
</html>