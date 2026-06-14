@extends ('components.layoutAdmin')

@section('title', 'heladeria - Terminos y Usos')

@section('content')

<div class="terms-container">
    <div class="header-banner">
        <h1>Términos y Condiciones de Uso Administrador</h1>
      
    </div>

    <p>El presente documento regula las responsabilidades y obligaciones de los usuarios que accedan con privilegios de <strong>Administrador</strong>. Al iniciar sesión con estas credenciales, te comprometes a cumplir las siguientes normas:</p>

    <h2>1. Seguridad de la Cuenta</h2>
    <ul>
        <li>Las credenciales de acceso (usuario y contraseña) son de uso <strong>personal e intransferible</strong>.</li>
        <li>Eres el único responsable de todas las acciones, modificaciones o eliminaciones de datos registradas bajo tu usuario.</li>
    </ul>

    <h2>2. Uso Correcto de Privilegios</h2>
    <ul>
        <li>El uso de las herramientas de gestión (altas, bajas, modificaciones) se limitará estrictamente al correcto funcionamiento y testeo del proyecto.</li>
        <li>Queda prohibido alterar el sistema de forma maliciosa, ingresar datos falsos que corrompan el entorno o intentar forzar la seguridad de la plataforma.</li>
    </ul>

    <h2>3. Privacidad y Confidencialidad</h2>
    <ul>
        <li>Debido al rol, tienes acceso a información cargada por otros usuarios. Te comprometes a <strong>no difundir, exportar ni utilizar</strong> estos datos fuera del ámbito académico de la cátedra.</li>
    </ul>

    <div class="highlight-box">
        <p><strong>Aviso de Auditoría (Logs):</strong> El sistema registra de forma automática las acciones clave realizadas por los administradores para facilitar la corrección de errores (debugging) y evaluar el flujo del sistema en la entrega del proyecto.</p>
    </div>

    <h2>4. Sanciones</h2>
    <p>El mal uso de las herramientas de gestión, la alteración intencional de la base de datos o cualquier acción que comprometa la integridad del proyecto será motivo de <strong>revocación inmediata del acceso</strong> y se notificará a los docentes a cargo.</p>


</div>


@endsection