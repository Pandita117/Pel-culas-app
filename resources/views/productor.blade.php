<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- Componente Navbar --}}
    <x-navbar />

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Gestión de Productores</h2>
            {{-- Botón para abrir el modal de creación --}}
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                + Nueva Productora
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre de Productora</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productoras as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><strong>{{ $item->nombre_productora }}</strong></td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    {{-- Botón Editar (Abre el modal dinámico con el ID) --}}
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->id }}">
                                        Editar
                                    </button>

                                    {{-- Formulario Eliminar --}}
                                    <form action="{{ route('productoras.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta productora?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>

                                {{-- MODAL DE EDICIÓN (Específico para este registro) --}}
                                <div class="modal fade text-start" id="modalEditar{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditarProductoraLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('productoras.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-warning text-dark">
                                                    <h5 class="modal-title" id="modalEditarPremioLabel{{ $item->id }}">Editar G</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="nombre_productora_{{ $item->id }}" class="form-label">Nombre de la productora</label>
                                                        <input type="text" name="nombre_productora" id="genero{{ $item->id }}" class="form-control" value="{{ $item->nombre_productora }}" required>
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
                            <td colspan="4" class="text-center text-muted py-3">No hay productoras registradas</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Componente Modal de Creación --}}
    <x-create-productora />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>