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
                        $tutor_id = $tutor->id ?? null;
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
                                        {{ $alumnos->oe_1 ? ucfirst($alumnos->oe_1) : '' }}
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
                                        {{ $alumnos->oe_2 ? ucfirst($alumnos->oe_2) : '' }}
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
                                        {{ $alumnos->oe_3 ? ucfirst($alumnos->oe_3) : '' }}
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
                                        {{ $alumnos->oe_4 ? ucfirst($alumnos->oe_4) : '' }}
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