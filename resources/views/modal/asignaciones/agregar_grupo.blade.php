<div class="modal fade" id="modal-agregar{{ $item->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('asignaciones.agregarGrupo') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Asignar nuevo grupo a {{ $item->nombre }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="tutor_id" value="{{ $item->id }}">
          <input type="hidden" name="periodo_id" value="{{ $periodo }}">

          <div class="mb-3">
            <label for="semestre">Semestre</label>
            <select name="semestre" class="form-select" required>
              @foreach ($semestres as $s)
                <option value="{{ $s }}">{{ $s }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="grupo">Grupo</label>
            <select name="grupo" class="form-select" required>
              @foreach ($grupos as $g)
                <option value="{{ $g }}">{{ $g }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>