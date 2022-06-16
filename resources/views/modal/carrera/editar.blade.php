<div class="modal fade" id="carrera-modal-e{{ $item->id }}" tabindex="-1" aria-labelledby="carrera-modal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carrera-modal">
                    Nueva Carrera
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (count($errors) > 0)
                    @include('secciones.errores')
                @endif
                <form method="POST" action="{{ route('carrera.update', $item->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="carrera" class="form-label">Carrera</label>
                        <input name="carrera" type="text" class="form-control" id="carrera"
                            value="{{ $item->nombre_carrera }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="icono">Icono</label>
                        <input name="icono" type="file" class="form-control" id="icono">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="fondo">Fondo</label>
                        <input name="fondo" type="file" class="form-control" id="fondo">
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
