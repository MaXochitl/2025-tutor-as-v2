@extends('master.master')
@section('structure-content')
<div class="container">
    @if (session('alumno') == 'ok')
    <div class="alert alert-success">
        El alumno se agrego con exito!
    </div>
    @endif
    @if (session('existe_alumno') == 'no')
    <div class="alert alert-danger">
        No se encontro Alumno! Puedes registrarlo en la seccion nuevo alumno
    </div>
    @endif
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

    @if (count($alumnos_tutor) == 0)
    <div class="alert alert-danger" style="margin-top: 20px">
        No se encotraron registros!
    </div>
    @else
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
        <a href="{{ route('tutor.show', $alumnos_tutor[0]->tutor->carrera->id) }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40   " fill="currentColor"
                class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
            </svg>
        </a>
    </div>
    <div class="row img-font-all"
        style="border-radius: 10px;margin-top: 30px;background-image: url({{ $alumnos_tutor[0]->tutor->carrera->fondo }});">
        <div class="col-6" style="border-radius: 10px; background: white; margin: 5px">
            <p class="head-alumnos-tutor"><b>Nombre Tutor de grupo: </b>
                {{ $alumnos_tutor[0]->tutor->nombre . ' ' . $alumnos_tutor[0]->tutor->ap_paterno . ' ' . $alumnos_tutor[0]->tutor->ap_materno }}
            </p>
            <p class="head-alumnos-tutor"><b>Carrera: </b> {{ $alumnos_tutor[0]->tutor->carrera->nombre_carrera }}
            </p>
            @if ($asigno != 0 && !($asignado[0]->semestre == 0 || $asignado[0]->grupo == 'sin asignar'))
            <!-- modificado para mostrar multiples grupos asignados por OE, mostrados en orden alfanumerico  -->
            <p class="head-alumnos-tutor">
                <b>Semestres y grupos:</b>
                @foreach ($asignado->sortBy(function($asig) {
                return $asig->semestre . str_pad($asig->grupo, 2, '0', STR_PAD_LEFT);
                }) as $asig)
                {{ $asig->semestre }}{{ $asig->grupo }}@if(!$loop->last),@endif
                @endforeach
            </p>
            @else
            <div class="d-flex align-items-center gap-2 mt-2">
                <div class="alert alert-warning mb-0 d-flex align-items-center" 
                    role="alert" style="padding: 6px 20px;">
                    <b>Semestres y grupos:</b>
                    <span class="ms-1">Este tutor no tiene grupos asignados.</span>
                </div>
                <a href="{{ route('asignaciones.index') }}" class="btn btn-warning">
                <i class="bi bi-pencil-square"></i> Asignar
                </a>
            </div>
            @endif
            @php
            $sgAsignados = $asignado->map(function($a){
            return $a->semestre . '-' . $a->grupo;
            })->toArray();
            @endphp
            <p class="head-alumnos-tutor" style="margin-top: 6px"><b>Telefono:</b> {{ $alumnos_tutor[0]->tutor->telefono }} </p>
            @php
            $periodo_inicio = date('d/m/Y', strtotime($periodo->inicio));
            $periodo_fin = date('d/m/Y', strtotime($periodo->fin));
            echo ' <b>Periodo: </b>' . $periodo_inicio . ' - ' . $periodo_fin;
            @endphp
        </div>
        <div class="col-2" style="border-radius: 10px; background: white; margin: 5px">
            <table>
                <tbody>
                    <tr class="new-row">
                        <th scope="col">{{ 'Mujeres:' }}</th>
                        <td>
                            {{ $mujeres }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">{{ 'Hombres:' }}</th>
                        <td>
                            {{ $hombres }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">{{ 'Baja Temporal:' }}</th>
                        <td>
                            {{ $temporal }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">{{ 'Baja:' }}</th>
                        <td>
                            {{ $baja }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">{{ 'Verde:' }}</th>
                        <td>
                            {{ $verde }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">{{ 'Amarillo:' }}</th>
                        <td>
                            {{ $naranja }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">{{ 'Rojo:' }}</th>
                        <td>
                            {{ $rojo }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row row-tutor">
<div class="overflow-scroll">
    <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">
        <!--____________________________ codigo de barra de busqueda-->
        <div class="container my-3">
            <div class="row justify-content-end">
                <div class="col-md-6 col-lg-4">
                    <form class="input-group" method="POST" action="{{ route('searchAluTutor', $alumnos_tutor[0]->tutor->id) }}">
                        @csrf
                        <input name="search_tutor" type="text" class="form-control" placeholder="Nombre o número de control"
                            aria-label="Buscar" id="search-input" value="{{ $palabra }}">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                        <a href="{{ route('alumnos-tutor.show', $alumnos_tutor[0]->tutor->id) }}" class="btn btn-danger">Borrar</a>
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
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            {{-- ================= TAB ORIENTACIÓN ================= --}}
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                @foreach ($grupos as $grupoKey => $alumnosGrupo)
                @php
                $partes = explode('-', $grupoKey);
                $semestre = $partes[0];
                $grupo = $partes[1];
                $sgActual = $semestre . '-' . $grupo;   
                @endphp
                <!--A. comparar arreglo sgActual de semestregrupos asignados al tutor con los que se a asignado el el tutor-->
                @if(!in_array($sgActual, $sgAsignados))
                <h5 class="mt-3 mb-2 text-danger">Semestre: {{ $semestre }} - Grupo: {{ $grupo }} (No asignado)</h5>
                @else
                <h5 class="mt-3 mb-2">Semestre: {{ $semestre }} - Grupo: {{ $grupo }}</h5>
                @endif
                <table class="table text-start table-striped" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="title-table" scope="col">N° CONTROL</th>
                            <th class="title-table" scope="col">NOMBRE COMPLETO</th>
                            <th class="title-table" scope="col">TELEFONO</th>
                            <th class="text-center" scope="col">MES<br>1</th>
                            <th class="text-center" scope="col">O.E.<br>1</th>
                            <th class="text-center" scope="col">MES<br>2</th>
                            <th class="text-center" scope="col">O.E.<br>2</th>
                            <th class="text-center" scope="col">MES<br>3</th>
                            <th class="text-center" scope="col">O.E.<br>3</th>
                            <th class="text-center" scope="col">MES<br>4</th>
                            <th class="text-center" scope="col">O.E.<br>4</th>
                            <th class="text-center" scope="col">RESULTADOS</th>
                            @can('solo.admin')
                            <th class="text-center" scope="col">OPCIONES</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumnosGrupo as $alumnos)
                        <tr>
                            <td style="background: {{ $alumnos->semaforo->fondo }} ">
                                <p>{{ $alumnos->alumno->id }} </p>
                            </td>
                            <td>{{ $alumnos->alumno->nombre . ' ' . $alumnos->alumno->ap_paterno . ' ' . $alumnos->alumno->ap_materno }}
                            </td>
                            <td>
                                {{ $alumnos->alumno->telefono }}
                            </td>
                            <!-- MES 1-->
                            <td style="min-width: 150px">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div style="flex: 1; height: 5px; background: {{ $alumnos->lights[0]->semaforos[0]->fondo }};"></div>
                                    @if ($alumnos->entrega_1)
                                    <div style="padding-left: 6px; white-space: nowrap; font-size: 10px;">
                                        <b>{{ date('d/m/Y', strtotime($alumnos->entrega_1)) }}</b>
                                    </div>
                                    @endif
                                </div>
                                <div style="padding: 4px 2px;">
                                    {{ $alumnos->mes_1 }}
                                </div>
                            </td>
                            <!-- OE 1-->
                            <td class="casilla editable" data-bs-toggle="modal" data-bs-target="#oe1Modal{{ $alumnos->id }}" title="Añadir respuesta (OE 1)" style="min-width: 80px;">
                                <div>
                                    {{ $alumnos->oe_1 }}
                                </div>
                            </td>
                            @can('solo.admin')
                            @include('modal.orientacion.mes1')
                            @endcan
                            <!-- MES 2 -->
                            <td style="min-width: 150px">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div style="flex: 1; height: 5px; background: {{ $alumnos->lights[1]->semaforos[0]->fondo }};"></div>
                                    @if ($alumnos->entrega_2)
                                    <div style="padding-left: 6px; white-space: nowrap; font-size: 10px;">
                                        <b>{{ date('d/m/Y', strtotime($alumnos->entrega_2)) }}</b>
                                    </div>
                                    @endif
                                </div>
                                <div style="padding: 4px 2px;">
                                    {{ $alumnos->mes_2 }}
                                </div>
                            </td>
                            <!-- OE 2-->
                            <td class="casilla editable" data-bs-toggle="modal" data-bs-target="#oe2Modal{{ $alumnos->id }}" title="Añadir respuesta (OE 2)" style="min-width: 80px;">
                                <div>
                                    {{ $alumnos->oe_2 }}
                                </div>
                            </td>
                            @can('solo.admin')
                            @include('modal.orientacion.mes2')
                            @endcan
                            <!-- MES 3 -->
                            <td style="min-width: 150px">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div style="flex: 1; height: 5px; background: {{ $alumnos->lights[2]->semaforos[0]->fondo }};"></div>
                                    @if ($alumnos->entrega_3)
                                    <div style="padding-left: 6px; white-space: nowrap; font-size: 10px;">
                                        <b>{{ date('d/m/Y', strtotime($alumnos->entrega_3)) }}</b>
                                    </div>
                                    @endif
                                </div>
                                <div style="padding: 4px 2px;">
                                    {{ $alumnos->mes_3 }}
                                </div>
                            </td>
                            <!-- OE 3-->
                            <td class="casilla editable" data-bs-toggle="modal" data-bs-target="#oe3Modal{{ $alumnos->id }}" title="Añadir respuesta (OE 3)" style="min-width: 80px;">
                                <div>
                                    {{ $alumnos->oe_3 }}
                                </div>
                            </td>
                            @can('solo.admin')
                            @include('modal.orientacion.mes3')
                            @endcan
                            <!-- MES 4 -->
                            <td style="min-width: 150px">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div style="flex: 1; height: 5px; background: {{ $alumnos->lights[3]->semaforos[0]->fondo }};"></div>
                                    @if ($alumnos->entrega_4)
                                    <div style="padding-left: 6px; white-space: nowrap; font-size: 10px;">
                                        <b>{{ date('d/m/Y', strtotime($alumnos->entrega_4)) }}</b>
                                    </div>
                                    @endif
                                </div>
                                <div style="padding: 4px 2px;">
                                    {{ $alumnos->mes_4 }}
                                </div>
                            </td>
                            <!-- OE 4-->
                            <td class="casilla editable" data-bs-toggle="modal" data-bs-target="#oe4Modal{{ $alumnos->id }}" title="Añadir respuesta (OE 4)" style="min-width: 80px;">
                                <div>
                                    {{ $alumnos->oe_4 }}
                                </div>
                            </td>
                            @can('solo.admin')
                            @include('modal.orientacion.mes4')
                            @endcan
                            <!-- RESULTADOS (materias) -->
                            <td class="casilla-materias align-top text-center"
                                data-bs-toggle="modal"
                                data-bs-target="#endMatter{{ $alumnos->id }}"
                                title="Ver materias">
                                <div>
                                    {{ $alumnos->reporte_final }}
                                </div>
                            </td>
                            @include('modal.materia.resultado-materia')
                            <!-- OPCIONES (baja temporal o definitiva) -->
                            <td class="text-center">
                                @can('solo.admin')
                                <div>
                                    <form action="{{ route('alumnos-tutor.destroy', $alumnos->id) }} "
                                        class="formulario-eliminar" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-danger btn-sm dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            Opciones
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('baja', [$alumnos->id, 2, 5]) }}">Baja
                                                    Temporal</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('baja', [$alumnos->id, 3, 6]) }} ">Baja
                                                    Definitiva</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endforeach
            </div>
            {{-- ================= TAB TUTOR ================= --}}
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="row row-tutor" style="padding: 20px;">
                    <div class="col d-flex flex-column flex-shrink-0">
                        <p><strong>Lista de alumnos (tutorados) canalizados por otros docentes</strong></p>
                        <div class="overflow-scroll">
                            <table class="table table-bordered table-striped text-start" style="font-size: 12px">
                                <thead>
                                    <tr>
                                        <th class="title-table" scope="col">N°</th>
                                        <th class="title-table" scope="col">N° CONTROL</th>
                                        <th class="title-table" scope="col">NOMBRE COMPLETO</th>
                                        <th class="title-table" scope="col">TELEFONO</th>
                                        <th class="text-center" scope="col">DOCENTE<br>1</th>
                                        <th class="text-center" scope="col">TUTOR<br>1</th>
                                        <th class="text-center" scope="col">DOCENTE<br>2</th>
                                        <th class="text-center" scope="col">TUTOR<br>2</th>
                                        <th class="text-center" scope="col">DOCENTE<br>3</th>
                                        <th class="text-center" scope="col">TUTOR<br>3</th>
                                        <th class="text-center" scope="col">DOCENTE<br>4</th>
                                        <th class="text-center" scope="col">TUTOR<br>4</th>
                                        <th scope="col">CANALIZÓ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $contador = 1;
                                    $tutor_id = $alumnos_tutor[0]->tutor->id ?? null;
                                    @endphp
                                    @if (!empty($tutorado))
                                    @foreach ($docente_alumno as $alumnos)
                                    @if (in_array(strtolower((string) $alumnos->alumno_id), $tutorado))
                                    <tr>
                                        <th scope="row">{{ $contador++ }}</th>
                                        <td style="background: {{ $alumnos->semaforo->fondo }} ">
                                            <p>{{ $alumnos->alumno->id }}</p>
                                        </td>
                                        <td>{{ $alumnos->alumno->nombre . ' ' . $alumnos->alumno->ap_paterno . ' ' . $alumnos->alumno->ap_materno }}</td>
                                        <td>{{ $alumnos->alumno->telefono }}</td>
                                        <!-- DOCENTE 1-->
                                        <td class="cell-padding cell-justificada" style="padding-top: 6px !important;">
                                            <i class="bi bi-circle-fill"
                                            style="color: {{ (!empty($alumnos->lights[0]->semaforos[0]->fondo) && $alumnos->lights[0]->semaforos[0]->fondo !== '#')
                                                                ? $alumnos->lights[0]->semaforos[0]->fondo
                                                                : 'transparent' }}">
                                            </i>

                                            @if ($alumnos->entrega_1 != null)
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_1)) }}</b>
                                                </small>
                                            @endif

                                            <div>{{ $alumnos->mes_1 ? ucfirst($alumnos->mes_1) : '' }}</div>
                                        </td>
                                        <!-- TUTOR 1-->
                                        <td>
                                            {{ $alumnos->oe_1 }}
                                        </td>
                                        <!-- DOCENTE 2-->
                                        <td class="cell-padding cell-justificada" style="padding-top: 6px !important;">
                                            <i class="bi bi-circle-fill"
                                            style="color: {{ (!empty($alumnos->lights[1]->semaforos[0]->fondo) && $alumnos->lights[1]->semaforos[0]->fondo !== '#')
                                                                ? $alumnos->lights[1]->semaforos[0]->fondo
                                                                : 'transparent' }}">
                                            </i>

                                            @if ($alumnos->entrega_2 != null)
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_2)) }}</b>
                                                </small>
                                            @endif

                                            <div>{{ $alumnos->mes_2 ? ucfirst($alumnos->mes_2) : '' }}</div>
                                        </td>
                                        <!-- TUTOR 2-->
                                        <td>
                                            {{ $alumnos->oe_2 }}
                                        </td>
                                        <!-- DOCENTE 3-->
                                        <td class="cell-padding cell-justificada" style="padding-top: 6px !important;">
                                            <i class="bi bi-circle-fill"
                                            style="color: {{ (!empty($alumnos->lights[2]->semaforos[0]->fondo) && $alumnos->lights[2]->semaforos[0]->fondo !== '#')
                                                                ? $alumnos->lights[2]->semaforos[0]->fondo
                                                                : 'transparent' }}">
                                            </i>

                                            @if ($alumnos->entrega_3 != null)
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_3)) }}</b>
                                                </small>
                                            @endif

                                            <div>{{ $alumnos->mes_3 ? ucfirst($alumnos->mes_3) : '' }}</div>
                                        </td>
                                        <!-- TUTOR 3-->
                                        <td>
                                            {{ $alumnos->oe_3 }}
                                        </td>
                                        <!-- DOCENTE 4-->
                                        <td class="cell-padding cell-justificada" style="padding-top: 6px !important;">
                                            <i class="bi bi-circle-fill"
                                            style="color: {{ (!empty($alumnos->lights[3]->semaforos[0]->fondo) && $alumnos->lights[3]->semaforos[0]->fondo !== '#')
                                                                ? $alumnos->lights[3]->semaforos[0]->fondo
                                                                : 'transparent' }}">
                                            </i>

                                            @if ($alumnos->entrega_4 != null)
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_4)) }}</b>
                                                </small>
                                            @endif

                                            <div>{{ $alumnos->mes_4 ? ucfirst($alumnos->mes_4) : '' }}</div>
                                        </td>
                                        <!-- TUTOR 4-->
                                        <td>
                                            {{ $alumnos->oe_4 }}
                                        </td>
                                        <td>
                                            {{ $alumnos->tutor->nombre . ' ' . $alumnos->tutor->ap_paterno . ' ' . $alumnos->tutor->ap_materno }}
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ================= TAB DOCENTE ================= --}}
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="row row-tutor" style="padding: 20px;">
                    <div class="col d-flex flex-column flex-shrink-0">
                        <p><strong>Lista de alumnos (no tutorados) canalizados por este docente</strong></p>
                        <div class="overflow-scroll">
                            <table class="table table-bordered table-striped text-start" style="font-size: 12px">
                                <thead>
                                    <tr>
                                        <th class="title-table" scope="col">N°</th>
                                        <th class="title-table" scope="col">N° CONTROL</th>
                                        <th class="title-table" scope="col">NOMBRE COMPLETO</th>
                                        <th class="title-table" scope="col">TELEFONO</th>
                                        <th class="text-center" scope="col">DOCENTE<br>1</th>
                                        <th class="text-center" scope="col">TUTOR<br>1</th>
                                        <th class="text-center" scope="col">DOCENTE<br>2</th>
                                        <th class="text-center" scope="col">TUTOR<br>2</th>
                                        <th class="text-center" scope="col">DOCENTE<br>3</th>
                                        <th class="text-center" scope="col">TUTOR<br>3</th>
                                        <th class="text-center" scope="col">DOCENTE<br>4</th>
                                        <th class="text-center" scope="col">TUTOR<br>4</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $contador = 1;
                                    $tutor_id = $alumnos_tutor[0]->tutor->id ?? null;
                                    @endphp
                                    @foreach ($docente_alumno as $alumnos)
                                    @if ($alumnos->tutor_id == $tutor_id)
                                    <tr>
                                        <th scope="row">{{ $contador++ }}</th>
                                        <td style="background: {{ $alumnos->semaforo->fondo }} ">
                                            <p>{{ $alumnos->alumno->id }}</p>
                                        </td>
                                        <td>{{ $alumnos->alumno->nombre . ' ' . $alumnos->alumno->ap_paterno . ' ' . $alumnos->alumno->ap_materno }}</td>
                                        <td>{{ $alumnos->alumno->telefono }}</td>
                                        <!-- DOCENTE 1-->
                                        <td class="cell-padding cell-justificada" style="padding-top: 6px !important;">
                                            <i class="bi bi-circle-fill"
                                            style="color: {{ (!empty($alumnos->lights[0]->semaforos[0]->fondo) && $alumnos->lights[0]->semaforos[0]->fondo !== '#')
                                                                ? $alumnos->lights[0]->semaforos[0]->fondo
                                                                : 'transparent' }}">
                                            </i>

                                            @if ($alumnos->entrega_1 != null)
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_1)) }}</b>
                                                </small>
                                            @endif

                                            <div>{{ $alumnos->mes_1 ? ucfirst($alumnos->mes_1) : '' }}</div>
                                        </td>
                                        <!-- TUTOR 1-->
                                        <td>
                                            {{ $alumnos->oe_1 }}
                                        </td>
                                        <!-- DOCENTE 2-->
                                        <td class="cell-padding cell-justificada" style="padding-top: 6px !important;">
                                            <i class="bi bi-circle-fill"
                                            style="color: {{ (!empty($alumnos->lights[1]->semaforos[0]->fondo) && $alumnos->lights[1]->semaforos[0]->fondo !== '#')
                                                                ? $alumnos->lights[1]->semaforos[0]->fondo
                                                                : 'transparent' }}">
                                            </i>

                                            @if ($alumnos->entrega_2 != null)
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_2)) }}</b>
                                                </small>
                                            @endif

                                            <div>{{ $alumnos->mes_2 ? ucfirst($alumnos->mes_2) : '' }}</div>
                                        </td>
                                        <!-- TUTOR 2-->
                                        <td>
                                            {{ $alumnos->oe_2 }}
                                        </td>
                                        <!-- DOCENTE 3-->
                                        <td class="cell-padding cell-justificada" style="padding-top: 6px !important;">
                                            <i class="bi bi-circle-fill"
                                            style="color: {{ (!empty($alumnos->lights[2]->semaforos[0]->fondo) && $alumnos->lights[2]->semaforos[0]->fondo !== '#')
                                                                ? $alumnos->lights[2]->semaforos[0]->fondo
                                                                : 'transparent' }}">
                                            </i>

                                            @if ($alumnos->entrega_3 != null)
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_3)) }}</b>
                                                </small>
                                            @endif

                                            <div>{{ $alumnos->mes_3 ? ucfirst($alumnos->mes_3) : '' }}</div>
                                        </td>
                                        <!-- TUTOR 3-->
                                        <td>
                                            {{ $alumnos->oe_3 }}
                                        </td>
                                        <!-- DOCENTE 4-->
                                        <td class="cell-padding cell-justificada" style="padding-top: 6px !important;">
                                            <i class="bi bi-circle-fill"
                                            style="color: {{ (!empty($alumnos->lights[3]->semaforos[0]->fondo) && $alumnos->lights[3]->semaforos[0]->fondo !== '#')
                                                                ? $alumnos->lights[3]->semaforos[0]->fondo
                                                                : 'transparent' }}">
                                            </i>

                                            @if ($alumnos->entrega_4 != null)
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_4)) }}</b>
                                                </small>
                                            @endif

                                            <div>{{ $alumnos->mes_4 ? ucfirst($alumnos->mes_4) : '' }}</div>
                                        </td>
                                        <!-- TUTOR 4-->
                                        <td>
                                            {{ $alumnos->oe_4 }}
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@include('modal.alumno.add-alumno')
@endsection