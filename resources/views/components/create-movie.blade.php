@props(['generos' => [], 'clasificaciones' => [], 'productoras' => []])
<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearMovieLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('movies.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearMovieLabel">Agregar Nueva Película</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Ej. Inception" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="duracion" class="form-label">Duración (minutos)</label>
                            <input type="number" name="duracion" id="duracion" class="form-control" placeholder="Ej. 148" min="1" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="f_estreno" class="form-label">Fecha de Estreno</label>
                            <input type="date" name="f_estreno" id="f_estreno" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="id_genero" class="form-label">Género</label>
                            <select name="id_genero" id="id_genero" class="form-select" required>
                                <option value="" selected disabled>Selecciona un género...</option>
                                @foreach($generos as $genero)
                                    <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_clasificacion" class="form-label">Clasificación</label>
                            <select name="id_clasificacion" id="id_clasificacion" class="form-select" required>
                                <option value="" selected disabled>Selecciona clasificación...</option>
                                @foreach($clasificaciones as $clasificacion)
                                    <option value="{{ $clasificacion->id }}">{{ $clasificacion->clasficiacion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="id_productora" class="form-label">Productora</label>
                            <select name="id_productora" id="id_productora" class="form-select" required>
                                <option value="" selected disabled>Selecciona productora...</option>
                                @foreach($productoras as $productora)
                                    <option value="{{ $productora->id }}">{{ $productora->nombre_productora }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="sinopsis" class="form-label">Sinopsis / Resumen</label>
                        <textarea name="sinopsis" id="sinopsis" class="form-control" rows="3" placeholder="Escribe la trama de la película..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Película</button>
                </div>
            </form>
        </div>
    </div>
</div>