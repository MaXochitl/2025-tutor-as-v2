<div class="row row-tutor">
    <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">
        Lista de alumnos canalizados por los docentes que le imparten clases

        <div class="overflow-scroll">
            <br>
            <table class="table text-start table-striped" style="font-size: 12px">
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
                        $tutor_id = Auth::user()->tutor->id;


                    @endphp
                    @if ($tutorado != null)
                        @foreach ($docente_alumno as $alumnos)
                            @if (in_array(strtolower((string) $alumnos->alumno_id), $tutorado))
                                <tr>
                                    <th scope="row">
                                        {{ $contador++ }}
                                    </th>
                                    <td style="background: {{ $alumnos->semaforo->fondo }} ">
                                        <p>{{ $alumnos->alumno->id }} </p>
                                    </td>
                                    <td>{{ $alumnos->alumno->nombre . ' ' . $alumnos->alumno->ap_paterno . ' ' . $alumnos->alumno->ap_materno }}
                                    </td>
                                    <td>
                                        {{ $alumnos->alumno->telefono }}
                                    </td>

                                    <!--DOCENTE 1-->
                                    <td class="p-0 cell-padding cell-justificada" style="padding-top: 6px !important; min-width: 100px">
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

                                    {{-- Tutor 1 --}}
                                    @if (($fecha_actual >= $inicio && $fecha_actual <= $mes_1) || $altera_entrega->mes_1)
                                        <td class="casilla editable"
                                            data-bs-toggle="modal"
                                            data-bs-target="#oe1Modal{{ $alumnos->id }}"
                                            data-bs-toggle="tooltip"
                                            title="Seguimiento 1"
                                            style="min-width: 100px">
                                            {{ ucfirst($alumnos->oe_1) }}
                                        </td>
                                        @include('modal.orientacion.mes1')
                                    @else
                                        <td class="text-muted"
                                            data-bs-toggle="tooltip"
                                            title="Seguimiento 1 bloqueado"
                                            style="min-width: 100px">
                                            {{ ucfirst($alumnos->oe_1) }}
                                        </td>
                                    @endif

                                    <!--DOCENTE 2-->
                                    <td class="p-0 cell-padding cell-justificada" style="padding-top: 6px !important; min-width: 100px">
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

                                    {{-- Tutor 2 --}}
                                    @if (($fecha_actual >= $mes_1 && $fecha_actual <= $mes_2) || $altera_entrega->mes_2)
                                        <td class="casilla editable"
                                            data-bs-toggle="modal"
                                            data-bs-target="#oe2Modal{{ $alumnos->id }}"
                                            data-bs-toggle="tooltip"
                                            title="Seguimiento 2"
                                            style="min-width: 100px">
                                            {{ ucfirst($alumnos->oe_2) }}
                                        </td>
                                        @include('modal.orientacion.mes2')
                                    @else
                                        <td class="text-muted"
                                            data-bs-toggle="tooltip"
                                            title="Seguimiento 2 bloqueado"
                                            style="min-width: 100px">
                                            {{ ucfirst($alumnos->oe_2) }}
                                        </td>
                                    @endif

                                    <!--DOCENTE 3-->
                                    <td class="p-0 cell-padding cell-justificada" style="padding-top: 6px !important; min-width: 100px">
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

                                    {{-- Tutor 3 --}}
                                    @if (($fecha_actual >= $mes_2 && $fecha_actual <= $mes_3) || $altera_entrega->mes_3)
                                        <td class="casilla editable"
                                            data-bs-toggle="modal"
                                            data-bs-target="#oe3Modal{{ $alumnos->id }}"
                                            data-bs-toggle="tooltip"
                                            title="Seguimiento 3"
                                            style="min-width: 100px">
                                            {{ ucfirst($alumnos->oe_3) }}
                                        </td>
                                        @include('modal.orientacion.mes3')
                                    @else
                                        <td class="text-muted"
                                            data-bs-toggle="tooltip"
                                            title="Seguimiento 3 bloqueado"
                                            style="min-width: 100px">
                                            {{ ucfirst($alumnos->oe_3) }}
                                        </td>
                                    @endif

                                    <!--DOCENTE 4-->
                                    <td class="p-0 cell-padding cell-justificada" style="padding-top: 6px !important; min-width: 100px">
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

                                    {{-- Tutor 4 --}}
                                    @if (($fecha_actual >= $mes_3 && $fecha_actual <= $mes_4) || $altera_entrega->mes_4)
                                        <td class="casilla editable"
                                            data-bs-toggle="modal"
                                            data-bs-target="#oe4Modal{{ $alumnos->id }}"
                                            data-bs-toggle="tooltip"
                                            title="Seguimiento 4"
                                            style="min-width: 100px">
                                            {{ ucfirst($alumnos->oe_4) }}
                                        </td>
                                        @include('modal.orientacion.mes4')
                                    @else
                                        <td class="text-muted"
                                            data-bs-toggle="tooltip"
                                            title="Seguimiento 4 bloqueado"
                                            style="min-width: 100px">
                                            {{ ucfirst($alumnos->oe_4) }}
                                        </td>
                                    @endif
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
<style>
    /* Justificar texto de las columnas de docente y respuesta */
    .col-justify {
        text-align: justify;
    }

    /* Espacio interno para que no se vea pegado al borde */
    .cell-padding {
        padding: 6px 10px !important;
    }
</style>