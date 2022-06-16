<div class="modal fade" id="nuevo-ingreso-edit{{ $alum->id }}" tabindex="-1" aria-labelledby="carrera-modal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carrera-modal">
                    Editar: {{ $alum->nombre }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (count($errors) > 0)
                    @include('secciones.errores')
                @endif


                <form method="POST" action="{{ route('alumnos_examenes.update', $alum->id) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="carrera" class="form-label">Carrera</label>
                        <select name="carrera" class="form-select" aria-label="Default select example">
                            @foreach ($carreras as $item)
                                <option @if ($alum->carrera_id == $item->id) {{ 'selected' }}@endif value="{{ $item->id }}">
                                    {{ $item->nombre_carrera }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="form-label" class="form-label">Numero de control</label>
                        <input style="text-transform:uppercase;" name="num_control" type="text" class="form-control"
                            id="num_control" value="{{ $alum->num_control }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nombre">Nombre Completo</label>
                        <input style="text-transform:uppercase;" name="nombre" type="text" class="form-control"
                            id="nombre" value="{{ $alum->nombre }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="telefono">Telefono</label>
                        <input name="telefono" type="text" class="form-control" id="telefono"
                            value="{{ $alum->telefono }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="correo">Correo</label>
                        <input style="text-transform:lowercase;" name="correo" type="mail" class="form-control"
                            id="correo" value="{{ $alum->correo }}">
                    </div>

                    <div class="form-group">
                        <div style="text-align: center">
                            <button type="submit" class="btn btn-primary" style="margin-top: 20px">Guardar</button>
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
