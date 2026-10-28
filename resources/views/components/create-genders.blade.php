<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearGenerosLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('generos.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearGeneroLabel">Agregar nuevo Genero</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                        {{-- -este es para que muestre los errores --}}
                            @if ($errors->any())
                            <div class="alert alert-danger py-2">
                                <ul class="mb-0 ps-3 small">
                                    @foreach ($errors->all() as $error )
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                    {{-- -name del genero   --}}
                    <div class="mb-3">
                        <label for="nombre del genero" class="form-label">Nombre del Genero</label>
                        <input type="text" name="genero" id="genero" class="form-control @error('genero') is-invalid @enderror"
                        " placeholder="Ej. Comedia" value="{{ old('genero') }}">

                        @error('genero')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                {{-- descripciión   --}}

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                    
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