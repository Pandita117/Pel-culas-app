<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearPremioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('awards.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearPremioLabel">Agregar Nuevo Premio</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- -name del premio papu --}}
                    <div class="mb-3">
                        <label for="nombre del premio" class="form-label">Nombre del Premio</label>
                        <input type="text" name="nombre_premio" id="nombre_premio" class="form-control" placeholder="Ej. OSCAaaarrr" required>
                    </div>
                    {{-- fecha creacion tio  --}}

                    <div class="mb-3">
                        <label for="fecha_creacion" class="form-label">Fecha de Creacion</label>
                        <input type="date" name="fecha_creacion" id="fecha_creacion" class="form-control" required>
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