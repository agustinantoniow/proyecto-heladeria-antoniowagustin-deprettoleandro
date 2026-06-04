@extends('components.layoutAdmin')
@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0">Consultas de Clientes</h3>
        </div>
        <div class="card-body">
            @if($consultas->isEmpty())
                <div class="alert alert-info">No hay consultas nuevas por el momento.</div>
            @else
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Tipo</th>
                            <th>Mensaje</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($consultas as $c)
                        <tr class="{{ $c->leido ? 'table-secondary' : '' }}">
                            <td>{{ $c->Nombre }}</td>
                            <td>{{ $c->email }}</td>
                            <td>{{ $c->numero_telefono }}</td>
                            <td><span class="badge bg-secondary">{{ $c->tipo }}</span></td>
                            <td>{{ Str::limit($c->mensaje, 50) }}</td>
                            <td>{{ \Carbon\Carbon::parse($c->created_at)->format('d/m/Y H:i') }}</td>
                            
                            <td>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('consultas.destroy', $c->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                    @if(!$c->leido)
                                        <form action="{{ route('consultas.marcarLeido', $c->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success">Marcar como leída</button>
                                        </form>
                                    @else
                                        <span class="badge bg-secondary">Leída</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection