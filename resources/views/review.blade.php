<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-text-small { font-size: 0.85rem; }
    </style>
</head>
<body class="bg-light">

    <x-navbar />

    <div class="container-fluid px-4 my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Gestión de Reseñas</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                + Nueva Reseña
            </button>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-0 table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle table-text-small">
                    <thead class="table-dark">
                        <tr>
                            <th>Tipo</th>
                            <th>Título</th>
                            <th>Calificación</th>
                            <th>Reseña</th>
                            <th>Fecha</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $item)
                        @php
                            $esPelicula = !is_null($item->id_movie);
                            $titulo = $esPelicula ? ($item->movie->titulo ?? 'N/A') : ($item->serie->titulo ?? 'N/A');
                            $color = $item->calificacion >= 70 ? 'success' : ($item->calificacion >= 40 ? 'warning text-dark' : 'danger');
                        @endphp
                        <tr>
                            <td>
                                <span class="badge {{ $esPelicula ? 'bg-info text-dark' : 'bg-secondary' }}">
                                    {{ $esPelicula ? 'Película' : 'Serie' }}
                                </span>
                            </td>
                            <td><strong>{{ $titulo }}</strong></td>
                            <td><span class="badge bg-{{ $color }}">{{ $item->calificacion }}%</span></td>
                            <td style="max-width: 350px; text-wrap: wrap;">{{ \Illuminate\Support\Str::limit($item->resena, 120) }}</td>
                            <td>{{ $item->created_at ? $item->created_at->format('d/m/Y') : 'N/A' }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->id }}">Editar</button>
                                    <form action="{{ route('reviews.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>

                                {{-- Modal Editar Dinámico --}}
                                <div class="modal fade text-start" id="modalEditar{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('reviews.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title">Editar Reseña</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-8 mb-3">
                                                            <label class="form-label">{{ $esPelicula ? 'Película' : 'Serie' }}</label>
                                                            <input type="text" class="form-control" value="{{ $titulo }}" disabled>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Calificación (%)</label>
                                                            <div class="input-group">
                                                                <input type="number" name="calificacion" class="form-control" value="{{ $item->calificacion }}" min="1" max="100" required>
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Comentario / Reseña</label>
                                                            <textarea name="resena" class="form-control" rows="4" minlength="3" required>{{ $item->resena }}</textarea>
                                                        </div>
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
                            <td colspan="6" class="text-center text-muted py-3">No hay reseñas registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Componente Modal de Creación --}}
    <x-create-review :movies="$movies" :series="$series" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>