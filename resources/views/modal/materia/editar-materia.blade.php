@php
$carreras = App\Models\Carrera::all();
$semestres = [1, 2, 3, 4, 5, 6, 7, 8, 9];
@endphp
<div class="modal fade" id="edit-m-{{ $mater->id }}" tabindex="-1" aria-labelledby="periodo-t-modal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periodo-t-modal">
                    Editar Materia
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('materia.update', $mater->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="row">

                        <div class="col-md-11">
                            <div class="form-group">
                                <label for="materia" class="form-label">Nombre de la Materia</label>
                                <input name="materia" type="text" class="form-control" id="materia"
                                    value="{{ $mater->nombre }}">
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="clave" class="form-label">Clave Materia</label>
                                <input name="clave" type="text" class="form-control" id="clave"
                                    value="{{ $mater->clave }}">
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="semestre" class="form-label">Semestre</label>

                                <select name="semestre" class="form-select" aria-label="Default select example">
                                    @foreach ($semestres as $item)

                                        <option @if ($mater->semestre == $item){{ 'selected' }}@endif value="{{ $item }} ">
                                            {{ $item }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                        <div class="col-md-11">
                            <label for="carrera" class="form-label">Carrera</label>
                            <select name="carrera" class="form-select" aria-label="Default select example">
                                @foreach ($carreras as $item)
                                    <option @if ($mater->carrera->id == $item->id){{ 'selected' }}@endif value="{{ $item->id }}">
                                        {{ $item->nombre_carrera }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <div style="text-align: center">

                                <button type="submit" class="btn btn-primary" style="margin-top: 20px">Guardar</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
