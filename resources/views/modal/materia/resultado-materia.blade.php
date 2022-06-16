@php
$control_materia = App\Models\Control_materia::where('alumno_id', $alumnos->alumno_id)
    ->where('periodo_id', $alumnos->periodo_id)
    ->get();
@endphp

<div class="modal fade" id="endMatter{{ $alumnos->id }}" tabindex="-1" aria-labelledby="endMatter"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new-materia-modal">
                    <b> MATERIAS</b>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body" style="text-align: left">
                @if (count($control_materia) == 0)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        No hay materias
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                @else
                    <div class="row mb-3">
                        <div class="col-6 themed-grid-col">
                            <h5><b>APROBADAS</b></h5>
                            @foreach ($control_materia->where('status', 1) as $item)
                                {{'* '. $item->materia->nombre }} <br>
                            @endforeach
                        </div>
                        <div class="col-6 themed-grid-col">
                            <h5><b>REPROBADAS</b></h4>
                                @foreach ($control_materia->where('status', 0) as $item)
                                   {{'* '. $item->materia->nombre }} <br>
                                @endforeach
                        </div>
                    </div>
                @endif



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
