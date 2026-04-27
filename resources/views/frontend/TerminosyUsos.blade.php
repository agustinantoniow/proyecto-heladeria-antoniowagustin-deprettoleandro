@extends ('components.layout')

@section('title', 'heladeria - Terminos y Usos')

@section('content')

<div class="container mt-5 mb-5">
    
    <div class="card shadow border-0">
        <div class="card-body p-5">
            
            <h1 class="card-title mb-4">Términos y Usos - Heladería Glace</h1>
            <p class="lead text-muted border-bottom pb-3">
                Reglas y condiciones para el uso de nuestra plataforma web.
            </p>

            <div class="mt-4">
                <h4 class="fw-bold">1. Definición del Sitio</h4>
                <p>
                    Este sitio web utiliza el lenguaje <strong>HTML</strong> para definir su estructura y <strong>Bootstrap</strong> para su apariencia visual. 
                    Funciona bajo una arquitectura <strong>Cliente-Servidor</strong>, donde tu navegador realiza peticiones HTTP a nuestro servidor Laravel.
                </p>
            </div>

            <div class="mt-4">
                <h4 class="fw-bold">2. Peticiones y Datos</h4>
                <p>
                    Al utilizar nuestro formulario de consultas, se realiza una petición de tipo <strong>POST</strong>. 
                    Los datos enviados son procesados por un <strong>Controlador</strong>, el cual decide qué respuesta dinámica devolver al usuario.
                </p>
            </div>

            <div class="mt-4">
                <h4 class="fw-bold">3. Uso Correcto</h4>
                <p>
                    El usuario se compromete a no realizar acciones que dañen el historial de cambios o la integridad de nuestro repositorio almacenado en <strong>GitHub</strong>.
                </p>
            </div>

            <div class="mt-5 text-center">
                <a href="/" class="btn btn-primary px-4 shadow-sm">Entendido y Volver</a>
                <a href="/contacto" class="btn btn-secondary px-4 shadow-sm">Tengo dudas</a>
            </div>

        </div>
    </div>
</div>
@endsection