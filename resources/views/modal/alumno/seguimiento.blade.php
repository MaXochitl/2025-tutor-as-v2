<div class="modal fade" id="monthModal" tabindex="-1" aria-labelledby="monthModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="monthModal">Nuevo Alumno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (count($errors) > 0)
                    @include('secciones.errores')
                @endif


                <form method="POST" action="{{ route('alumnos-tutor.update',$alumnos->id ) }}">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Numero de control:</label>
                        <input name="numero_control" type="text" class="form-control" >
                    </div>

                    <div class="mb-3">

                        <label for="color" class="col-form-label">Semestre</label>

                        <select name="color" class="form-select" aria-label="Default select example">
                            @foreach ($semaforo as $item)
                            <option value="{{$item->id}}">{{$item->nombre}} </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Alumno</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
