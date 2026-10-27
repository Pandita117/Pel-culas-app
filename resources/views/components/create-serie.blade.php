@props(['directors' => [], 'generos' => [], 'clasificaciones' => [], 'productoras' => [], 'actors' => [], 'platforms' => [], 'awards' => []])

<div class="modal fade" id="modalCrear" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('series.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Agregar Nueva Serie</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{-- Fila 1: Título y Director --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" name="titulo" class="form-control" placeholder="Ej. La Leyenda del 67" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Director</label>
                            <select name="id_director" class="form-select" required>
                                <option value="" selected disabled>Selecciona director...</option>
                                @foreach($directors as $director)
                                    <option value="{{ $director->id }}">{{ $director->nombre }} {{ $director->apellido }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Fila 2: Género y Clasificación --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Género</label>
                            <select name="id_genero" class="form-select" required>
                                <option value="" selected disabled>Selecciona un género...</option>
                                @foreach($generos as $genero)
                                    <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Clasificación</label>
                            <select name="id_clasificacion" class="form-select" required>
                                <option value="" selected disabled>Selecciona clasificación...</option>
                                @foreach($clasificaciones as $clasificacion)
                                    <option value="{{ $clasificacion->id }}">{{ $clasificacion->clasificacion ?? $clasificacion->clasficiacion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Fila 3: Productora, Fecha, Episodios y Premios --}}
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Productora</label>
                            <select name="id_productora" class="form-select" required>
                                <option value="" selected disabled>Selecciona productora...</option>
                                @foreach($productoras as $productora)
                                    <option value="{{ $productora->id }}">{{ $productora->nombre_productora }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Fecha Lanzamiento</label>
                            <input type="date" name="fecha_lanzamiento" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Cant. Episodios</label>
                            <input type="number" name="cant_episodios" class="form-control" placeholder="Ej. 62" min="1" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Premios Ganados</label>
                            <input type="number" name="cantidad_premios" class="form-control" value="0" min="0" required>
                        </div>
                    </div>

                    {{-- Fila 4: Relaciones N:M (Actores, Plataformas, Premios) --}}
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Actores</label>
                            <div class="border rounded p-2 bg-light" style="max-height: 120px; overflow-y: auto;">
                                @foreach($actors as $actor)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="actors[]" value="{{ $actor->id }}" id="act_c_{{ $actor->id }}">
                                        <label class="form-check-label" for="act_c_{{ $actor->id }}">{{ $actor->nombre_act }} {{ $actor->apellido_act }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Plataformas</label>
                            <div class="border rounded p-2 bg-light" style="max-height: 120px; overflow-y: auto;">
                                @foreach($platforms as $platform)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="platforms[]" value="{{ $platform->id }}" id="plat_c_{{ $platform->id }}">
                                        <label class="form-check-label" for="plat_c_{{ $platform->id }}">{{ $platform->nombre ?? $platform->nombre_plataforma }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tipos de Premios</label>
                            <div class="border rounded p-2 bg-light" style="max-height: 120px; overflow-y: auto;">
                                @foreach($awards as $award)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="awards[]" value="{{ $award->id }}" id="aw_c_{{ $award->id }}">
                                        <label class="form-check-label" for="aw_c_{{ $award->id }}">{{ $award->nombre_premio }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Serie</button>
                </div>
            </form>
        </div>
    </div>
</div>