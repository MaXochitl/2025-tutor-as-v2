<div class="modal-body">
    <form id="formAlumno" method="POST" action="{{ route('atenciones.store') }}">
        @csrf

        <!-- Número de Control -->
        <div class="form-group">
            <label for="alumno_id">Número de Control</label>
            <input type="text" name="alumno_id" id="alumno_id" class="form-control" placeholder="Número de Control" required>
        </div>

        <!-- Atención -->
        <div class="form-group">
            <label for="atencion">Atención</label>
            <select name="atencion" id="atencion" class="form-select" required>
                <option value="">Selecciona</option>
                <option value="Grupal">Grupal</option>
                <option value="Individual">Individual</option>
                <option value="Grupal/Individual">Grupal/Individual</option>
            </select>
        </div>

        <!-- Canalizado -->
        <div class="form-group">
            <label for="canalizado">¿Canalizado?</label>
            <select name="canalizado" id="canalizado" class="form-select" required>
                <option value="">Selecciona</option>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>

        <!-- Área canalizada -->
        <div class="form-group">
            <label for="area_canalizada">Área Canalizada</label>
            <input type="text" name="area_canalizada" id="area_canalizada" class="form-control" placeholder="Área Canalizada">
        </div>

        <!-- Botón de Enviar -->
        <button type="submit" class="btn btn-primary mt-3">Agregar</button>
    </form>
</div>
