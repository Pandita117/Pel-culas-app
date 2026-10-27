<div>
    <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearGeneroLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('generos.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearGeneroLabel">Agregar Nuevo Género</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="genero" class="form-label">Nombre del Género</label>
                        <input type="text" name="genero" id="genero" class="form-control" placeholder="Ej. Acción, Comedia" required>
                    </div>
                    <div class="mb-3">
                        <label for="Descripcion" class="form-label">Descripción</label>
                        <textarea name="Descripcion" id="Descripcion" class="form-control" rows="3" placeholder="Descripción breve del género..." required></textarea>
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