<div class="modal fade" id="modal-eval{{$item->id}}" tabindex="-1" aria-labelledby="modal-eval" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1>Editar Periodo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('periodo-eval.update', [$item->id]) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="inicio" class="form-label">Cambiar Fecha inicio</label>
                        <input name="inicio" type="date" class="form-control" id="inicio"
                            value="{{ $item->inicio }}">
                    </div>

                    <div class="form-group row">
                        <label for="fin" class="form-label">Cambiar Fecha fin</label>
                        <input name="fin" type="date" class="form-control" id="fin" value="{{ $item->fin }}">
                    </div>

                    <div class="form-group row">
                        <label for="estado" class="form-label">Activar periodo</label>
                        <select name="estado" class="form-select" aria-label="Default select example">
                            <option @if (!$item->estado){{ 'selected' }}@endif value="1">Activo</option>
                            <option @if (!$item->estado){{ 'selected' }}@endif value="0">Inactivo</option>
                        </select>
                    </div>

                    <div class="form-group row">
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
