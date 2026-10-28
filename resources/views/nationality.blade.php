<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nacionalidades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- Componente --}}
    <x-navbar />

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Gestión de Nacionalidades</h2>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                + Nueva Nacionalidad
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>País</th>
                            <th>Idioma Principal</th>
                            <th>Continente</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($nacionalidades as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><strong>{{ $item->Pais ?? $item->pais }}</strong></td>
                            <td>
                                <span class="badge bg-info text-dark">{{ $item->idioma }}</span>
                            </td>
                            <td>{{ $item->continente }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->id }}">
                                        Editar
                                    </button>

                                    <form action="{{ route('nacionalidades.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta nacionalidad?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>

                                <div class="modal fade text-start" id="modalEditar{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditarNacionalidadLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('nacionalidades.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="edit_id" value="{{ $item->id }}">

                                                <div class="modal-header bg-warning text-dark">
                                                    <h5 class="modal-title" id="modalEditarNacionalidadLabel{{ $item->id }}">Editar Nacionalidad</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="Pais{{ $item->id }}" class="form-label">País</label>
                                                        <input 
                                                            type="text" 
                                                            name="Pais" 
                                                            id="Pais{{ $item->id }}" 
                                                            class="form-control @if($errors->has('Pais') && old('edit_id') == $item->id) is-invalid @endif"
                                                            value="{{ old('edit_id') == $item->id ? old('Pais') : ($item->Pais ?? $item->pais) }}" 
                                                            required>

                                                        @if ($errors->has('Pais') && old('edit_id') == $item->id)
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('Pais') }}
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="idioma{{ $item->id }}" class="form-label">Idioma</label>
                                                        <input 
                                                            type="text" 
                                                            name="idioma" 
                                                            id="idioma{{ $item->id }}" 
                                                            class="form-control @if($errors->has('idioma') && old('edit_id') == $item->id) is-invalid @endif" 
                                                            value="{{ old('edit_id') == $item->id ? old('idioma') : $item->idioma }}" 
                                                            required>

                                                        @if ($errors->has('idioma') && old('edit_id') == $item->id)
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('idioma') }}
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="continente{{ $item->id }}" class="form-label">Continente</label>
                                                        <input 
                                                            type="text" 
                                                            name="continente" 
                                                            id="continente{{ $item->id }}" 
                                                            class="form-control @if($errors->has('continente') && old('edit_id') == $item->id) is-invalid @endif" 
                                                            value="{{ old('edit_id') == $item->id ? old('continente') : $item->continente }}" 
                                                            required>

                                                        @if ($errors->has('continente') && old('edit_id') == $item->id)
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('continente') }}
                                                            </div>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-warning">Actualizar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">No hay nacionalidades registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-create-nacionalidad />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Script --}}
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @if(old('edit_id'))
                    var modalEditar = new bootstrap.Modal(document.getElementById('modalEditar{{ old("edit_id") }}'));
                    modalEditar.show();
                @else
                    var modalCrear = new bootstrap.Modal(document.getElementById('modalCrear'));
                    modalCrear.show();
                @endif
            });
        </script>
    @endif
</body>
</html>