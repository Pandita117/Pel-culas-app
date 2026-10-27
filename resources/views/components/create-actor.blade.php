<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearActorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('actors.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearActorLabel">Agregar Nuevo Actor</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre_act" class="form-label">Nombre</label>
                        <input type="text" name="nombre_act" id="nombre_act" class="form-control" placeholder="Ej. Robert" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_act" class="form-label">Apellido</label>
                        <input type="text" name="apellido_act" id="apellido_act" class="form-control" placeholder="Ej. Downey Jr." required>
                    </div>
                    <div class="mb-3">
                        <label for="f_nac" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" name="f_nac" id="f_nac" class="form-control" required>
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