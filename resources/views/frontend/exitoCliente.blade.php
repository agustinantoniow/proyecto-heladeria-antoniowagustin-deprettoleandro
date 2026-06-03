@extends('components.layoutCliente')
@section('title', 'heladeria - login')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje enviado</title>

   
    
</head>
<body>

    <div class="container mt-5">
        <div class="card shadow p-4 mx-auto text-center" style="max-width: 700px;">
            <h1 class="mb-4">Mensaje enviado con éxito</h1>

            <p class="lead">
             Gracias, hemos recibido tu mensaje y te responderemos al correo.       
            </p>
                <a href="/Cliente" class="btn btn-primary px-4 shadow-sm">Entendido y Volver</a>

        </div>
    </div>

  
   
</body>
</html>
@endsection
