<form action="{{ route('consultas.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="nombreConsulta" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombreConsulta" name="nombreConsulta" value="{{ old('nombreConsulta') }}" required>
    </div>

    <div class="mb-3">
        <label for="emailConsulta" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="emailConsulta" name="emailConsulta" value="{{ old('emailConsulta') }}" required>
    </div>

    <div class="mb-3">
        <label for="numero_telefono" class="form-label">Número de teléfono</label>
        <input type="text" class="form-control" id="numero_telefono" name="numero_telefono" value="{{ old('numero_telefono') }}" required>
    </div>

    <div class="mb-3">
        <label for="opcion_consulta" class="form-label">Motivo de la consulta</label>
        <select class="form-select" name="opcion_consulta" required>
            <option value="" selected disabled>Seleccione una opción</option>
            <option value="Problemas al realizar un pedido">Problemas al realizar un pedido</option>
            <option value="Consultas sobre stock">Consultas sobre stock</option>
            <option value="Sugerencias">Sugerencias</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="mensaje" class="form-label">Mensaje</label>
        <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required>{{ old('mensaje') }}</textarea>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-dark">Enviar Consulta</button>
    </div>
</form>