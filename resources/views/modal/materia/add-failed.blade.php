<div class="modal fade" id="materiaFailed" tabindex="-1" aria-labelledby="materiaFailed" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 600px">
            <div class="modal-header">
                <h5 class="modal-title" id="materiaFailed">
                    Materias Reprobadas
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body" style="text-align: left">
                <form method="POST" action="{{ route('addMateria.addMateria',[$periodo_tutorado->id,0]) }}">
                    @csrf
                    @method('PUT')
                    <table id="table_2" class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Materia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materias as $item)
                                <tr>
                                    <th scope="row">
                                        <label class="list-group-item">
                                            <input 
                                                name="materiax[]" 
                                                class="form-check-input me-1"
                                                type="checkbox" 
                                                value="{{ $item->id }} "
                                                @if(in_array($item->id, $materias_seleccionadas)) 
                                                    checked disabled 
                                                @endif
                                                >
                                                {{ $item->nombre }}
                                                <span>
                                                @if(in_array($item->id, $materias_seleccionadas))
                                                @endif
                                                </span>
                                        </label>
                                    </th>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="form-group row">
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
