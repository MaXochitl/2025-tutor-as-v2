<div class="modal fade" id="oe3Modal{{$alumnos->id}}" tabindex="-1" aria-labelledby="oe3Modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="oe3Modal{{$alumnos->id}}">
                    Alumno: {{ $alumnos->alumno->nombre . ' ' . $alumnos->alumno->ap_paterno . ' ' . $alumnos->alumno->ap_paterno }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <h2><b>Mes 3</b></h2> 

            <div class="modal-body">
                @if (count($errors) > 0)
                    @include('secciones.errores')
                @endif


                <form id="formUpdate" method="POST" action="{{ route('seguimientoOE-alumno.seguimientoOE',[$alumnos->id,3]) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="seguimiento" class="col-form-label">Describe al alumno:</label>
                        <textarea name="seguimiento" type="text" class="form-control">{{ $alumnos->oe_3 }}</textarea>
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
