<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glace - Panel de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">       
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0 align-middle">
                    
                    <tbody>
                                                @forelse ($productos as $prod)
                          
                                                    <tr>
                                                        <td>{{ $prod->id }}</td>
                                                        <td>{{ $prod->nombre }}</td>
                                                        <td>{{ $prod->descripcion }}</td>
                                                        <td>{{ $prod->precio }}</td>
                                                    </tr>

                                                @empty

                                                    <tr>
                                                        <td>No hay productos cargados todavía.</td>
                                                    </tr>

                                                @endforelse


                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>