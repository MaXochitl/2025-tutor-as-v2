<div class="modal fade" id="edit-p-t-modal" tabindex="-1" aria-labelledby="periodo-t-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periodo-t-modal">
                    Editar Periodo Tutorias
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('periodo-tutorado.update', $item->id) }}">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="inicio" class="label-blue form-label">Fecha inicio</label>
                        <input name="inicio" type="date" class="form-control" id="inicio"
                            value="{{ $item->inicio }}">
                    </div>

                    <div class="form-group">
                        <label for="fin" class="label-blue orm-label">Fecha fin</label>
                        <input name="fin" type="date" class="form-control" id="fin" value="{{ $item->fin }}">

                    </div>

                    <div class="form-group">
                        <label for="mes1" class="label-blue form-label">Entrega mes 1</label>
                        <input name="mes1" type="date" class="form-control" id="mes1" value="{{ $item->mes_1 }}">

                    </div>

                    <div class="form-group">
                        <label for="mes2" class="label-blue form-label">Entrega mes 2</label>
                        <input name="mes2" type="date" class="form-control" id="mes2" value="{{ $item->mes_2 }}">
                    </div>

                    <div class="form-group">
                        <label for="mes3" class="label-blue form-label">Entrega mes 3</label>
                        <input name="mes3" type="date" class="form-control" id="mes3" value="{{ $item->mes_3 }}">
                    </div>

                    <div class="form-group">
                        <label for="mes4" class="label-blue form-label">Entrega mes 4</label>
                        <input name="mes4" type="date" class="form-control" id="mes4" value="{{ $item->mes_4 }}">
                    </div>

                    <div class="form-group">
                        <label for="mes5" class="label-blue form-label">Entrega Final</label>
                        <input name="mes5" type="date" class="form-control" id="mes5"
                            value="{{ $item->reporte_final }}">
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
