@extends ('components.layoutCliente')

@section('title', 'heladeria - Terminos y Usos')

@section('content')

<div class="container mt-5 mb-5">
    
   <div class="container mt-5 mb-5">
    <div class="text-center mb-5">
        <h1 class="titulo-seccion-glace bg-info text-white p-3">
            Términos y Usos del Sitio
        </h1>
    </div>

    <div class="presentacion p-5 rounded-4 shadow-lg border-0">
        
        <p class="card-text-glace lead border-bottom pb-3 mb-4">
            Reglas, condiciones y arquitectura técnica para el uso de nuestra plataforma <b>Glace v1.0</b>.
        </p>

        <div class="mt-4">
            <h4 class="subtitulo-producto-glace">1. Definición del Ecosistema</h4>
            <p class="card-text-glace">
                Este sitio web utiliza el lenguaje <strong>HTML</strong> para definir su estructura y <strong>Bootstrap</strong> para su apariencia visual. 
                Funciona bajo una arquitectura <strong>Cliente-Servidor</strong>, donde tu navegador realiza peticiones HTTP a nuestro servidor <b>Laravel</b>, garantizando una carga eficiente de nuestros sabores.
            </p>
        </div>

        <div class="mt-4">
            <h4 class="subtitulo-producto-glace">2. Peticiones y Procesamiento</h4>
            <p class="card-text-glace">
                Al utilizar nuestro sistema de pedidos o formularios, se realiza una petición de tipo <strong>POST</strong> cifrada. 
                Los datos son procesados por un <strong>Controlador</strong> específico, el cual interactúa con nuestros modelos para devolver una respuesta dinámica y personalizada a cada cliente.
            </p>
        </div>

        <div class="mt-4">
            <h4 class="subtitulo-producto-glace">3. Uso Correcto y Repositorio</h4>
            <p class="card-text-glace">
                El usuario se compromete a no realizar acciones de <i>SQL Injection</i> o ataques que dañen la integridad de nuestro repositorio almacenado en <strong>GitHub</strong>. El historial de cambios es propiedad exclusiva del equipo de desarrollo de Glace.
            </p>
        </div>

        <div class="mt-4">
            <h4 class="subtitulo-producto-glace">4. Garantía de Servicio</h4>
            <p class="card-text-glace">
                Nuestra garantía cubre la persistencia de los datos del pedido y la cadena de frío mediante procedimientos de <b>Logística Post-Venta</b>. Ante cualquier error de <i>Status 500</i>, nuestro soporte técnico intervendrá de inmediato.
            </p>
        </div>

        <div class="mt-5 text-center">
            <a href="{{ url('/Cliente') }}" class="btn btn-info text-white fw-bold px-5 py-2 shadow-sm" style="font-family: Fredoka, sans-serif;">
                        Entendido y Volver
            </a>
            <a href="{{ url('/contactoCliente') }}" class="btn btn-outline-info fw-bold px-5 py-2 ms-2 shadow-sm" style="font-family: 'Fredoka', sans-serif;">
                Tengo dudas
            </a>
        </div>

    </div>
</div>
</div>
@endsection