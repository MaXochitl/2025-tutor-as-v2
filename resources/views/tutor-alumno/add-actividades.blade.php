
<div class="modal fade" id="addActivityModal" tabindex="-1" aria-labelledby="addActivityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar actividad de tutoría</h5>
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
                        <label for="descripcion_actividad">Descripción de la actividad</label>
                        <textarea name="descripcion_actividad" class="form-control" id="descripcion_actividad" rows="3" required></textarea>
                    </div>

                    <div class="form-group mt-3">
                        <label for="fecha">Fecha</label>
                        <input name="fecha" type="date" class="form-control" id="fecha" required >
                    </div>

                    <div class="form-group mt-3">
                    <label for="tiempo">Tiempo (Horas, Minutos)</label>
                    <input 
                    type="text" 
                    name="tiempo" 
                    class="form-control" 
                    id="tiempo" 
                    required 
                    pattern="^([01][0-9]|2[0-3]):([0-5][0-9])$" 
                    placeholder="Ejemplo: 02:30" 
                    title="Formato incorrecto. Usa HH:MM, con horas de 00 a 23 y minutos de 00 a 59."
                    >
                    </div>
                    <div class="form-group mt-3">
                        <label for="recursos">Recursos</label>
                        <textarea name="recursos" class="form-control" id="recursos" rows="2" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
