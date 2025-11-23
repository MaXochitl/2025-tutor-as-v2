<div class="row row-tutor">
    <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">

        <div class="col-12 d-flex align-items-center gap-3"><!--HorizontalMax-flexbox para boton y gap para espacio -->
            <a href="{{ route('alumnos-tutor.create') }} " type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#add-alumno-2" data-bs-whatever="@mdo">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                    class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    <path fill-rule="evenodd"
                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                </svg>

            </a> Canalización  de alumnos que NO SON MIS TUTORADOS y presentan irregularidades en las materias que imparto
            <br>
        </div>

        <div class="overflow-scroll">
            @if (session('hay_alumnos') == 'si')
                <div class="alert alert-danger">
                    Ya esta registrado!
                </div>
            @endif

            @if (session('existe_alumno') == 'no')
                <div class="alert alert-danger">
                    Alumno no encontrado. Verifique el NC o regístrelo en "Alumnos".
                </div>
            @endif
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
                        <th scope="col">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $contador = 1;
                        $tutor_id = Auth::user()->tutor->id;

                    @endphp
                    @foreach ($docente_alumno as $alumnos)
                        @if ($alumnos->tutor_id == $tutor_id)
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
                                <!-- Docente 1 -->
                                @if (($fecha_actual >= $inicio && $fecha_actual <= $mes_1) || $altera_entrega->mes_1)
                                    <td class="casilla editable"
                                        data-bs-toggle="modal"
                                        data-bs-target="#month1Modal{{ $alumnos->id }}"
                                        data-bs-toggle="tooltip"
                                        title="Seguimiento 1">

                                        <i class="bi bi-circle-fill"
                                        style="color: {{ (!empty($alumnos->lights[0]->semaforos[0]->fondo) && $alumnos->lights[0]->semaforos[0]->fondo !== '#')
                                            ? $alumnos->lights[0]->semaforos[0]->fondo
                                            : 'transparent' }};">
                                        </i>
                                        {{ $alumnos->mes_1 ? ucfirst($alumnos->mes_1) : '' }}

                                        @can('show.date')
                                            @if ($alumnos->entrega_1)
                                                <br>
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_1)) }}</b>
                                                </small>
                                            @endif
                                        @endcan
                                    </td>

                                    @include('modal.meses.mes1')
                                @else
                                    <td class="p-0 text-muted"
                                        data-bs-toggle="tooltip"
                                        title="Seguimiento 1 bloqueado">
                                        <i class="bi bi-circle-fill"
                                        style="color: {{ (!empty($alumnos->lights[0]->semaforos[0]->fondo) && $alumnos->lights[0]->semaforos[0]->fondo !== '#')
                                            ? $alumnos->lights[0]->semaforos[0]->fondo
                                            : 'transparent' }};">
                                        </i>
                                        {{ $alumnos->mes_1 ? ucfirst($alumnos->mes_1) : '' }}

                                        @can('show.date')
                                            @if ($alumnos->entrega_1)
                                                <br>
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_1)) }}</b>
                                                </small>
                                            @endif
                                        @endcan
                                    </td>
                                @endif

                                <td>
                                    <div>
                                        {{ ucfirst($alumnos->oe_1) }}
                                    </div>
                                    @can('mes.admin', Model::class)
                                        <div class="d-grid gap-2">
                                            <a href="" type="button" class="btn btn-primary seg"
                                                data-bs-toggle="modal" data-bs-target="#oe1Modal{{ $alumnos->id }}"
                                                data-bs-whatever="@mdo">
                                                Seguimiento
                                            </a>
                                        </div>
                                        @include('modal.orientacion.mes1')
                                    @endcan
                                </td>

                                <!-- Docente 2 -->
                                @if (($fecha_actual >= $mes_1 && $fecha_actual <= $mes_2) || $altera_entrega->mes_2)
                                    <td class="casilla editable"
                                        data-bs-toggle="modal"
                                        data-bs-target="#month2Modal{{ $alumnos->id }}"
                                        data-bs-toggle="tooltip"
                                        title="Seguimiento 2">

                                        <i class="bi bi-circle-fill"
                                        style="color: {{ (!empty($alumnos->lights[1]->semaforos[0]->fondo) && $alumnos->lights[1]->semaforos[0]->fondo !== '#')
                                            ? $alumnos->lights[1]->semaforos[0]->fondo
                                            : 'transparent' }};">
                                        </i>
                                        {{ $alumnos->mes_2 ? ucfirst($alumnos->mes_2) : '' }}

                                        @can('show.date')
                                            @if ($alumnos->entrega_2)
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_2)) }}</b>
                                                </small>
                                            @endif
                                        @endcan
                                    </td>

                                    @include('modal.meses.mes2')
                                @else
                                    <td class="p-0 text-muted" data-bs-toggle="tooltip" title="Seguimiento 2 bloqueado">
                                        <i class="bi bi-circle-fill"
                                        style="color: {{ (!empty($alumnos->lights[1]->semaforos[0]->fondo) && $alumnos->lights[1]->semaforos[0]->fondo !== '#')
                                            ? $alumnos->lights[1]->semaforos[0]->fondo
                                            : 'transparent' }};">
                                        </i>
                                        {{ $alumnos->mes_2 ? ucfirst($alumnos->mes_2) : '' }}

                                        @can('show.date')
                                            @if ($alumnos->entrega_2)
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_2)) }}</b>
                                                </small>
                                            @endif
                                        @endcan
                                    </td>
                                @endif

                                <td>
                                    <div>
                                        {{ ucfirst($alumnos->oe_2) }}
                                    </div>
                                    @can('mes.admin')
                                        <div class="d-grid gap-2">
                                            <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#oe2Modal{{ $alumnos->id }}" data-bs-whatever="@mdo">
                                                Seguimiento
                                            </a>
                                        </div>
                                        @include('modal.orientacion.mes2')
                                    @endcan

                                </td>

                                <!-- Docente 3 -->
                                @if (($fecha_actual >= $mes_2 && $fecha_actual <= $mes_3) || $altera_entrega->mes_3)
                                    <td class="casilla editable"
                                        data-bs-toggle="modal"
                                        data-bs-target="#month3Modal{{ $alumnos->id }}"
                                        data-bs-toggle="tooltip"
                                        title="Seguimiento 3">

                                        <i class="bi bi-circle-fill"
                                        style="color: {{ (!empty($alumnos->lights[2]->semaforos[0]->fondo) && $alumnos->lights[2]->semaforos[0]->fondo !== '#')
                                            ? $alumnos->lights[2]->semaforos[0]->fondo
                                            : 'transparent' }};">
                                        </i>
                                        {{ $alumnos->mes_3 ? ucfirst($alumnos->mes_3) : '' }}}

                                        @can('show.date')
                                            @if ($alumnos->entrega_3)
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_3)) }}</b>
                                                </small>
                                            @endif
                                        @endcan
                                    </td>

                                    @include('modal.meses.mes3')
                                @else
                                    <td class="p-0 text-muted" data-bs-toggle="tooltip" title="Seguimiento 3 bloqueado">
                                        <i class="bi bi-circle-fill"
                                        style="color: {{ (!empty($alumnos->lights[2]->semaforos[0]->fondo) && $alumnos->lights[2]->semaforos[0]->fondo !== '#')
                                            ? $alumnos->lights[2]->semaforos[0]->fondo
                                            : 'transparent' }};">
                                        </i>
                                        {{ $alumnos->mes_3 ? ucfirst($alumnos->mes_3) : '' }}
                                        @can('show.date')
                                            @if ($alumnos->entrega_3)
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_3)) }}</b>
                                                </small>
                                            @endif
                                        @endcan
                                    </td>
                                @endif

                                <td>
                                    <div>
                                        {{ ucfirst($alumnos->oe_3) }}
                                    </div>
                                    @can('mes.admin', Model::class)
                                        <div class="d-grid gap-2">
                                            <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#oe3Modal{{ $alumnos->id }}" data-bs-whatever="@mdo">
                                                Seguimiento
                                            </a>
                                        </div>
                                        @include('modal.orientacion.mes3')
                                    @endcan


                                </td>

                                <!-- Docente 4 -->
                                @if (($fecha_actual >= $mes_3 && $fecha_actual <= $mes_4) || $altera_entrega->mes_4)
                                    <td class="casilla editable"
                                        data-bs-toggle="modal"
                                        data-bs-target="#month4Modal{{ $alumnos->id }}"
                                        data-bs-toggle="tooltip"
                                        title="Seguimiento 4">

                                        <i class="bi bi-circle-fill"
                                        style="color: {{ (!empty($alumnos->lights[3]->semaforos[0]->fondo) && $alumnos->lights[3]->semaforos[0]->fondo !== '#')
                                            ? $alumnos->lights[3]->semaforos[0]->fondo
                                            : 'transparent' }};">
                                        </i>
                                        {{ $alumnos->mes_4 ? ucfirst($alumnos->mes_4) : '' }}

                                        @can('show.date')
                                            @if ($alumnos->entrega_4)
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_4)) }}</b>
                                                </small>
                                            @endif
                                        @endcan
                                    </td>

                                    @include('modal.meses.mes4')
                                @else
                                    <td class="p-0 text-muted" data-bs-toggle="tooltip" title="Seguimiento 4 bloqueado">
                                        <i class="bi bi-circle-fill"
                                        style="color: {{ (!empty($alumnos->lights[3]->semaforos[0]->fondo) && $alumnos->lights[3]->semaforos[0]->fondo !== '#')
                                            ? $alumnos->lights[3]->semaforos[0]->fondo
                                            : 'transparent' }};">
                                        </i>
                                        {{ $alumnos->mes_4 ? ucfirst($alumnos->mes_4) : '' }}

                                        @can('show.date')
                                            @if ($alumnos->entrega_4)
                                                <small class="text-muted">
                                                    <b>{{ date('d/m/Y', strtotime($alumnos->entrega_4)) }}</b>
                                                </small>
                                            @endif
                                        @endcan
                                    </td>
                                @endif

                                <td>
                                    <div>
                                        {{ ucfirst($alumnos->oe_4) }}
                                    </div>
                                    @can('mes.admin')
                                        <div class="d-grid gap-2">
                                            <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#oe4Modal{{ $alumnos->id }}" data-bs-whatever="@mdo">
                                                Seguimiento
                                            </a>
                                        </div>
                                        @include('modal.orientacion.mes4')
                                    @endcan


                                </td>

                                <td>
                                    <div>
                                        <form action="{{ route('alumnos-tutor.destroy', $alumnos->id) }} "
                                            class="formulario-eliminar" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-danger dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Opciones
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @can('mes.tutor')
                                                        <li>
                                                            <button type="submit" class="dropdown-item"
                                                                href="#">Eliminar</button>
                                                        </li>
                                                    @endcan
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
