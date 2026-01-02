@php
$control_materia = App\Models\Control_materia::where('alumno_id', $alumnos->alumno_id)
    ->where('periodo_id', $alumnos->periodo_id)
    ->get();
@endphp

<div class="modal fade" id="endMatter{{ $alumnos->id }}" tabindex="-1" aria-labelledby="endMatter"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-sm">
            <div class="modal-header bg-light">
                <h5 class="modal-title d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        fill="currentColor"
                        class="bi bi-journal-bookmark-fill text-primary"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8z"/>
                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                    </svg>

                    <span class="fw-bold">Materias del alumno</span>
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-start">

                @if ($control_materia->isEmpty())
                    <div class="alert alert-warning d-flex align-items-center">
                        No hay materias registradas para este periodo
                    </div>
                @else
                    <div class="row">

                        {{-- APROBADAS --}}
                        <div class="col-md-6 mb-3">
                            <div class="card border-success h-100">
                                <div class="card-header bg-success text-white d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        fill="currentColor"
                                        class="bi bi-check-circle-fill"
                                        viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    <span>Aprobadas</span>
                                </div>
                                <div class="card-body p-2" style="max-height: 250px; overflow-y: auto;">
                                    <ul class="list-group list-group-flush">
                                        @forelse ($control_materia->where('status', 1) as $item)
                                            <li class="list-group-item small">
                                                <span class="badge bg-success me-2">✓</span>
                                                {{ $item->materia->nombre }}
                                            </li>
                                        @empty
                                            <li class="list-group-item text-muted small">
                                                Sin materias aprobadas
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- REPROBADAS --}}
                        <div class="col-md-6 mb-3">
                            <div class="card border-danger h-100">
                                <div class="card-header bg-danger text-white d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                    </svg>
                                    <span>Reprobadas</span>
                                </div>
                                <div class="card-body p-2" style="max-height: 250px; overflow-y: auto;">
                                    <ul class="list-group list-group-flush">
                                        @forelse ($control_materia->where('status', 0) as $item)
                                            <li class="list-group-item small">
                                                <span class="badge bg-danger me-2">✕</span>
                                                {{ $item->materia->nombre }}
                                            </li>
                                        @empty
                                            <li class="list-group-item text-muted small">
                                                Sin materias reprobadas
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
