@extends('master.master')
@section('structure-content')

<div class="container">

    @if (count($alumnos_tutor) == 0)

        <div class="alert alert-danger mt-4">
            No se encontraron registros de alumnos reportados!
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

        <!-- Botón regresar -->
        <div class="text-end my-3">
            <a href="{{ route('tutor.show', $alumnos_tutor[0]->tutor->carrera->id) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                    class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                </svg>
            </a>
        </div>
            
        <!-- Título centrado arriba del docente -->
        <h2 class="text-center mt-3 mb-4">ALUMNOS CANALIZADOS POR EL DOCENTE</h2>

        <!-- Tarjeta del docente -->
        <div class="row img-font-all"
            style="border-radius:10px; background-image:url({{ $alumnos_tutor[0]->tutor->carrera->fondo }}); padding:0; margin:0;">

            <div class="col-12 bg-white p-2" style="border-radius:10px;">
                <p class="m-0"><b>Nombre del Docente:</b>
                    {{ $alumnos_tutor[0]->tutor->nombre }}
                    {{ $alumnos_tutor[0]->tutor->ap_paterno }}
                    {{ $alumnos_tutor[0]->tutor->ap_materno }}
                </p>

                <p class="m-0"><b>Carrera:</b>
                    {{ $alumnos_tutor[0]->tutor->carrera->nombre_carrera }}
                </p>

                <p class="m-0"><b>Teléfono:</b>
                    {{ $alumnos_tutor[0]->tutor->telefono }}
                </p>

                @php
                    $periodo_inicio = date('d/m/Y', strtotime($periodo->inicio));
                    $periodo_fin = date('d/m/Y', strtotime($periodo->fin));
                @endphp

                <p class="m-0"><b>Periodo:</b>
                    {{ $periodo_inicio }} - {{ $periodo_fin }}
                </p>
            </div>
        </div>

</div>

<!-- Contenido principal -->
<div class="row row-tutor">
    <div class="overflow-scroll">

        <div class="col d-flex flex-column p-4">

            <!-- Barra de búsqueda -->
            <div class="container mb-4">
                <div class="row justify-content-end">
                    <div class="col-md-6 offset-md-3">
                        <form class="input-group" method="POST"
                            action="{{ route('searchAluDocente', $alumnos_tutor[0]->tutor->id) }}">
                            @csrf

                            <input name="search_tutor" type="text" class="form-control"
                                placeholder="Nombre o número de control"
                                value="{{ $palabra }}">

                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Buscar</button>
                                <a href="{{ route('alumnos-docente.show', $alumnos_tutor[0]->tutor->id) }}"
                                    class="btn btn-danger">Borrar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabla -->
            <table class="table table-bordered table-striped text-start" style="font-size: 12px">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">N° CONTROL</th>
                        <th scope="col">NOMBRE COMPLETO</th>
                        <th scope="col">TELÉFONO</th>

                        <th class="text-center">DOCENTE<br>1</th>
                        <th class="text-center">RESPUESTA DEL TUTOR<br>1</th>

                        <th class="text-center">DOCENTE<br>2</th>
                        <th class="text-center">RESPUESTA DEL TUTOR<br>2</th>

                        <th class="text-center">DOCENTE<br>3</th>
                        <th class="text-center">RESPUESTA DEL TUTOR<br>3</th>

                        <th class="text-center">DOCENTE<br>4</th>
                        <th class="text-center">RESPUESTA DEL TUTOR<br>4</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $contador = 1;
                        $tutor_id = $alumnos_tutor[0]->tutor->id ?? null;
                    @endphp

                    @foreach ($alumnos_tutor as $alumnos)
                        <tr>
                            <th scope="row">{{ $contador++ }}</th>
                            <td style="background: {{ $alumnos->semaforo->fondo }}">
                                <p>{{ $alumnos->alumno->id }}</p>
                            </td>

                            <td>
                                {{ $alumnos->alumno->nombre . ' ' . $alumnos->alumno->ap_paterno . ' ' . $alumnos->alumno->ap_materno }}
                            </td>

                            <td>{{ $alumnos->alumno->telefono }}</td>

                            <!-- DOCENTE 1 -->
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

                            <!-- RESPUESTA 1 -->
                            <td class="cell-padding cell-justificada">
                                <div>{{ $alumnos->oe_1 ? ucfirst($alumnos->oe_1) : '' }}</div>
                            </td>

                            <!-- DOCENTE 2 -->
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

                            <!-- RESPUESTA 2 -->
                            <td class="cell-padding cell-justificada">
                                <div>{{ $alumnos->oe_2 ? ucfirst($alumnos->oe_2) : '' }}</div>
                            </td>

                            <!-- DOCENTE 3 -->
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

                            <!-- RESPUESTA 3 -->
                            <td class="cell-padding cell-justificada">
                                <div>{{ $alumnos->oe_3 ? ucfirst($alumnos->oe_3) : '' }}</div>
                            </td>

                            <!-- DOCENTE 4 -->
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

                            <!-- RESPUESTA 4 -->
                            <td class="cell-padding cell-justificada">
                                <div>{{ $alumnos->oe_4 ? ucfirst($alumnos->oe_4) : '' }}</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            {{ $alumnos_tutor->links('pagination::bootstrap-4') }}

        </div>
    </div>
</div>

@endif

@endsection



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
