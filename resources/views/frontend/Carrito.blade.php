<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Heladería - Pedido Offcanvas</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Pacifico&display=swap" rel="stylesheet" />
  
  <style>
    /* ══ RESET BASE ══ */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: #FFF8F5; /* Fondo crema suave de tu heladería */
      min-height: 100vh;
      color: #2C2C2A;
    }

    /* ══ NAVBAR (Fijo arriba) ══ */
    .navbar {
      position: fixed;
      top: 0; left: 0; right: 0;
      height: 60px;
      background: #ffffff;
      border-bottom: 1px solid #E8E6DF;
      display: flex;
      align-items: center;
      justify-content: flex-end; /* Botón alineado a la derecha */
      padding: 0 1.5rem;
      z-index: 90;
    }

    /* Tu botón de Carrito Estilo Píldora Naranja */
    .navbar-cart-btn {
      background: #D85A30;
      color: #ffffff;
      border: none;
      border-radius: 99px;
      padding: 8px 18px;
      font-size: 14px;
      font-weight: 500;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: background 0.15s ease;
    }
    .navbar-cart-btn:hover { background: #993C1D; }

    .nav-badge {
      background: #ffffff;
      color: #D85A30;
      font-size: 12px;
      font-weight: 700;
      border-radius: 99px;
      padding: 1px 8px;
      min-width: 22px;
      text-align: center;
    }

    /* ══ BARRA DESPLEGABLE OFFCANVAS (Estilo Heladería) ══ */
    .cart-sidebar {
      position: fixed;
      top: 0; 
      right: 0;
      height: 100vh;
      width: 360px;
      max-width: 100vw;
      background: #ffffff;
      border-left: 1px solid #E8E6DF;
      box-shadow: -5px 0 25px rgba(0,0,0,0.08);
      display: flex;
      flex-direction: column;
      z-index: 100;
      
      /* Oculto al 100% a la derecha fuera de la pantalla */
      transform: translateX(100%); 
      transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    /* Estado abierto: se desliza a su posición original */
    .cart-sidebar.open { 
      transform: translateX(0); 
    }

    /* Encabezado del Carrito */
    .cart-sidebar-header {
      padding: 1.25rem;
      border-bottom: 1px solid #F1EFE8;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .cart-header-title { 
      font-family: 'DM Sans', sans-serif;
      font-size: 16px; 
      font-weight: 700; 
      color: #2C2C2A;
      flex: 1; 
    }
    .cart-badge {
      background: #D85A30; 
      color: #ffffff;
      font-size: 12px; 
      font-weight: 700;
      border-radius: 99px; 
      padding: 2px 10px;
    }
    .close-btn {
      background: none; 
      border: none; 
      cursor: pointer;
      font-size: 20px; 
      color: #888780; 
      line-height: 1; 
      padding: 2px;
      transition: color 0.15s;
    }
    .close-btn:hover { color: #D85A30; }

    /* Cuerpo deslizable donde van los helados */
    .cart-items { 
      flex: 1; 
      overflow-y: auto; 
      padding: 0.75rem 1.25rem; 
    }
    .empty-msg { 
      font-size: 14px; 
      color: #888780; 
      text-align: center; 
      padding: 3rem 0; 
    }

    /* Cada fila de helado en el pedido */
    .cart-item {
      display: flex; 
      align-items: center; 
      gap: 12px;
      padding: 14px 0; 
      border-bottom: 1px solid #F1EFE8;
    }
    .cart-item:last-of-type { border-bottom: none; }
    
    .cart-item-emoji {
      font-size: 24px;
    }
    .cart-item-info { flex: 1; }
    .cart-item-name { font-size: 14px; font-weight: 700; color: #2C2C2A; margin-bottom: 2px; }
    .cart-item-flavor { font-size: 11px; color: #888780; margin-bottom: 4px; }
    .cart-item-uprice { font-size: 11px; color: #D85A30; font-weight: 500; }
    
    /* Selector de cantidades redondeado píldora gris */
    .qty-controls { 
      display: flex; 
      align-items: center; 
      background: #F1EFE8;
      border-radius: 20px;
      padding: 3px 8px;
      gap: 8px; 
    }
    .qty-btn {
      width: 20px; 
      height: 20px;
      border: none;
      background: transparent; 
      font-size: 14px; 
      font-weight: bold;
      cursor: pointer;
      display: flex; 
      align-items: center; 
      justify-content: center;
      color: #2C2C2A; 
    }
    .qty-btn:hover { color: #D85A30; }
    .qty-num { font-size: 13px; font-weight: 700; min-width: 14px; text-align: center; }
    
    .cart-item-sub { font-size: 13px; font-weight: 700; min-width: 65px; text-align: right; color: #2C2C2A; }

    /* Footer del Offcanvas */
    .cart-footer { 
      padding: 1.25rem; 
      border-top: 1px solid #F1EFE8; 
      background: #FFFBF9;
    }
    .total-row {
      display: flex;
      justify-content: space-between;
      font-size: 13px;
      color: #888780;
      margin-bottom: 4px;
    }
    .total-final { 
      display: flex; 
      justify-content: space-between; 
      font-size: 16px; 
      font-weight: 700; 
      margin-top: 6px;
      margin-bottom: 14px; 
    }
    #total { color: #D85A30; font-size: 18px; }

    /* Botón celeste para Confirmar/Finalizar de tu web */
    .checkout-btn {
      width: 100%; 
      background: #00c3f3; 
      color: #ffffff; 
      border: none;
      border-radius: 99px; 
      padding: 13px; 
      font-size: 14px; 
      font-weight: 700;
      font-family: 'DM Sans', sans-serif; 
      cursor: pointer; 
      box-shadow: 0 4px 12px rgba(0, 195, 243, 0.15);
      transition: background 0.15s, transform 0.1s;
    }
    .checkout-btn:hover { background: #00b2dd; }
    .checkout-btn:active { transform: scale(0.98); }

    /* ══ OVERLAY (Cortina translúcida de fondo) ══ */
    .overlay {
      position: fixed; 
      inset: 0;
      background: rgba(44, 44, 42, 0.25);
      opacity: 0; 
      pointer-events: none;
      transition: opacity 0.3s ease; 
      backdrop-filter: blur(1px);
      z-index: 99;
    }
    .overlay.show { opacity: 1; pointer-events: all; }

    /* Margen superior en el cuerpo para no pisar el Navbar */
    .page-content { padding-top: 80px; text-align: center; color: #888780; }
  </style>
</head>
<body>

<nav class="navbar">
  <button class="navbar-cart-btn" onclick="abrirCarrito()">
    🛒 Carrito <span class="nav-badge" id="nav-count">0</span>
  </button>
</nav>

<div class="overlay" id="overlay" onclick="cerrarCarrito()"></div>

<aside class="cart-sidebar" id="cart-sidebar">
  <div class="cart-sidebar-header">
    <span style="font-size: 20px;">🍦</span>
    <span class="cart-header-title">Tu pedido</span>
    <span class="cart-badge" id="cart-count-sidebar">0</span>
    <button class="close-btn" onclick="cerrarCarrito()">✕</button>
  </div>
  
  <div class="cart-items" id="cart-body">
    </div>

  <div class="cart-footer" id="cart-footer" style="display:none;">
    <div class="total-row">
      <span>Envío</span>
      <span style="color: #27ae60; font-weight: 500;">Gratis en local</span>
    </div>
    <div class="total-final">
      <span>Total a pagar</span>
      <span id="total">$0</span>
    </div>
    <button class="checkout-btn">Confirmar Pedido ✓</button>
  </div>
</aside>

<main class="page-content">
  <p>El catálogo e imágenes de tu heladería se quedan fijos en el fondo.</p>
</main>

<script>
  // Menú de productos simulado de tu heladería
  const productosHeladeria = [
    { id: 1, emoji: '🍦', nombre: 'Cucurucho Artesanal', sabor: 'Sabores a elección', precio: 1200 },
    { id: 2, emoji: '🍨', nombre: 'Copa Doble', sabor: '2 bochas grandes', precio: 2200 },
    { id: 3, emoji: '🥤', nombre: 'Milkshake Premium', sabor: 'Batido con toppings', precio: 3200 }
  ];

  // Estado del carrito precargado con helados de ejemplo para ver el diseño funcionando
  let carrito = { 1: 2, 2: 1 };

  function formatMoneda(valor) { 
    return '$' + valor.toLocaleString('es-AR'); 
  }

  // Abre el Offcanvas agregando clases CSS (Sin recargar la página)
  function abrirCarrito() {
    document.getElementById('cart-sidebar').classList.add('open');
    document.getElementById('overlay').classList.add('show');
  }
  
  // Cierra el Offcanvas quitando las clases CSS
  function cerrarCarrito() {
    document.getElementById('cart-sidebar').classList.remove('open');
    document.getElementById('overlay').classList.remove('show');
  }

  // Sumar o restar cantidades de forma reactiva
  function modificarCantidad(id, cambio) {
    carrito[id] = (carrito[id] || 0) + cambio;
    
    // Si la cantidad llega a 0 se elimina del carrito
    if (carrito[id] <= 0) {
      delete carrito[id];
    }
    
    renderizarCarrito();
  }

  // Dibuja los helados en el Offcanvas y calcula el total acumulado
  function renderizarCarrito() {
    const listadoIds = Object.keys(carrito);
    const sumaUnidades = listadoIds.reduce((total, id) => total + carrito[id], 0);
    
    // Sincroniza los globos contadores numéricos
    document.getElementById('cart-count-sidebar').textContent = sumaUnidades;
    document.getElementById('nav-count').textContent = sumaUnidades;

    const contenedorBody = document.getElementById('cart-body');
    const contenedorFooter = document.getElementById('cart-footer');

    if (listadoIds.length === 0) {
      contenedorBody.innerHTML = '<p class="empty-msg">Tu carrito está vacío 🍨<br><span style="font-size:12px; color:#aaa;">¡Elegí tus sabores favoritos!</span></p>';
      contenedorFooter.style.display = 'none';
      return;
    }

    let calculoTotal = 0;
    
    contenedorBody.innerHTML = listadoIds.map(id => {
      const helado = productosHeladeria.find(x => x.id == id);
      const subtotalFila = helado.precio * carrito[id];
      calculoTotal += subtotalFila;
      
      return `
        <div class="cart-item">
          <span class="cart-item-emoji">${helado.emoji}</span>
          <div class="cart-item-info">
            <div class="cart-item-name">${helado.nombre}</div>
            <div class="cart-item-flavor">${helado.sabor}</div>
            <div class="cart-item-uprice">${formatMoneda(helado.precio)} c/u</div>
          </div>
          <div class="qty-controls">
            <button class="qty-btn" onclick="modificarCantidad(${helado.id}, -1)">−</button>
            <span class="qty-num">${carrito[id]}</span>
            <button class="qty-btn" onclick="modificarCantidad(${helado.id}, 1)">+</button>
          </div>
          <span class="cart-item-sub">${formatMoneda(subtotalFila)}</span>
        </div>`;
    }).join('');

    // Setea el total final y muestra el footer
    document.getElementById('total').textContent = formatMoneda(calculoTotal);
    contenedorFooter.style.display = 'block';
  }

  // Ejecución inicial para pintar el pedido actual
  renderizarCarrito();
</script>

</body>
</html>