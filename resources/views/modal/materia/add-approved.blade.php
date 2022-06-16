<div class="modal fade" id="materiaModal" tabindex="-1" aria-labelledby="materiaModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="materias-modal">
                    Materias
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body" style="text-align: left">
                <form method="POST" action="{{ route('addMateria.addMateria',[$periodo_tutorado->id,1]) }}">
                    @csrf
                    @method('PUT')
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Materia</th>
                                <th scope="col">Semestre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materias as $item)
                                <tr>
                                    <th scope="row">
                                        <label class="list-group-item">
                                            <input name="materiax[]" class="form-check-input me-1"
                                                type="checkbox" value="{{ $item->id }} ">
                                            {{ $item->nombre }}
                                        </label>
                                    </th>
                                    <td>
                                        {{ $item->semestre }}
                                    </td>

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
