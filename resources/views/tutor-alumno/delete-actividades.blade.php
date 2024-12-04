
<div class="modal fade" id="confirmDeleteModal-{{ $actividad->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel-{{ $actividad->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $actividad->id }}">
                    Confirmar Eliminación
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar esta actividad?</p>
                <p><strong>Actividad:</strong> {{ $actividad->tema }}</p>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                
                <form action="{{ route('actividades-tutoria.destroy', $actividad->id) }}" method="POST" class="d-inline formulario-eliminar">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
