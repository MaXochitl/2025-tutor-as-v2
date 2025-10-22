<div class="row row-tutor">
    <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">
        Lista de alumnos canalizados por los docentes que le imparten clases
        @if (session('hay_alumnos') == 'si')
            <div class="alert alert-danger">
                Ya esta registrado!
            </div>
        @endif

        <div class="overflow-scroll">
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
                        <th scope="col">DOCENTE QUE CANALIZO</th>
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
                                    <td>
                                        <div>
                                            {{ $alumnos->mes_1 }}
                                        </div>
                                        <div class="d-grid gap-2">
                                            @if ($alumnos->entrega_1 != null)
                                                <b>
                                                    @php
                                                        echo date('d/m/Y', strtotime($alumnos->entrega_1));
                                                    @endphp
                                                </b>
                                            @endif
                                        </div>
                                    </td>
                                    {{-- Tutor 1 --}}
                                    <td>
                                        <div>
                                            {{ $alumnos->oe_1 }}
                                        </div>
                                        @if ($fecha_actual >= $inicio && $fecha_actual <= $mes_1 || $altera_entrega->mes_1)
                                            <div class="d-grid gap-2">

                                                <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#oe1Modal{{ $alumnos->id }}"
                                                    data-bs-whatever="@mdo">
                                                    Seguimiento
                                                </a>
                                            </div>
                                            @include('modal.orientacion.mes1')
                                        @endif
                                    </td>

                                    <td>
                                        <div>
                                            {{ $alumnos->mes_2 }}
                                        </div>

                                        @if ($alumnos->entrega_2 != null)
                                            <b>
                                                @php
                                                    echo date('d/m/Y', strtotime($alumnos->entrega_2));
                                                @endphp
                                            </b>
                                        @endif
                                    </td>

                                    {{-- Tutor 2 --}}
                                    <td>
                                        <div>
                                            {{ $alumnos->oe_2 }}
                                        </div>
                                        @if (($fecha_actual >= $mes_1 && $fecha_actual <= $mes_2) || $altera_entrega->mes_2)
                                            <div class="d-grid gap-2">
                                                <a href="#" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#oe2Modal{{ $alumnos->id }}" data-bs-whatever="@mdo">
                                                    Seguimiento
                                                </a>
                                            </div>
                                            @include('modal.orientacion.mes2')
                                        @endif
                                    </td>


                                    <td>
                                        <div>
                                            {{ $alumnos->mes_3 }}
                                        </div>
                                        @if ($alumnos->entrega_3 != null)
                                            <b>
                                                @php
                                                    echo date('d/m/Y', strtotime($alumnos->entrega_3));
                                                @endphp
                                            </b>
                                        @endif
                                    </td>

                                    {{-- Tutor 3 --}}
                                    <td>
                                        <div>
                                            {{ $alumnos->oe_3 }}
                                        </div>
                                        @if (($fecha_actual >= $mes_2 && $fecha_actual <= $mes_3) || $altera_entrega->mes_3)
                                            <div class="d-grid gap-2">
                                                <a href="#" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#oe3Modal{{ $alumnos->id }}" data-bs-whatever="@mdo">
                                                    Seguimiento
                                                </a>
                                            </div>
                                            @include('modal.orientacion.mes3')
                                        @endif
                                    </td>


                                    <td>
                                        <div>
                                            {{ $alumnos->mes_4 }}
                                        </div>

                                        @if ($alumnos->entrega_4 != null)
                                            <b>
                                                @php
                                                    echo date('d/m/Y', strtotime($alumnos->entrega_4));
                                                @endphp
                                            </b>
                                        @endif
                                    </td>

                                    {{-- Tutor 4 --}}
                                    <td>
                                        <div>
                                            {{ $alumnos->oe_4 }}
                                        </div>
                                        @if (($fecha_actual >= $mes_3 && $fecha_actual <= $mes_4) || $altera_entrega->mes_4)
                                            <div class="d-grid gap-2">
                                                <a href="#" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#oe4Modal{{ $alumnos->id }}" data-bs-whatever="@mdo">
                                                    Seguimiento
                                                </a>
                                            </div>
                                            @include('modal.orientacion.mes4')
                                        @endif
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
