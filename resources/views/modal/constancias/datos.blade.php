<div class="modal fade" id="datos-constancia{{ $item->id }}" tabindex="-1" aria-labelledby="carrera-modal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="datos-constancia">
                    EDITAR DATOS: {{ $item->nombre_archivo }}
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left">
                @if (count($errors) > 0)
                    @include('secciones.errores')
                @endif

                <form method="POST" action="{{ route('datospdf.update', $item->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="destinatario" class="form-label">Destinatario</label>
                        <input name="destinatario" type="text" class="form-control" id="destinatario"
                            value="{{ $item->destinatario }}">
                    </div>
                    <div class="text-center">
                        <label class="form-label">Firma 1</label>
                    </div>
                    <div class="form-group">
                        <label for="nombre_1" class="form-label">Nombre</label>
                        <input name="nombre_1" type="text" class="form-control" id="nombre_1"
                            value="{{ $item->atentamente_1 }}">
                        <label for="cargo_1" class="form-label">Cargo</label>
                        <input name="cargo_1" type="text" class="form-control" id="cargo_1"
                            value="{{ $item->cargo }}">
                    </div>
                    <div class="text-center">
                        <label class="form-label">Firma 2</label>
                    </div>
                    <div class="form-group">
                        <label for="nombre_2" class="form-label">Nombre</label>
                        <input name="nombre_2" type="text" class="form-control" id="nombre_2"
                            value="{{ $item->atentamente_2 }}">
                        <label for="cargo_2" class="form-label">Cargo</label>
                        <input name="cargo_2" type="text" class="form-control" id="cargo_2"
                            value="{{ $item->cargo_2 }}">
                    </div>
                    <div class="text-center">
                        <label class="form-label">Firma 3</label>
                    </div>
                    <div class="form-group">
                        <label for="nombre_3" class="form-label">Nombre</label>
                        <input name="nombre_3" type="text" class="form-control" id="nombre_3"
                            value="{{ $item->atentamente_3 }}">
                        <label for="cargo_3" class="form-label">Cargo</label>
                        <input name="cargo_3" type="text" class="form-control" id="cargo_3"
                            value="{{ $item->cargo_3 }}">
                    </div>
                    <div class="text-center p-2">
                        <button href="" type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
