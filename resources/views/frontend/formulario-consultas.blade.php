<form action="{{ route('consultas.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="nombreConsulta" class="form-label">Nombre</label>
        <input type="text" class="form-control @error('nombreConsulta') is-invalid @enderror" id="nombreConsulta" name="nombreConsulta" value="{{ old('nombreConsulta') }}" required>
        @error('nombreConsulta')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label for="emailConsulta" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control @error('emailConsulta') is-invalid @enderror" id="emailConsulta" name="emailConsulta" value="{{ old('emailConsulta') }}" required>
        @error('emailConsulta')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label for="numero_telefono" class="form-label">Número de teléfono</label>
        <input type="text" class="form-control @error('numero_telefono') is-invalid @enderror" id="numero_telefono" name="numero_telefono" value="{{ old('numero_telefono') }}" required>
        @error('numero_telefono')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label for="opcion_consulta" class="form-label">Motivo de la consulta</label>
        <select class="form-select @error('opcion_consulta') is-invalid @enderror" name="opcion_consulta" required>
            <option value="" selected disabled>Seleccione una opción</option>
            <option value="Problemas al realizar un pedido" {{ old('opcion_consulta') == 'Problemas al realizar un pedido' ? 'selected' : '' }}>Problemas al realizar un pedido</option>
            <option value="Consultas sobre stock" {{ old('opcion_consulta') == 'Consultas sobre stock' ? 'selected' : '' }}>Consultas sobre stock</option>
            <option value="Sugerencias" {{ old('opcion_consulta') == 'Sugerencias' ? 'selected' : '' }}>Sugerencias</option>
        </select>
        @error('opcion_consulta')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label for="mensaje" class="form-label">Mensaje</label>
        <textarea class="form-control @error('mensaje') is-invalid @enderror" id="mensaje" name="mensaje" rows="4" required>{{ old('mensaje') }}</textarea>
        @error('mensaje')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-dark">Enviar Consulta</button>
    </div>
</form>