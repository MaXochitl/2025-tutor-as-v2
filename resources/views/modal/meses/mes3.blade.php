<div class="modal fade" id="month3Modal{{$alumnos->id}}" tabindex="-1"
    aria-labelledby="month3ModalLabel{{$alumnos->id}}" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content shadow border-0">

            {{-- HEADER --}}
            <div class="modal-header bg-light">
                <h5 class="modal-title d-flex align-items-center gap-2" id="month3ModalLabel{{$alumnos->id}}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="currentColor"
                        class="bi bi-person-lines-fill text-primary"
                        viewBox="0 0 16 16">
                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
                    </svg>

                    <span>
                        {{ $alumnos->alumno->nombre . ' ' . $alumnos->alumno->ap_paterno . ' ' . $alumnos->alumno->ap_materno }}
                    </span>
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            {{-- BADGE MES --}}
            <div class="text-center py-3 bg-light border-bottom">
                <span class="badge bg-primary fs-5 px-4 py-2 d-inline-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        fill="currentColor"
                        class="bi bi-calendar-check"
                        viewBox="0 0 16 16">
                        <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                    </svg>
                    <span>Mes 3</span>
                </span>
            </div>

            {{-- BODY --}}
            <div class="modal-body p-4">

                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show">
                        @include('secciones.errores')
                    </div>
                @endif

                <form method="POST"
                    action="{{ route('seguimiento-alumno.seguimiento', [$alumnos->id, 3]) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary">
                            Descripción del alumno
                        </label>

                        <textarea name="seguimiento"
                            class="form-control shadow-sm"
                            rows="4"
                            style="resize: vertical; min-height: 120px;"
                            placeholder="Escribe aquí el seguimiento del alumno...">{{ $alumnos->mes_3 }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary">
                            Color
                        </label>
                        <select name="color" class="form-select shadow-sm">
                            @foreach ($semaforo as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- FOOTER --}}
                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <button type="submit"
                            class="btn btn-primary px-4 d-flex align-items-center gap-2">
                            Guardar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
