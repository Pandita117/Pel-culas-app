<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearPlataformaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('plataformas.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearPlataformaLabel">Agregar Nueva Plataforma</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @if ($errors->any() && !old('edit_id'))
                        <div class="alert alert-danger pb-0">
                            <ul class="mb-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="nombre_plataforma" class="form-label">Nombre de la Plataforma</label>
                        <input 
                            type="text" 
                            name="nombre_plataforma" 
                            id="nombre_plataforma" 
                            class="form-control @if($errors->has('nombre_plataforma') && !old('edit_id')) is-invalid @endif" 
                            value="{{ !old('edit_id') ? old('nombre_plataforma') : '' }}" 
                            placeholder="Ej. Netflix, HBO Max" 
                            required>

                        @if ($errors->has('nombre_plataforma') && !old('edit_id'))
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('nombre_plataforma') }}
                            </div>
                        @endif
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