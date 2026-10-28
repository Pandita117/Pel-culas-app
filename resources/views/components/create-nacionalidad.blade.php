<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearNacionalidadLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('nacionalidades.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearNacionalidadLabel">Agregar nueva Nacionalidad</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    {{-- Alerta general de errores (solo si NO se está editando) --}}
                    @if ($errors->any() && !old('edit_id'))
                        <div class="alert alert-danger pb-0">
                            <ul class="mb-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Campo: País --}}
                    <div class="mb-3">
                        <label for="Pais" class="form-label">País</label>
                        <input 
                            type="text" 
                            name="Pais" 
                            id="Pais" 
                            class="form-control @if($errors->has('Pais') && !old('edit_id')) is-invalid @endif" 
                            value="{{ !old('edit_id') ? old('Pais') : '' }}" 
                            placeholder="Ej. México" 
                            required>

                        @if ($errors->has('Pais') && !old('edit_id'))
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('Pais') }}
                            </div>
                        @endif
                    </div>

                    {{-- Campo: Idioma --}}
                    <div class="mb-3">
                        <label for="idioma" class="form-label">Idioma Principal</label>
                        <input 
                            type="text" 
                            name="idioma" 
                            id="idioma" 
                            class="form-control @if($errors->has('idioma') && !old('edit_id')) is-invalid @endif" 
                            value="{{ !old('edit_id') ? old('idioma') : '' }}" 
                            placeholder="Ej. Español" 
                            required>

                        @if ($errors->has('idioma') && !old('edit_id'))
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('idioma') }}
                            </div>
                        @endif
                    </div>

                    {{-- Campo: Continente --}}
                    <div class="mb-3">
                        <label for="continente" class="form-label">Continente</label>
                        <input 
                            type="text" 
                            name="continente" 
                            id="continente" 
                            class="form-control @if($errors->has('continente') && !old('edit_id')) is-invalid @endif" 
                            value="{{ !old('edit_id') ? old('continente') : '' }}" 
                            placeholder="Ej. América" 
                            required>

                        @if ($errors->has('continente') && !old('edit_id'))
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('continente') }}
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