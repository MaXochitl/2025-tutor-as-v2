@extends('master.master')
@section('structure-content')
<div class="container">

    <!-- Ordenar Semestres de tabla periodo_tutorado y Grupos de tabla alumnos -->
    @php
        // Ordenar por semestre y luego por grupo
        $alumnosOrdenados = $alumnos_tutor->sortBy([
            ['semestre', 'asc'],
            ['alumno.grupo', 'asc'],
        ]);

        // Agrupar por semestre y grupo
        $grupos = $alumnosOrdenados->groupBy(function ($alumno) {
            return $alumno->semestre . '-' . $alumno->alumno->grupo;
        });
    @endphp

    @php
        date_default_timezone_set('America/Mexico_City');
        $inicio = strtotime($periodo->inicio);
        $fin = strtotime($periodo->fin);
        $mes_1 = strtotime($periodo->mes_1);
        $mes_2 = strtotime($periodo->mes_2);
        $mes_3 = strtotime($periodo->mes_3);
        $mes_4 = strtotime($periodo->mes_4);
        $entrega_final = strtotime($periodo->reporte_final);
        $fecha_actual = strtotime(date('Y-m-d', time()));
    @endphp

    <div style="text-align: right; margin: 20px">
        <a href="{{ route('tutor.show', $tutor->carrera->id) }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
            </svg>
        </a>
    </div>

    <div class="row img-font-all"
        style="border-radius: 10px;margin-top: 30px;background-image: url({{ $tutor->carrera->fondo }});">
        <div class="col-6 py-2 px-3"
            style="border-radius: 10px; background: white; margin: 5px;">

            <!-- Nombre -->
            <div class="mb-1">
                <p class="head-alumnos-tutor mb-0">
                    <b>Nombre Tutor de grupo:</b>
                    {{ $tutor->nombre . ' ' . $tutor->ap_paterno . ' ' . $tutor->ap_materno }}
                </p>
            </div>

            <!-- Carrera -->
            <div class="mb-1">
                <p class="head-alumnos-tutor mb-0">
                    <b>Carrera:</b> {{ $tutor->carrera->nombre_carrera }}
                </p>
            </div>

            <!-- Semestres y grupos -->
            <div class="mb-1">
                @if ($asigno != 0 && !($asignado[0]->semestre == 0 || $asignado[0]->grupo == 'sin asignar'))
                    <p class="head-alumnos-tutor mb-0">
                        <b>Semestres y grupos:</b>
                        @foreach ($asignado->sortBy(function($asig) {
                            return $asig->semestre . str_pad($asig->grupo, 2, '0', STR_PAD_LEFT);
                        }) as $asig)
                            {{ $asig->semestre }}{{ $asig->grupo }}@if(!$loop->last),@endif
                        @endforeach
                    </p>
                @else
                    <div class="d-flex align-items-center gap-2">
                        <div class="alert alert-warning mb-0 py-1 px-3 d-flex align-items-center"
                            role="alert">
                            <b class="me-1">Semestres y grupos:</b>
                            <span>Este tutor no tiene grupos asignados.</span>
                        </div>
                        <a href="{{ route('asignaciones.index') }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Asignar
                        </a>
                    </div>
                @endif
            </div>

            @php
                $sgAsignados = $asignado->map(function($a){
                    return $a->semestre . '-' . $a->grupo;
                })->toArray();
            @endphp

            <!-- Teléfono -->
            <div class="mb-1">
                <p class="head-alumnos-tutor mb-0">
                    <b>Teléfono:</b> {{ $tutor->telefono }}
                </p>
            </div>

            <!-- Periodo -->
            <div class="mb-0">
                <p class="head-alumnos-tutor mb-0">
                    @php
                        $periodo_inicio = date('d/m/Y', strtotime($periodo->inicio));
                        $periodo_fin = date('d/m/Y', strtotime($periodo->fin));
                        echo '<b>Periodo:</b> ' . $periodo_inicio . ' - ' . $periodo_fin;
                    @endphp
                </p>
            </div>

        </div>
        <div class="col-2 py-2 px-3 d-flex flex-column justify-content-center"
            style="border-radius: 10px; background: white; margin: 5px;">

            <div class="d-flex justify-content-between mb-0">
                <strong>Mujeres:</strong><span>{{ $mujeres }}</span>
            </div>

            <div class="d-flex justify-content-between mb-0">
                <strong>Hombres:</strong><span>{{ $hombres }}</span>
            </div>

            <div class="d-flex justify-content-between mb-0">
                <strong>Baja Temporal:</strong><span>{{ $temporal }}</span>
            </div>

            <div class="d-flex justify-content-between mb-0">
                <strong>Baja:</strong><span>{{ $baja }}</span>
            </div>

            <div class="d-flex justify-content-between mb-0">
                <strong>Verde:</strong><span>{{ $verde }}</span>
            </div>

            <div class="d-flex justify-content-between mb-0">
                <strong>Amarillo:</strong><span>{{ $naranja }}</span>
            </div>

            <div class="d-flex justify-content-between mb-0">
                <strong>Rojo:</strong><span>{{ $rojo }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row row-tutor">
    <div>
        <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">
            <!--____________________________ codigo de barra de busqueda-->
            <div class="container my-3">
                <div class="row justify-content-end">
                    <div class="col-md-6 col-lg-4">
                        <form class="input-group" method="POST" action="{{ route('searchAluTutor', $tutor->id) }}">
                            @csrf
                            <input name="search_tutor" type="text" class="form-control" 
                                placeholder="Nombre o número de control"
                                aria-label="Buscar" id="search-input" value="{{ $palabra }}">
                            <button class="btn btn-primary" type="submit">Buscar</button>
                            <a href="{{ route('alumnos-tutor.show', $tutor->id) }}" class="btn btn-danger">Borrar</a>
                        </form>
                    </div>
                </div>
            </div>
            <!--  _________________________________  fin de la barra de busqueda-->

            <nav>
                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                    <a class="nav-link tabs_s active" id="nav-home-tab" data-bs-toggle="tab"
                        href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
                        Orientación
                    </a>
                    <a class="nav-link tabs_s" id="nav-profile-tab" data-bs-toggle="tab"
                        href="#nav-profile" role="tab" aria-controls="nav-profile"
                        aria-selected="false" title="Modo solo lectura">
                        <i class="bi bi-eye-fill text-primary"></i>
                        Tutor 
                        <small class="text-muted ms-1">(visualización)</small>
                    </a>
                    <a class="nav-link tabs_s" id="nav-contact-tab" data-bs-toggle="tab"
                        href="#nav-contact" role="tab" aria-controls="nav-contact"
                        aria-selected="false" title="Modo solo lectura">
                        <i class="bi bi-eye-fill text-primary"></i>
                        Docente
                        <small class="text-muted ms-1">(visualización)</small>
                    </a>
                    <a class="nav-link tabs_s" id="nav-act-visual-tab"
                    data-bs-toggle="tab"
                    href="#nav-act-visual"
                    role="tab"
                    aria-controls="nav-act-visual"
                    aria-selected="false"
                    title="Modo solo lectura">
                        <i class="bi bi-eye-fill text-primary me-1"></i>
                        Actividades
                        <small class="text-muted ms-1">(visualización)</small>
                    </a>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                {{-- ================= TAB ORIENTACIÓN ================= --}}
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    @include('tutor-alumno.orientacion-oe')
                </div>

                {{-- ================= TAB TUTOR visualizacion ================= --}}
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    @include('tutor-alumno.tutor-visual')
                </div>

                {{-- ================= TAB DOCENTE visualizacion ================= --}}
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    @include('tutor-alumno.docente-visual')
                </div>

                {{-- ================= TAB VISUALIZACIÓN ================= --}}
                <div class="tab-pane fade"
                    id="nav-act-visual"
                    role="tabpanel"
                    aria-labelledby="nav-act-visual-tab">
                    @include('tutor-alumno.actividades-visual')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection