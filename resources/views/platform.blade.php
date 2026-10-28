<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataformas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- Componente --}}
    <x-navbar />

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Gestión de Plataformas</h2>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                + Nueva Plataforma
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre de la Plataforma</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($plataformas as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><strong>{{ $item->nombre_plataforma ?? $item->nombre }}</strong></td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->id }}">
                                        Editar
                                    </button>

                                    <form action="{{ route('plataformas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta plataforma?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>

                                <div class="modal fade text-start" id="modalEditar{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditarPlataformaLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('plataformas.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="edit_id" value="{{ $item->id }}">

                                                <div class="modal-header bg-warning text-dark">
                                                    <h5 class="modal-title" id="modalEditarPlataformaLabel{{ $item->id }}">Editar Plataforma</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="nombre_plataforma{{ $item->id }}" class="form-label">Nombre de la Plataforma</label>
                                                        <input 
                                                            type="text" 
                                                            name="nombre_plataforma" 
                                                            id="nombre_plataforma{{ $item->id }}" 
                                                            class="form-control @if($errors->has('nombre_plataforma') && old('edit_id') == $item->id) is-invalid @endif" 
                                                            value="{{ old('edit_id') == $item->id ? old('nombre_plataforma') : ($item->nombre_plataforma ?? $item->nombre) }}" 
                                                            required>

                                                        @if ($errors->has('nombre_plataforma') && old('edit_id') == $item->id)
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('nombre_plataforma') }}
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
                            <td colspan="3" class="text-center text-muted py-3">No hay plataformas registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Componente--}}
    <x-create-plataforma />

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