<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearProductoraLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('productoras.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearProductoraLabel">Agregar nueva Productora</h5>
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

                    {{-- -name de la producer tag   --}}
                    <div class="mb-3">
                        <label for="nombre productora" class="form-label">Nombre de la productora</label>
                        <input type="text" name="nombre_productora" id="nombre_productora" class="form-control @error('nombre_productora') is-invalid @enderror" 
                        placeholder="Ej. Warner Bros" value="{{ old('nombre_productora') }}"
                        required>

                       @error('clasificacion')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        
                    </div>
                    {{-- descripciión   --}}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>