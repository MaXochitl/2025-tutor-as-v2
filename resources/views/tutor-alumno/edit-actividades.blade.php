
<div class="modal fade" id="edit-actividad-{{ $actividad->id }}" tabindex="-1" aria-labelledby="editActivityModalLabel-{{ $actividad->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editActivityModalLabel-{{ $actividad->id }}">
                    Editar Actividad 
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('actividades-tutoria.update', $actividad->id) }}">
                    @csrf
                    @method('PUT') 

                    <div class="form-group">
                        <label for="tema">Tema</label>
                        <input name="tema" type="text" class="form-control" id="tema" value="{{ $actividad->tema }}" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="descripcion_actividad">Descripción de la Actividad</label>
                        <textarea name="descripcion_actividad" class="form-control" id="descripcion_actividad" rows="3" required>{{ $actividad->descripcion_actividad }}</textarea>
                    </div>

                    <div class="form-group mt-3">
                        <label for="fecha">Fecha</label>
                        <input name="fecha" type="date" class="form-control" id="fecha" 
                               value="{{ \Carbon\Carbon::parse($actividad->fecha)->format('Y-m-d') }}" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="tiempo">Tiempo (en formato HH:MM)</label>
                        <label for="tiempo">Tiempo (Horas, Minutos)</label>
                        <input 
                            type="text" 
                            name="tiempo" 
                            class="form-control" 
                            id="tiempo"
                            value="{{ \Carbon\Carbon::parse($actividad->tiempo)->format('H:i') }}"
                            required 
                            pattern="^([01][0-9]|2[0-3]):([0-5][0-9])$" 
                            placeholder="Ejemplo: 13:30" 
                            title="Formato incorrecto. Usa HH:MM, con horas de 00 a 23 y minutos de 00 a 59."
                        >
                    </div>

                    <div class="form-group mt-3">
                        <label for="recursos">Recursos</label>
                        <textarea name="recursos" class="form-control" id="recursos" rows="2">{{ $actividad->recursos }}</textarea>
                    </div>

                    <div class="mt-4 text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
