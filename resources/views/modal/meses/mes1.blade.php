<div class="modal fade" id="month1Modal{{$alumnos->id}}" tabindex="-1" aria-labelledby="monthModal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title" id="month1Modal{{ $alumnos->id }}">
                    Alumno
                    {{ $alumnos->alumno->nombre . ' ' . $alumnos->alumno->ap_paterno . ' ' . $alumnos->alumno->ap_paterno }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <h2><b>Mes 1</b></h2>
            <div class="modal-body">
                @if (count($errors) > 0)
                    @include('secciones.errores')
                @endif


                <form id="formUpdate" method="POST"
                    action="{{ route('seguimiento-alumno.seguimiento', [$alumnos->id, 1]) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="seguimiento" class="col-form-label">Describe al alumno:</label>
                        <input name="seguimiento" type="text" class="form-control" value="{{ $alumnos->mes_1 }}">
                    </div>
                    <div class="mb-3">
                        <label for="color" class="col-form-label">Color</label>
                        <select name="color" class="form-select" aria-label="Default select example">
                            @foreach ($semaforo as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }} </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
