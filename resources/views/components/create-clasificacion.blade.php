<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearClasificacionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('clasificaciones.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearClasificacionLabel">Agregar Nueva Clasificación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="clasificacion" class="form-label">Clasificación</label>
                        <input type="text" name="clasificacion" id="clasificacion" class="form-control" placeholder="Ej. PG-13, R" required>
                    </div>
                    <div class="mb-3">
                        <label for="rango" class="form-label">Rango de Edad</label>
                        <select name="rango" id="rango" class="form-select" required>
                            <option value="" selected disabled>Selecciona un rango...</option>
                            <option value="Todos">Todos</option>
                            <option value="12-15">12-15 años</option>
                            <option value="16-17">16-17 años</option>
                            <option value="+18">+18 años</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Detalles de la clasificación..." required></textarea>
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