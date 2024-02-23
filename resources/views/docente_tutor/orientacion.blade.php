<div class="row row-tutor">
    <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">
        <div class="col-8">
            <a href="{{ route('alumnos-tutor.create') }} " type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                    class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    <path fill-rule="evenodd"
                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                </svg>
            </a> Agregar alumnos Tutorados!
            <br>

        </div>

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
        <div class="overflow-scroll">
            <table class="table text-center table-striped" style="font-size: 12px">
                <thead>
                    <tr>
                        <th class="title-table" scope="col">N° CONTROL</th>
                        <th class="title-table" scope="col">NOMBRE COMPLETO</th>
                        <th class="title-table" scope="col">TELEFONO</th>
                        <th scope="col">MES 1</th>
                        <th scope="col">SEGUIMIENTO O.E. </th>
                        <th scope="col">MES 2</th>
                        <th scope="col">SEGUIMIENTO O.E. </th>
                        <th scope="col">MES 3</th>
                        <th scope="col">SEGUIMIENTO O.E. </th>
                        <th scope="col">MES 4</th>
                        <th scope="col">SEGUIMIENTO O.E. </th>
                        <th scope="col">RESULTADOS</th>
                        <th scope="col">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $contador = 1;

                    @endphp
                    @foreach ($alumnos_tutor as $alumnos)
                        <tr>

                            <td style="background: {{ $alumnos->semaforo->fondo }} ">
                                <p>{{ $alumnos->alumno->id }} </p>
                                {{ $alumnos->semaforo->nombre }}
                            </td>
                            <td>{{ $alumnos->alumno->nombre . ' ' . $alumnos->alumno->ap_paterno . ' ' . $alumnos->alumno->ap_materno }}
                            </td>
                            <td>
                                {{ $alumnos->alumno->telefono }}
                            </td>
                            <td class="p-0">
                                <div
                                    style="pading: 0; height: 5px; background:{{ $alumnos->lights[0]->semaforos[0]->fondo }}; ">
                                </div>
                                <div>
                                    {{ $alumnos->mes_1 }}
                                    <br>
                                </div>
                                <div class="d-grid gap-2">
                                    @if (($fecha_actual >= $inicio && $fecha_actual <= $mes_1) || $altera_entrega->mes_1)
                                        <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#month1Modal{{ $alumnos->id }} "
                                            data-bs-id="{{ $alumnos->id }}">
                                            Seguimiento
                                        </a>
                                        @include('modal.meses.mes1')
                                    @endif
                                </div>
                            </td>

                            <td>
                                <div>
                                    {{ $alumnos->oe_1 }}
                                </div>
                            </td>

                            <td class="p-0">
                                <div style="height: 5px; background:{{ $alumnos->lights[1]->semaforos[0]->fondo }}; ">
                                <div>
                                    {{ $alumnos->mes_2 }}
                                    <br>
                                </div>
                                @if ($fecha_actual == $mes_2 || ($fecha_actual >= $mes_1 && $fecha_actual <= $mes_2) || $altera_entrega->mes_2)
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#month2Modal{{ $alumnos->id }}" data-bs-id="">
                                            Seguimiento
                                        </button>
                                    </div>
                                    @include('modal.meses.mes2')
                                @endif
                            </td>
                            <td>
                                <div>
                                    {{ $alumnos->oe_2 }}
                                </div>
                            </td>

                            <td class="p-0">
                                <div style="height: 5px; background:{{ $alumnos->lights[2]->semaforos[0]->fondo }}; ">
                                <div>
                                    {{ $alumnos->mes_3 }}
                                </div>
                                @if (($fecha_actual >= $mes_2 && $fecha_actual <= $mes_3) || $altera_entrega->mes_3)
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#month3Modal{{ $alumnos->id }} "
                                            data-bs-id="{{ $alumnos->id }}">
                                            Seguimiento
                                        </button>
                                    </div>
                                    @include('modal.meses.mes3')
                                @endif

                            </td>

                            <td>
                                <div>{{ $alumnos->oe_3 }}</div>
                            </td>

                            <td class="p-0">
                                <div style="height: 5px; background:{{ $alumnos->lights[3]->semaforos[0]->fondo }}; ">
                                <div>
                                    {{ $alumnos->mes_4 }}
                                </div>
                                @if (($fecha_actual >= $mes_3 && $fecha_actual <= $mes_4) || $altera_entrega->mes_4)
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#month4Modal{{ $alumnos->id }} "
                                            data-bs-id="{{ $alumnos->id }}">
                                            Seguimiento
                                        </button>
                                    </div>
                                    @include('modal.meses.mes4')
                                @endif

                            </td>

                            <td>
                                <div>
                                    {{ $alumnos->oe_4 }}
                                </div>
                            </td>

                            <td>
                                <div>
                                    {{ $alumnos->reporte_final }}
                                </div>
                                @if (($fecha_actual >= $mes_4 && $fecha_actual <= $entrega_final) || $altera_entrega->mes_5)
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('reporte.show', $alumnos->id) }} " type="button"
                                            class="btn btn-primary">
                                            Seguimiento
                                        </a>
                                    </div>
                                @endif
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
                                                <li><button type="submit" class="dropdown-item"
                                                        href="#">Eliminar</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
