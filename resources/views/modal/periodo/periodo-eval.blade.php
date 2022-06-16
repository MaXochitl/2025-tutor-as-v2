<div class="modal fade" id="modal-eval" tabindex="-1" aria-labelledby="modal-eval" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1>Nuevo Periodo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('periodo-eval.store') }}">
                    @csrf

                    <div class="form-group ">
                        <label for="inicio" class="form-label">Fecha inicio</label>
                        <input name="inicio" type="date" class="form-control" id="inicio">
                    </div>

                    <div class="form-group ">
                        <label for="fin" class="form-label">Fecha fin</label>
                        <input name="fin" type="date" class="form-control" id="fin">
                    </div>

                   

                    <div class="form-group ">
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
