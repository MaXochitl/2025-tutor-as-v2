@if (count($alumnos_tutor) == 0) 
    <div class="alert alert-danger" style="margin-top: 20px"> No se encotraron registros!
    </div>
@else
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
                                {{ ucfirst($alumnos->mes_1) }}
                            </div>
                        </td>
                        <!-- OE 1-->
                        <td class="casilla editable" data-bs-toggle="modal" data-bs-target="#oe1Modal{{ $alumnos->id }}" title="Añadir respuesta (OE 1)" style="min-width: 80px;">
                            <div>
                                {{ ucfirst($alumnos->oe_1) }}
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
                                {{ ucfirst($alumnos->mes_2) }}
                            </div>
                        </td>
                        <!-- OE 2-->
                        <td class="casilla editable" data-bs-toggle="modal" data-bs-target="#oe2Modal{{ $alumnos->id }}" title="Añadir respuesta (OE 2)" style="min-width: 80px;">
                            <div>
                                {{ ucfirst($alumnos->oe_2) }}
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
                                {{ ucfirst($alumnos->mes_3) }}
                            </div>
                        </td>
                        <!-- OE 3-->
                        <td class="casilla editable" data-bs-toggle="modal" data-bs-target="#oe3Modal{{ $alumnos->id }}" title="Añadir respuesta (OE 3)" style="min-width: 80px;">
                            <div>
                                {{ ucfirst($alumnos->oe_3) }}
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
                                {{ ucfirst($alumnos->mes_4) }}
                            </div>
                        </td>
                        <!-- OE 4-->
                        <td class="casilla editable" data-bs-toggle="modal" data-bs-target="#oe4Modal{{ $alumnos->id }}" title="Añadir respuesta (OE 4)" style="min-width: 80px;">
                            <div>
                                {{ ucfirst($alumnos->oe_4) }}
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
                                {{ ucfirst($alumnos->reporte_final) }}
                            </div>
                        </td>
                        @include('modal.materia.resultado-materia')
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
@endif