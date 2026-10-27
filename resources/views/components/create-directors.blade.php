@props(['nationalities' => [], 'awards' => []])

<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearDirectorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('directors.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearDirectorLabel">Agregar Nuevo Director</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Campo: Nombre --}}
                    <div class="mb-3">
                        <label for="nombret" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ej.Memo " required>
                    </div>

                    {{-- Campo: Apellido --}}
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ej. de la vaca jejej." required>
                    </div>

                    {{-- Campo: Fecha de Nacimiento --}}
                    <div class="mb-3">
                        <label for="fecha_naci" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_naci" id="fecha_naci" class="form-control" required>
                    </div>

                    {{-- Nacionalidad --}}
                    <div class="mb-3">
                        <label for="id_nacionalidad" class="form-label">Nacionalidad</label>
                        <select name="id_nacionalidad" id="id_nacionalidad" class="form-select" required>
                            <option value="" selected disabled>Selecciona un país/nacionalidad...</option>
                            @foreach($nationalities as $nacionalidad)
                                <option value="{{ $nacionalidad->id }}">
                                    {{ $nacionalidad->idioma }} ({{ $nacionalidad->pais }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{--  Premios (Opcional) --}}
                    <div class="mb-3">
                        <label for="id_premios" class="form-label">Premio (Opcional)</label>
                        <select name="id_premios" id="id_premios" class="form-select">
                            <option value="" selected>Sin premio asignado</option>
                            @foreach($awards as $award)
                                <option value="{{ $award->id }}">
                                    {{ $award->nombre_premio }}
                                </option>
                            @endforeach
                        </select>
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