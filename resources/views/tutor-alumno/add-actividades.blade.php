
<div class="modal fade" id="addActivityModal" tabindex="-1" aria-labelledby="addActivityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Actividad de Tutoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                @if (count($errors) > 0)
                    @include('secciones.errores')
                @endif

                <form method="POST" action="{{ route('actividades-tutoria.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="tema">Tema</label>
                        <input name="tema" type="text" class="form-control" id="tema" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="descripcion_actividad">Descripción de la Actividad</label>
                        <textarea name="descripcion_actividad" class="form-control" id="descripcion_actividad" rows="3" required></textarea>
                    </div>

                    <div class="form-group mt-3">
                        <label for="fecha">Fecha</label>
                        <input name="fecha" type="date" class="form-control" id="fecha" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="tiempo">Tiempo (en formato HH:MM)</label>
                        <input type="text" name="tiempo" class="form-control" id="tiempo" required placeholder="Ejemplo: 1:30">
                    </div>

                    <div class="form-group mt-3">
                        <label for="recursos">Recursos</label>
                        <textarea name="recursos" class="form-control" id="recursos" rows="2"></textarea>
                    </div>

                    <div class="mt-4 text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
