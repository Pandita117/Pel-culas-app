<div>
    <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearReviewLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearReviewLabel">Agregar Reseña</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="calificacion" class="form-label">Calificación (%)</label>
                        <div class="input-group">
                            <input type="number" name="calificacion" id="calificacion" class="form-control" min="1" max="100" placeholder="Ej. 85" required>
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="form-text">Ingresa un valor entero de 1 a 100.</div>
                    </div>
                    <div class="mb-3">
                        <label for="Reseña" class="form-label">Comentario / Reseña</label>
                        <textarea name="Reseña" id="Reseña" class="form-control" rows="3" placeholder="Escribe tu opinión sobre la película o serie..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
