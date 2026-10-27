<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- Componente Navbar --}}
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
                            <th>Nombre Completo</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Nacionalidad</th>
                            <th>Premio</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($actors as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><strong>{{ $item->nombre_act }} {{ $item->apellido_act }}</strong></td>
                            <td>{{ $item->f_nac }}</td>
                            <td>{{ $item->nationality->pais ?? 'Sin especificar' }} ({{ $item->nationality->idioma ?? 'N/A' }})</td>
                            <td>{{ $item->award->nombre_premio ?? 'Sin premio' }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->id }}">
                                        Editar
                                    </button>

                                    {{-- Formulario Eliminar --}}
                                    <form action="{{ route('actors.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este actor?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>

                                {{-- Modal Editar Dinámico --}}
                                <div class="modal fade text-start" id="modalEditar{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('actors.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title">Editar Actor</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nombre</label>
                                                        <input type="text" name="nombre_act" class="form-control" value="{{ $item->nombre_act }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Apellido</label>
                                                        <input type="text" name="apellido_act" class="form-control" value="{{ $item->apellido_act }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="form-label">Fecha de Nacimiento</label>
                                                        <input type="date" name="f_nac" class="form-control" value="{{ $item->f_nac }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nacionalidad</label>
                                                        <select name="id_nacionalidad" class="form-select" required>
                                                            @foreach($nationalities as $nac)
                                                                <option value="{{ $nac->id }}" {{ $item->id_nacionalidad == $nac->id ? 'selected' : '' }}>
                                                                    {{ $nac->pais }} ({{ $nac->idioma }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Premio (Opcional)</label>
                                                        <select name="id_premios" class="form-select">
                                                            <option value="" {{ is_null($item->id_premios) ? 'selected' : '' }}>Sin premio asignado</option>
                                                            @foreach($awards as $award)
                                                                <option value="{{ $award->id }}" {{ $item->id_premios == $award->id ? 'selected' : '' }}>
                                                                    {{ $award->nombre_premio }}
                                                                </option>
                                                            @endforeach
                                                        </select>
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
                            <td colspan="6" class="text-center text-muted py-3">No hay actores registrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Componente Modal de Creación --}}
    <x-create-actor :nationalities="$nationalities" :awards="$awards" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>