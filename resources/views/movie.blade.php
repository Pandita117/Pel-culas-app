<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- Componente --}}
    <x-navbar />

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Gestión de Películas</h2>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                + Nueva Película
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Título</th>
                            <th>Director</th>
                            <th>Género</th>
                            <th>Clasificación</th>
                            <th>Productora</th>
                            <th>Premios</th>
                            <th>Lanzamiento</th>
                            <th>Duración</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($movies as $item)
                        <tr>
                            <td><strong>{{ $item->titulo }}</strong></td>
                            <td>{{ $item->director->nombre_dir ?? $item->director ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $item->gender->genero ?? $item->genero ?? 'N/A' }}
                                </span>
                            </td>
                            <td>{{ $item->clasification->clasficiacion ?? $item->clasificacion ?? 'N/A' }}</td>
                            <td>{{ $item->producer->nombre_productora ?? $item->productora ?? 'N/A' }}</td>
                            <td>{{ $item->cantidad_premios }}</td>
                            <td>{{ $item->f_lanzamiento }}</td>
                            <td>{{ $item->duracion }} min</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">

                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->id }}">
                                        Editar
                                    </button>

                                    <form action="{{ route('movies.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta película?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>

                                <div class="modal fade text-start" id="modalEditar{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('movies.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title">Editar Película</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Título</label>
                                                            <input type="text" name="titulo" class="form-control" value="{{ $item->titulo }}" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Duración (minutos)</label>
                                                            <input type="number" name="duracion" class="form-control" value="{{ $item->duracion }}" min="1" required>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Género</label>
                                                            <select name="id_genero" class="form-select" required>
                                                                @foreach($generos as $genero)
                                                                    <option value="{{ $genero->id }}" {{ $item->id_genero == $genero->id ? 'selected' : '' }}>
                                                                        {{ $genero->genero }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Clasificación</label>
                                                            <select name="id_clasificacion" class="form-select" required>
                                                                @foreach($clasificaciones as $clasificacion)
                                                                    <option value="{{ $clasificacion->id }}" {{ $item->id_clasificacion == $clasificacion->id ? 'selected' : '' }}>
                                                                        {{ $clasificacion->clasficiacion }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Productora</label>
                                                            <select name="id_productora" class="form-select" required>
                                                                @foreach($productoras as $productora)
                                                                    <option value="{{ $productora->id }}" {{ $item->id_productora == $productora->id ? 'selected' : '' }}>
                                                                        {{ $productora->nombre_productora }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Cantidad de Premios</label>
                                                            <input type="number" name="cantidad_premios" class="form-control" value="{{ $item->cantidad_premios }}" min="0" required>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Fecha de Lanzamiento</label>
                                                        <input type="date" name="f_lanzamiento" class="form-control" value="{{ $item->f_lanzamiento }}" required>
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
                            <td colspan="9" class="text-center text-muted py-3">No hay películas registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Componente --}}
<x-create-movie 
    :generos="$generos" 
    :clasificaciones="$clasificaciones" 
    :productoras="$productoras" 
/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>