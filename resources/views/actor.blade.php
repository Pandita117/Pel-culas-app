<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- Componente --}}
    <x-navbar />

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Gestión de Actores</h2>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                + Nuevo Actor
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Nacionalidad</th>
                            <th>Premios</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($actors as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><strong>{{ $item->nombre }}</strong></td>
                            <td>{{ $item->fecha_nacimiento }}</td>
                            <td>{{ $item->nacionalidad }}</td>
                            <td>{{ $item->premios }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    {{-- Botón Editar --}}
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->id }}">
                                        Editar
                                    </button>

                                    {{-- Formulario Eliminar --}}
                                    <form action="{{ route('actores.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este actor?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>

                                {{-- Modal Editar Dinámico --}}
                                <div class="modal fade text-start" id="modalEditar{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('actores.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title">Editar Actor</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nombre</label>
                                                        <input type="text" name="nombre" class="form-control" value="{{ $item->nombre }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Fecha de Nacimiento</label>
                                                        <input type="date" name="fecha_nacimiento" class="form-control" value="{{ $item->fecha_nacimiento }}" required>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label">Nacionalidad</label>
                                                        <input type="text" name="nacionalidad" class="form-control" value="{{ $item->nacionalidad }}" required>
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
                            <td colspan="5" class="text-center text-muted py-3">No hay actores registrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Componente --}}
    <x-create-actor />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>