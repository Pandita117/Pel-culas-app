<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- Componente Navbar --}}
    <x-navbar />

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Gestión de Géneros</h2>
            {{-- Botón para abrir el modal de creación --}}
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                + Nuevo Género
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre del género</th>
                            <th>Descripción del género</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($generos as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><strong>{{ $item->genero }}</strong></td>
                            <td><strong>{{ $item->descripcion }}</strong></td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->id }}">
                                        Editar
                                    </button>

                                    <form action="{{ route('generos.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este género?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>

                                {{-- MODAL DE EDICIÓN --}}
                                <div class="modal fade text-start" id="modalEditar{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditarGeneroLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('generos.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                {{-- Identificador del modal que envió la petición --}}
                                                <input type="hidden" name="edit_id" value="{{ $item->id }}">

                                                <div class="modal-header bg-warning text-dark">
                                                    <h5 class="modal-title" id="modalEditarGeneroLabel{{ $item->id }}">Editar Género</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    {{-- Campo: Nombre del Género --}}
                                                    <div class="mb-3">
                                                        <label for="genero{{ $item->id }}" class="form-label">Nombre del Género</label>
                                                        <input 
                                                            type="text" 
                                                            name="genero" 
                                                            id="genero{{ $item->id }}" 
                                                            class="form-control @if($errors->has('genero') && old('edit_id') == $item->id) is-invalid @endif"
                                                            value="{{ old('edit_id') == $item->id ? old('genero') : $item->genero }}" 
                                                            required>

                                                        @if ($errors->has('genero') && old('edit_id') == $item->id)
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('genero') }}
                                                            </div>
                                                        @endif
                                                    </div>

                                                    {{-- Campo: Descripción --}}
                                                    <div class="mb-3">
                                                        <label for="descripcion{{ $item->id }}" class="form-label">Descripción</label>
                                                        <input 
                                                            type="text" 
                                                            name="descripcion" 
                                                            id="descripcion{{ $item->id }}" 
                                                            class="form-control @if($errors->has('descripcion') && old('edit_id') == $item->id) is-invalid @endif" 
                                                            value="{{ old('edit_id') == $item->id ? old('descripcion') : $item->descripcion }}" 
                                                            required>

                                                        @if ($errors->has('descripcion') && old('edit_id') == $item->id)
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('descripcion') }}
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
                                {{-- FIN MODAL DE EDICIÓN --}}

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">No hay géneros registrados</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Componente Modal de Creación --}}
    <x-create-genders />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Script para reabrir automáticamente el modal donde ocurrió el error --}}
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