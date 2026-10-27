<div>
    <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearPlataformaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('platforms.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearPlataformaLabel">Agregar Plataforma</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de la Plataforma</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ej. Netflix, HBO Max" required>
                    </div>
                    <div class="mb-3">
                        <label for="costo" class="form-label">Costo ($)</label>
                        <input type="number" name="costo" id="costo" class="form-control" placeholder="Ej. 199" min="0" required>
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