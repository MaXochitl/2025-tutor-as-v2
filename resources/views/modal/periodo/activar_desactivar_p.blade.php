


<div class="modal fade" id="modal-active-inactive" tabindex="-1" aria-labelledby="modal-eval" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 60%">
            <div class="modal-header">
                <h3>Activar Desactivar Fechas</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formulario" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="mes_1" class="form-label">Mes1</label>
                        <select id="mes_1" name="mes_1" class="form-select" aria-label="Default select example">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mes_2" class="form-label">Mes 2</label>
                        <select id="mes_2" name="mes_2" class="form-select" aria-label="Default select example">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="mes_3" class="form-label">Mes 3</label>
                        <select id="mes_3" name="mes_3" class="form-select" aria-label="Default select example">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="mes_4" class="form-label">Mes 4</label>
                        <select id="mes_4" name="mes_4" class="form-select" aria-label="Default select example">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mes_5" class="form-label">Mes 5</label>
                        <select id="mes_5" name="mes_5" class="form-select" aria-label="Default select example">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>

                    <div class="form-group mt-2 text-center">
                        <a id="btn_ok" class="btn btn-primary">GUARDAR</a>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

