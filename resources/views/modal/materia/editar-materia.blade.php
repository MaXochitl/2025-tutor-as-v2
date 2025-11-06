@php
    $carreras = App\Models\Carrera::all();
    $semestres = [1, 2, 3, 4, 5, 6, 7, 8, 9];
@endphp

<div class="modal fade" id="edit-m-{{ $mater->id }}" tabindex="-1" aria-labelledby="periodo-t-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periodo-t-modal"><b>Editar materia</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('materia.update', $mater->id) }}">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        {{-- Nombre de la materia --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label for="materia" class="form-label">Nombre de la materia</label>
                                <input name="materia" type="text" class="form-control" id="materia"
                                    value="{{ $mater->nombre }}" required>
                            </div>
                        </div>

                        {{-- Clave y semestre --}}
                        <div class="col-9">
                            <div class="form-group">
                                <label for="clave" class="form-label">Clave Materia</label>
                                <input name="clave" type="text" class="form-control" id="clave"
                                    value="{{ $mater->clave }}" required>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="semestre" class="form-label">Semestre</label>
                                <select name="semestre" class="form-select" required>
                                    @for ($i = 1; $i <= 16; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                                </select>
                            </div>
                        </div>

                        {{-- Carrera --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label for="carrera" class="form-label">Carrera</label>
                                <select name="carrera" class="form-select" required>
                                    @foreach ($carreras as $item)
                                        <option value="{{ $item->id }}" @if ($mater->carrera->id == $item->id) selected @endif>
                                            {{ $item->nombre_carrera }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Botón guardar --}}
                        <div class="col-12">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Guardar</button>
                            </div>
                        </div>
                    </div> {{-- /.row --}}
                </form>
            </div>
        </div>
    </div>
</div>
