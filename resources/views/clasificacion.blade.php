<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clasificaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- Componente Navbar --}}
    <x-navbar />

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Gestión de Clasificaciones</h2>
            {{-- Botón que activa el modal de creación --}}
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                + Nueva Clasificación
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Clasificación</th>
                            <th>Rango</th>
                            <th>Descripción</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clasificaciones as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><strong>{{ $item->clasificacion }}</strong></td>
                            <td>
                                <span class="badge bg-info text-dark">{{ $item->rango }}</span>
                            </td>
                            <td>{{ $item->descripcion }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    {{-- Botón Editar --}}
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->id }}">
                                        Editar
                                    </button>

                                    {{-- Formulario Eliminar --}}
                                    <form action="{{ route('clasificaciones.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta clasificación?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>

                                {{-- Modal Editar Dinámico --}}
                                <div class="modal fade text-start" id="modalEditar{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('clasificaciones.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                {{-- -identificacor de modal muejejej --}}

                                                <input type="hidden" name="edit_id" value="{{ $item->id }}"> 

                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title">Editar Clasificación</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    {{-- -campo de crear clasificacion --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Clasificación</label>
                                                        <input type="text" name="clasificacion" 
                                                        class="form-control @if ($errors->has('clasificacion') && old('edit_id') == $item->id) is-invalid @endif"
                                                         value="{{old('edit_id') == $item->id ? old('clasificacion') : $item->clasificacion}}" required>

                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Rango de Edad</label>
                                                        <select name="rango" class="form-select" required>
                                                            <option value="Todos" {{ $item->rango == 'Todos' ? 'selected' : '' }}>Todos</option>
                                                            <option value="12-15" {{ $item->rango == '12-15' ? 'selected' : '' }}>12-15 años</option>
                                                            <option value="16-17" {{ $item->rango == '16-17' ? 'selected' : '' }}>16-17 años</option>
                                                            <option value="+18" {{ $item->rango == '+18' ? 'selected' : '' }}>+18 años</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Descripción</label>
                                                        <textarea name="descripcion" class="form-control" rows="3" required>{{ $item->descripcion }}</textarea>
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
                            <td colspan="5" class="text-center text-muted py-3">No hay clasificaciones registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Componente Modal de Creación --}}
    <x-create-clasificacion />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    {{-- -abiri modal con error  --}}

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