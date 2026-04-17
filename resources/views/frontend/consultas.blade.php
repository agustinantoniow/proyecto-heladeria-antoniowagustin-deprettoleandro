  @extends('components.layout')
@section('title', 'heladeria - Consultas')
@section('content')
<body>
  
   <div class="container mt-5">
        <div class="card shadow p-4 mx-auto" style="max-width: 600px;">
            <h1 class="text-center mb-4">Formulario de Consultas</h1>

            <form action="{{ url('/Consultas') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="num" class="form-label">Número de teléfono</label>
                    <input type="text" class="form-control" id="num" name="num" required>
                </div>
        <select class="form-select form-select-lg mb-3" aria-label="Large select example">
            <option selected>Seleccione una opcion</option>
            <option value="1">Problemas al realizar un pedido</option>
            <option value="2">Consultas sobre stock de un producto</option>
            <option value="3">Sugerencias</option>
        </select>
                <div class="mb-3">
                    <label for="mensaje" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-dark">Enviar</button>
                    
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
</body>
@endsection