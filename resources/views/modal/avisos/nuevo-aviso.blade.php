<div class="modal fade" id="aviso-modal" tabindex="-1" aria-labelledby="aviso-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aviso-modal">
                    Nuevo Aviso
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (count($errors) > 0)
                    @include('secciones.errores')
                @endif

                <form method="POST" action="{{ route('aviso.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input name="titulo" type="text" class="form-control" id="carrera" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="aviso">Aviso</label>
                        <textarea name="aviso" type="file" class="form-control" id="icono" required> </textarea>
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
