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
            // ordenar por semestre y luego por grupo
            $alumnosOrdenados = $alumnos_tutor->sortBy([
                ['semestre', 'asc'],
                ['alumno.grupo', 'asc']
            ]);

            // agrupar por semestre y grupo
            $grupos = $alumnosOrdenados->groupBy(function($alumno) {
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
                                    {{ $mujeres }}</td>
                            </tr>

                            <tr>
                                <th scope="col">{{ 'Hombres:' }}</th>
                                <td>
                                    {{ $hombres }}</td>
                            </tr>

                            <tr>
                                <th scope="col">{{ 'Baja Temporal:' }}</th>
                                <td>
                                    {{ $temporal }}</td>
                            </tr>

                            <tr>
                                <th scope="col">{{ 'Baja:' }}</th>
                                <td>
                                    {{ $baja }}</td>
                            </tr>

                            <tr>
                                <th scope="col">{{ 'Verde:' }}</th>
                                <td>
                                    {{ $verde }}</td>
                            </tr>

                            <tr>
                                <th scope="col">{{ 'Amarillo:' }}</th>
                                <td>
                                    {{ $naranja }}</td>
                            </tr>

                            <tr>
                                <th scope="col">{{ 'Rojo:' }}</th>
                                <td>
                                    {{ $rojo }}</td>
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
            {{ $alumnos_tutor->links('pagination::bootstrap-4') }}

        </div>
    </div>
    @endif
    @include('modal.alumno.add-alumno')

@endsection