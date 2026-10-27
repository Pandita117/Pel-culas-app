<div>
    <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearNacionalidadLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('nationalities.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearNacionalidadLabel">Agregar Nacionalidad</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Pais" class="form-label">País</label>
                        <input type="text" name="Pais" id="Pais" class="form-control" placeholder="Ej. México, España" required>
                    </div>
                    <div class="mb-3">
                        <label for="idioma" class="form-label">Idioma Principal</label>
                        <input type="text" name="idioma" id="idioma" class="form-control" placeholder="Ej. Español, Inglés" required>
                    </div>
                    <div class="mb-3">
                        <label for="continente" class="form-label">Continente</label>
                        <input type="text" name="continente" id="continente" class="form-control" placeholder="Ej. América, Europa" required>
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