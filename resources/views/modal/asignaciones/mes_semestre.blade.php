<div class="modal fade" id="modal-asignacion{{ $item->id }}" tabindex="-1" aria-labelledby="modal-eval"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>ASIGNAR SEMESTRE Y GRUPO</h5> <br>
                {{ $item->id }}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p>{{ $item->nombre . ' ' . $item->ap_paterno . ' ' . $item->ap_materno }}</p>
                <form method="POST" action="{{ route('asignaciones.update', $id_modal) }}">
                    @method('PUT')
                    @csrf
                    <div class="row  shadow-lg p-3 text-center">
                        <div class="col-3 col-md-6">
                            <label for="semestre">Semestre</label>
                            <select name="semestre" class="form-select" aria-label="Default select example">
                                @foreach ($semestres as $items)
                                    <option value="{{ $items }} ">{{ $items }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-3 col-md-6">
                            <label for="grupo">Grupo</label>
                            <select name="grupo" class="form-select" aria-label="Default select example">
                                @foreach ($grupos as $items)
                                    <option value="{{ $items }} ">{{ $items }} </option>
                                @endforeach
                            </select>
                        </div>

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
