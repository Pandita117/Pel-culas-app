<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Series</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-text-small { font-size: 0.85rem; }
    </style>
</head>
<body class="bg-light">

    <x-navbar />

    <div class="container-fluid px-4 my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Gestión de Series</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                + Nueva Serie
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0 table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle table-text-small">
                    <thead class="table-dark">
                        <tr>
                            <th>Título</th>
                            <th>Director</th>
                            <th>Género / Clasif.</th>
                            <th>Productora</th>
                            <th>Actores</th>
                            <th>Plataformas</th>
                            <th>Premios</th>
                            <th>Lanz. / Episodios</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($series as $item)
                        <tr>
                            <td><strong>{{ $item->titulo }}</strong></td>
                            <td>{{ $item->director ? $item->director->nombre . ' ' . $item->director->apellido : 'N/A' }}</td>
                            <td>
                                <span class="badge bg-info text-dark">{{ $item->gender->genero ?? 'N/A' }}</span><br>
                                <span class="badge bg-secondary">{{ $item->clasification->clasificacion ?? $item->clasification->clasficiacion ?? 'N/A' }}</span>
                            </td>
                            <td>{{ $item->productor->nombre_productora ?? 'N/A' }}</td>

                            {{-- Columna Actores (N:M) --}}
                            <td style="max-width: 150px; text-wrap: wrap;">
                                @forelse($item->actors as $actor)
                                    {{ $actor->nombre_act }}@if(!$loop->last), @endif
                                @empty
                                    <span class="text-muted">Sin actores</span>
                                @endforelse
                            </td>

                            {{-- Columna Plataformas (N:M) --}}
                            <td>
                                @forelse($item->platforms as $plat)
                                    <span class="badge bg-dark">{{ $plat->nombre ?? $plat->nombre_plataforma }}</span>
                                @empty
                                    <span class="text-muted">N/A</span>
                                @endforelse
                            </td>

                            {{-- Columna Premios (N:M) --}}
                            <td>
                                <strong>Cant: {{ $item->cantidad_premios }}</strong><br>
                                @foreach($item->awards as $award)
                                    <small class="text-success">{{ $award->nombre_premio }}</small>@if(!$loop->last), @endif
                                @endforeach
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->fecha_lanzamiento)->format('d/m/Y') }}<br>
                                <span class="text-muted">{{ $item->cant_episodios }} episodios</span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->id }}">Editar</button>
                                    <form action="{{ route('series.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>

                                {{-- Modal Editar Dinámico --}}
                                <div class="modal fade text-start" id="modalEditar{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <form action="{{ route('series.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title">Editar Serie</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Título</label>
                                                            <input type="text" name="titulo" class="form-control" value="{{ $item->titulo }}" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Director</label>
                                                            <select name="id_director" class="form-select" required>
                                                                @foreach($directors as $director)
                                                                    <option value="{{ $director->id }}" {{ $item->id_director == $director->id ? 'selected' : '' }}>
                                                                        {{ $director->nombre }} {{ $director->apellido }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Género</label>
                                                            <select name="id_genero" class="form-select" required>
                                                                @foreach($generos as $genero)
                                                                    <option value="{{ $genero->id }}" {{ $item->id_genero == $genero->id ? 'selected' : '' }}>{{ $genero->genero }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Clasificación</label>
                                                            <select name="id_clasificacion" class="form-select" required>
                                                                @foreach($clasificaciones as $clasificacion)
                                                                    <option value="{{ $clasificacion->id }}" {{ $item->id_clasificacion == $clasificacion->id ? 'selected' : '' }}>
                                                                        {{ $clasificacion->clasificacion ?? $clasificacion->clasficiacion }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3 mb-3">
                                                            <label class="form-label">Productora</label>
                                                            <select name="id_productora" class="form-select" required>
                                                                @foreach($productoras as $productora)
                                                                    <option value="{{ $productora->id }}" {{ $item->id_productora == $productora->id ? 'selected' : '' }}>{{ $productora->nombre_productora }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label class="form-label">Fecha Lanzamiento</label>
                                                            <input type="date" name="fecha_lanzamiento" class="form-control" value="{{ \Carbon\Carbon::parse($item->fecha_lanzamiento)->format('Y-m-d') }}" required>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label class="form-label">Cant. Episodios</label>
                                                            <input type="number" name="cant_episodios" class="form-control" value="{{ $item->cant_episodios }}" min="1" required>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label class="form-label">Premios Ganados</label>
                                                            <input type="number" name="cantidad_premios" class="form-control" value="{{ $item->cantidad_premios }}" min="0" required>
                                                        </div>
                                                    </div>

                                                    {{-- Edición Relaciones N:M --}}
                                                    <div class="row">
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Actores</label>
                                                            <div class="border rounded p-2 bg-white" style="max-height: 120px; overflow-y: auto;">
                                                                @foreach($actors as $actor)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="actors[]" value="{{ $actor->id }}" id="act_e_{{ $actor->id }}_{{ $item->id }}" {{ $item->actors->contains($actor->id) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="act_e_{{ $actor->id }}_{{ $item->id }}">{{ $actor->nombre_act }} {{ $actor->apellido_act }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Plataformas</label>
                                                            <div class="border rounded p-2 bg-white" style="max-height: 120px; overflow-y: auto;">
                                                                @foreach($platforms as $platform)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="platforms[]" value="{{ $platform->id }}" id="plat_e_{{ $platform->id }}_{{ $item->id }}" {{ $item->platforms->contains($platform->id) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="plat_e_{{ $platform->id }}_{{ $item->id }}">{{ $platform->nombre ?? $platform->nombre_plataforma }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Tipos de Premios</label>
                                                            <div class="border rounded p-2 bg-white" style="max-height: 120px; overflow-y: auto;">
                                                                @foreach($awards as $award)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="awards[]" value="{{ $award->id }}" id="aw_e_{{ $award->id }}_{{ $item->id }}" {{ $item->awards->contains($award->id) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="aw_e_{{ $award->id }}_{{ $item->id }}">{{ $award->nombre_premio }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
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
                            <td colspan="9" class="text-center text-muted py-3">No hay series registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Componente Modal de Creación --}}
    <x-create-serie
        :directors="$directors"
        :generos="$generos"
        :clasificaciones="$clasificaciones"
        :productoras="$productoras"
        :actors="$actors"
        :platforms="$platforms"
        :awards="$awards"
    />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>