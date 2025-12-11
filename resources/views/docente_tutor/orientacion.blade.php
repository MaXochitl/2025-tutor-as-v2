<div class="row row-tutor">
    <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">
        <div class="col-8">
            <div class="col-8 d-flex align-items-center gap-2">
                <a href="{{ route('alumnos-tutor.create') }} " type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        <path fill-rule="evenodd"
                            d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                </a> <span style="margin-left: 10px;">Nuevo alumno tutorado</span> <!-- Añadido un margen a la izquierda -->
                <br>

                <div class="col-8 d-flex align-items-center gap-3">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#jefeDepartamentoModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="25" fill="currentColor"
                            class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                        </svg>
                    </button> Reporte semestral
                </div>
            </div>
        </div>
        <br>

        <!-- Ordenar Semestres de tabla periodo_tutorado y Grupos de tabla alumnos -->
        @php
            // Ordenamos por semestre y luego por grupo
            $alumnosOrdenados = $alumnos_tutor->sortBy([
                ['semestre', 'asc'],
                ['alumno.grupo', 'asc']
            ]);

            // Agrupamos por semestre y grupo
            $grupos = $alumnosOrdenados->groupBy(function($alumno) {
                return $alumno->semestre . '-' . $alumno->alumno->grupo;
            });
        @endphp

        @foreach ($grupos as $grupoKey => $alumnosGrupo)
            @php
                $partes = explode('-', $grupoKey);
                $semestre = $partes[0];
                $grupo = $partes[1];
                $sgActual = $semestre . '-' . $grupo;   
            @endphp

            <!--A. comparar arreglo sgActual de semestregrupos asignados al tutor con los que se a asignado el el tutor-->
            @if(!in_array($sgActual, $sgAsignados))
                <h5 class="mt-3 mb-4 text-danger">Semestre: {{ $semestre }} - Grupo: {{ $grupo }} (No asignado)</h5>
            @else
                <h5 class="mt-3 mb-4">Semestre: {{ $semestre }} - Grupo: {{ $grupo }}</h5>
            @endif

        <div class="table-responsive pb-5">
            <table class="table text-start table-striped borde-externo" style="font-size: 12px"> <!--texto alineado a la izq-->
                <thead>
                    <tr>
                        <!--th scope="col">SG</th> //test-->
                        <th class="title-table" scope="col">N° CONTROL</th>
                        <th class="title-table" scope="col">NOMBRE COMPLETO</th>
                        <th class="title-table" scope="col">TELEFONO</th>
                        <th class="text-center" scope="col">MES 1</th>
                        <th class="text-center" scope="col">SEGUIMIENTO O.E. </th>
                        <th class="text-center" scope="col">MES 2</th>
                        <th class="text-center" scope="col">SEGUIMIENTO O.E. </th>
                        <th class="text-center" scope="col">MES 3</th>
                        <th class="text-center" scope="col">SEGUIMIENTO O.E. </th>
                        <th class="text-center" scope="col">MES 4</th>
                        <th class="text-center" scope="col">SEGUIMIENTO O.E. </th>
                        <th scope="col">RESULTADOS</th>
                        <th scope="col">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($alumnosGrupo as $alumnos)
                        <tr>

                            <!--<td>{{ $alumnos->semestre }}{{ $alumnos->alumno->grupo}}</td> test-->
                            <td style="background: {{ $alumnos->semaforo->fondo }} ">
                                <p>{{ $alumnos->alumno->id }} </p>
                                {{ $alumnos->semaforo->nombre }}
                            </td>
                            <td>{{ $alumnos->alumno->nombre . ' ' . $alumnos->alumno->ap_paterno . ' ' . $alumnos->alumno->ap_materno }}
                            </td>
                            <td>
                                {{ $alumnos->alumno->telefono }}
                            </td>

                        <!--MES 1 btn seguim invicible-->
                        @if (($fecha_actual >= $inicio && $fecha_actual <= $mes_1) || $altera_entrega->mes_1)
                            <td class="casilla editable"
                                data-bs-toggle="modal"
                                data-bs-target="#month1Modal{{ $alumnos->id }}"
                                data-bs-toggle="tooltip"
                                title="Seguimiento 1"
                                style="min-width: 100px">
                                    <div style="height: 5px; background:{{ $alumnos->lights[0]->semaforos[0]->fondo }};"></div>
                                    <div>{{ ucfirst($alumnos->mes_1) }}</div>
                            </td>
                            @include('modal.meses.mes1')
                        @else
                            <td class="text-muted casilla bloqueada" data-bs-toggle="tooltip" title="Seguimiento 1 bloqueado" style="min-width: 100px">
                                <div style="height: 5px; background:{{ $alumnos->lights[0]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->mes_1) }}</div>
                            </td>
                        @endif

                            <td style="min-width: 100px">
                                <div>
                                    {{ ucfirst($alumnos->oe_1) }}
                                </div>
                            </td>

                        <!--MES 2 btn seguim invicible-->
                        @if (($fecha_actual >= $mes_1 && $fecha_actual <= $mes_2) || $altera_entrega->mes_2)
                            <td class="casilla editable"
                                data-bs-toggle="modal"
                                data-bs-target="#month2Modal{{ $alumnos->id }}"
                                data-bs-toggle="tooltip"
                                title="Seguimiento 2" style="min-width: 100px">
                                <div style="height: 5px; background:{{ $alumnos->lights[1]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->mes_2) }}</div>
                            </td>
                            @include('modal.meses.mes2')
                        @else
                            <td class="text-muted casilla bloqueada" data-bs-toggle="tooltip" title="Seguimiento 2 bloqueado" style="min-width: 100px">
                                <div style="height: 5px; background:{{ $alumnos->lights[1]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->mes_2) }}</div>
                            </td>
                        @endif
                            <td style="min-width: 100px">
                                <div>
                                    {{ ucfirst($alumnos->oe_2) }}
                                </div>
                            </td>

                        <!--MES 3 btn seguim invicible-->
                        @if (($fecha_actual >= $mes_2 && $fecha_actual <= $mes_3) || $altera_entrega->mes_3)
                            <td class="casilla editable"
                                data-bs-toggle="modal"
                                data-bs-target="#month3Modal{{ $alumnos->id }}"
                                data-bs-toggle="tooltip"
                                title="Seguimiento 3"
                                style="min-width: 100px">
                                <div style="height: 5px; background:{{ $alumnos->lights[2]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->mes_3) }}</div>
                            </td>
                            @include('modal.meses.mes3')
                        @else
                            <td class="text-muted casilla bloqueada" data-bs-toggle="tooltip" title="Seguimiento 3 bloqueado" style="min-width: 100px">
                                <div style="height: 5px; background:{{ $alumnos->lights[2]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->mes_3) }}</div>
                            </td>
                        @endif

                            <td style="min-width: 100px">
                                {{ ucfirst($alumnos->oe_3) }}
                            </td>

                        <!--MES 4 btn seguim invicible-->
                        @if (($fecha_actual >= $mes_3 && $fecha_actual <= $mes_4) || $altera_entrega->mes_4)
                            <td class="casilla editable"
                                data-bs-toggle="modal"
                                data-bs-target="#month4Modal{{ $alumnos->id }}"
                                data-bs-toggle="tooltip"
                                title="Seguimiento 4"
                                style="min-width: 100px">
                                <div style="height: 5px; background:{{ $alumnos->lights[3]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->mes_4) }}</div>
                            </td>
                            @include('modal.meses.mes4')
                        @else
                            <td class="text-muted casilla bloqueada" data-bs-toggle="tooltip" title="Seguimiento 4 bloqueado" style="min-width: 100px">
                                <div style="height: 5px; background:{{ $alumnos->lights[3]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->mes_4) }}</div>
                            </td>
                        @endif

                            <td style="min-width: 100px">
                                <div>
                                    {{ ucfirst($alumnos->oe_4) }}
                                </div>
                            </td>

                        <!--RF con casilla-->
                        @if (($fecha_actual >= $mes_4 && $fecha_actual <= $entrega_final) || $altera_entrega->mes_5)
                            <td class="casilla-materias text-center" 
                                data-bs-toggle="tooltip" 
                                title="Reporte Final"
                                onclick="window.location='{{ route('reporte.show', $alumnos->id) }}'"
                                style="min-width: 100px">
                                <div style="height: 5px; background:{{ $alumnos->lights[4]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->reporte_final) }}</div>
                            </td>
                        @else
                            <td class="text-muted casilla bloqueada" data-bs-toggle="tooltip" title="Reporte final bloqueado" style="min-width: 100px">
                                <div style="height: 5px; background:{{ $alumnos->lights[4]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->reporte_final) }}</div>
                            </td>
                        @endif
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                        Opciones
                                    </button>
                                    <ul class="dropdown-menu mini-dropdown">
                                        <li>
                                            <button type="button"
                                                    class="dropdown-item text-primary actualizar-alumno-btn"
                                                    data-id="{{ $alumnos->id }}"
                                                    data-alumno-id="{{ $alumnos->alumno->id }}"
                                                    data-semestre="{{ $alumnos->semestre }}"
                                                    data-grupo="{{ $alumnos->alumno->grupo }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#updateAlumnoModal">
                                                    Actualizar
                                            </button>
                                        </li>
                                        <li>
                                            <form action="{{ route('alumnos-tutor.destroy', $alumnos->id) }}"
                                                method="POST"
                                                class="formulario-eliminar">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="dropdown-item text-danger">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>

    <!-- Modal Jefe de Carrera -->
    <div class="modal fade" id="jefeDepartamentoModal" tabindex="-1"
        aria-labelledby="jefeDepartamentoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('reporte.pdf', ['id' => $tutor->id]) }}"
                    method="GET" target="_blank">

                    <div class="modal-header">
                        <h5 class="modal-title" id="jefeDepartamentoModalLabel">Generar Reporte</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="jefe_departamento" class="form-label">
                                Escriba el nombre del jefe de division:
                            </label>
                            <input type="text" name="jefe_departamento" id="jefe_departamento"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Generar PDF</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@include("modal.alumno.add-alumno")
@include("modal.alumno.update-alumno")

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('existe_alumno') == 'no')
<script>
    Swal.fire({
        icon: 'error',
        title: 'Alumno no encontrado',
        text: 'Verifique el número de control o regístrelo en Alumnos',
        confirmButtonText: 'Aceptar'
    });
</script>
@endif

@if (session('hay_alumnos') == 'si')
<script>
    Swal.fire({
        icon: 'error',
        title: 'Alumno ya existe',
        text: 'Ya esta registrado como tutorado!',
        confirmButtonText: 'Aceptar'
    });
</script>
@endif

<style>
    .mini-dropdown {
        font-size: 13px !important;   /* letras pequeñas */
        padding: 4px !important;      /* menos espacio */
        min-width: 120px !important;  /* menú más pequeño */
    }

    .mini-dropdown .dropdown-item {
        padding: 4px 8px !important;  /* botones más compactos */
    }
</style>
