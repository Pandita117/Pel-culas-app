<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- Componente Navbar --}}
    <x-navbar />

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Gestión de Directores</h2>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                + Nuevo Director
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
                        @forelse($directors as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><strong>{{ $item->nombre }} {{ $item->apellido }}</strong></td>
                            <td>{{ \Carbon\Carbon::parse($item->fecha_naci)->format('d/m/Y') }}</td>
                            <td>{{ $item->nationality->pais ?? 'Sin especificar' }} ({{ $item->nationality->idioma ?? 'N/A' }})</td>
                            <td>{{ $item->award->nombre_premio ?? 'Sin premio' }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->id }}">
                                        Editar
                                    </button>

                                    {{-- Formulario Eliminar --}}
                                    <form action="{{ route('directors.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este actor?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>

                                {{-- Modal Editar Dinámico --}}
                                <div class="modal fade text-start" id="modalEditar{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('directors.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title">Editar Director</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nombre</label>
                                                        <input type="text" name="nombre" class="form-control" value="{{ $item->nombre }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Apellido</label>
                                                        <input type="text" name="apellido" class="form-control" value="{{ $item->apellido }}" required>
                                                    </div>

                                                    {{-- Campo de Fecha Corregido --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Fecha de Nacimiento</label>
                                                        <input type="date" name="fecha_naci" class="form-control" value="{{ \Carbon\Carbon::parse($item->f_nac)->format('Y-m-d') }}" required>
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
                            <td colspan="6" class="text-center text-muted py-3">No hay Directores registrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Componente Modal de Creación --}}
    <x-create-directors :nationalities="$nationalities" :awards="$awards" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>