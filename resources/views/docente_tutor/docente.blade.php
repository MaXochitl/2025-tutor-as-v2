<div class="row row-tutor">
    <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">

        <div class="col-5">
            <a href="{{ route('alumnos-tutor.create') }} " type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#add-alumno-2" data-bs-whatever="@mdo">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                    class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    <path fill-rule="evenodd"
                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                </svg>

            </a>
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
                    El alumno no esta registrado puedes registrarlo en la seccion Alumnos
                </div>
            @endif
            <table class="table text-center table-striped" style="font-size: 12px">
                <thead>
                    <tr>
                        <th class="title-table" scope="col">N°</th>
                        <th class="title-table" scope="col">N° CONTROL</th>
                        <th class="title-table" scope="col">NOMBRE COMPLETO</th>
                        <th class="title-table" scope="col">TELEFONO</th>
                        <th scope="col">DOCENTE<br>1</th>
                        <th scope="col">TUTOR<br>1</th>
                        <th scope="col">DOCENTE<br>2</th>
                        <th scope="col">TUTOR<br>2</th>
                        <th scope="col">DOCENTE<br>3</th>
                        <th scope="col">TUTOR<br>3</th>
                        <th scope="col">DOCENTE<br>4</th>
                        <th scope="col">TUTOR<br>4</th>
                        <th scope="col">RESULTADOS</th>
                        <th scope="col">TUTOR</th>
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
                                <td>{{ $alumnos->alumno->nombre . ' ' . $alumnos->alumno->ap_paterno . ' ' . $alumnos->alumno->ap_paterno }}
                                </td>
                                <td>
                                    {{ $alumnos->alumno->telefono }}
                                </td>
                                <td>
                                    <div>
                                        {{ $alumnos->mes_1 }}
                                    </div>
                                    <div class="d-grid gap-2">
                                        @if ($fecha_actual >= $inicio && $fecha_actual <= $mes_1)
                                            <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#month1Modal{{ $alumnos->id }} "
                                                data-bs-id="{{ $alumnos->id }}">
                                                Seguimiento
                                            </a>
                                            @include('modal.meses.mes1')
                                        @endif

                                        @can('show.date')
                                            @if ($alumnos->entrega_1 != null)
                                                <b>
                                                    @php
                                                        echo date('d/m/Y', strtotime($alumnos->entrega_1));
                                                    @endphp
                                                </b>
                                            @endif
                                        @endcan

                                    </div>
                                </td>

                                <td>
                                    <div>
                                        {{ $alumnos->oe_1 }}
                                    </div>
                                    @can('mes.admin', Model::class)
                                        <div class="d-grid gap-2">
                                            <a href="" type="button" class="btn btn-primary seg" data-bs-toggle="modal"
                                                data-bs-target="#oe1Modal{{ $alumnos->id }}" data-bs-whatever="@mdo">
                                                Seguimiento
                                            </a>
                                        </div>
                                        @include('modal.orientacion.mes1')
                                    @endcan

                                </td>

                                <td>
                                    <div>
                                        {{ $alumnos->mes_2 }}
                                    </div>
                                    @can('mes.tutor')
                                        @if ($fecha_actual == $mes_2 || ($fecha_actual >= $mes_1 && $fecha_actual <= $mes_2))
                                            <div class="d-grid gap-2">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#month2Modal{{ $alumnos->id }}" data-bs-id="">
                                                    Seguimiento
                                                </button>
                                            </div>
                                            @include('modal.meses.mes2')
                                        @endif
                                    @endcan
                                    @can('show.date')
                                        @if ($alumnos->entrega_2 != null)
                                            <b>
                                                @php
                                                    echo date('d/m/Y', strtotime($alumnos->entrega_2));
                                                @endphp
                                            </b>
                                        @endif
                                    @endcan
                                </td>
                                <td>
                                    <div>
                                        {{ $alumnos->oe_2 }}
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


                                <td>
                                    <div>
                                        {{ $alumnos->mes_3 }}
                                    </div>
                                    @can('mes.tutor')
                                        @if ($fecha_actual >= $mes_2 && $fecha_actual <= $mes_3)
                                            <div class="d-grid gap-2">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#month3Modal{{ $alumnos->id }} "
                                                    data-bs-id="{{ $alumnos->id }}">
                                                    Seguimiento
                                                </button>
                                            </div>
                                        @endif
                                        @include('modal.meses.mes3')
                                    @endcan

                                    @can('show.date')
                                        @if ($alumnos->entrega_3 != null)
                                            <b>
                                                @php
                                                    echo date('d/m/Y', strtotime($alumnos->entrega_3));
                                                @endphp
                                            </b>
                                        @endif
                                    @endcan


                                </td>


                                <td>
                                    <div>
                                        {{ $alumnos->oe_3 }}
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


                                <td>
                                    <div>
                                        {{ $alumnos->mes_4 }}
                                    </div>
                                    @can('mes.tutor')
                                        @if ($fecha_actual >= $mes_3 && $fecha_actual <= $mes_4)
                                            <div class="d-grid gap-2">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#month4Modal{{ $alumnos->id }} "
                                                    data-bs-id="{{ $alumnos->id }}">
                                                    Seguimiento
                                                </button>
                                            </div>
                                        @endif
                                        @include('modal.meses.mes4')
                                    @endcan
                                    @can('show.date')
                                        @if ($alumnos->entrega_4 != null)
                                            <b>
                                                @php
                                                    echo date('d/m/Y', strtotime($alumnos->entrega_4));
                                                @endphp
                                            </b>
                                        @endif
                                    @endcan
                                </td>


                                <td>
                                    <div>
                                        {{ $alumnos->oe_4 }}
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
                                        {{ $alumnos->reporte_final }}
                                    </div>
                                    @can('mes.tutor')
                                        @if ($fecha_actual >= $mes_4 && $fecha_actual <= $entrega_final)
                                            <div class="d-grid gap-2">
                                                <a href="{{ route('reporte.show', $alumnos->id) }} " type="button"
                                                    class="btn btn-primary">
                                                    Seguimiento
                                                </a>
                                            </div>
                                        @endif
                                    @endcan

                                    @can('mes.admin')
                                        <div class="d-grid gap-2">
                                            <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#endMatter{{ $alumnos->id }}" data-bs-whatever="@mdo">
                                                Materias
                                            </a>

                                        </div>
                                        @include('modal.materia.resultado-materia')
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
