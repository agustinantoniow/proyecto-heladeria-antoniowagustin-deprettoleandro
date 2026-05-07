<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title', 'Heladería Glace')</title>

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;700&family=Montserrat:wght@600;800&display=swap" rel="stylesheet">
</head>

 <body>
    @include('components.navbar')

    <div class="container mt-4">
        @yield('content')
    </div>

 @include('components.footer')
    
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 
 </body>
</html>
