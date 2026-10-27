@props(['movies' => [], 'series' => []])

<div class="modal fade" id="modalCrear" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Agregar Nueva Reseña</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{-- Fila 1: Tipo y título a reseñar --}}
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Reseña de</label>
                            <select id="tipoReview" class="form-select">
                                <option value="movie" selected>Película</option>
                                <option value="serie">Serie</option>
                            </select>
                        </div>
                        <div class="col-md-8 mb-3" id="boxMovie">
                            <label class="form-label">Película</label>
                            <select name="id_movie" id="selectMovie" class="form-select" required>
                                <option value="" selected disabled>Selecciona película...</option>
                                @foreach($movies as $movie)
                                    <option value="{{ $movie->id }}">{{ $movie->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8 mb-3 d-none" id="boxSerie">
                            <label class="form-label">Serie</label>
                            <select name="id_serie" id="selectSerie" class="form-select" required disabled>
                                <option value="" selected disabled>Selecciona serie...</option>
                                @foreach($series as $serie)
                                    <option value="{{ $serie->id }}">{{ $serie->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Fila 2: Calificación --}}
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Calificación (%)</label>
                            <div class="input-group">
                                <input type="number" name="calificacion" class="form-control" min="1" max="100" placeholder="Ej. 85" required>
                                <span class="input-group-text">%</span>
                            </div>
                            <div class="form-text">Entero de 1 a 100.</div>
                        </div>
                    </div>

                    {{-- Fila 3: Reseña --}}
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label">Comentario / Reseña</label>
                            <textarea name="resena" class="form-control" rows="4" minlength="3" placeholder="Escribe tu opinión sobre la película o serie...67" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Reseña</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tipo = document.getElementById('tipoReview');
        const boxMovie = document.getElementById('boxMovie');
        const boxSerie = document.getElementById('boxSerie');
        const selMovie = document.getElementById('selectMovie');
        const selSerie = document.getElementById('selectSerie');

        // Solo se envía el select activo (los deshabilitados no se mandan)
        function alternar() {
            const esPelicula = tipo.value === 'movie';
            boxMovie.classList.toggle('d-none', !esPelicula);
            boxSerie.classList.toggle('d-none', esPelicula);
            selMovie.disabled = !esPelicula;
            selSerie.disabled = esPelicula;
        }

        tipo.addEventListener('change', alternar);
        alternar();
    });
</script>