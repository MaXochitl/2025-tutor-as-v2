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

        @if (count($alumnos_tutor) == 0)
            <div style="text-align: right; margin: 20px">

                @can('mes.tutor')
                    <button href="{{ route('alumnos-tutor.create') }} " type="button" class="btn btn-primary"
                        data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-calendar-plus-fill" viewBox="0 0 16 16">
                            <path
                                d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM8.5 8.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5a.5.5 0 0 1 1 0z" />
                        </svg>
                        Agregar
                    </button>
                @endcan

            </div>
            <div class="alert alert-danger">
                No se encotraron registros!
            </div>
        @else
            @php
                date_default_timezone_set('America/Mexico_City');

                $inicio = strtotime($periodo[0]->inicio);
                $fin = strtotime($periodo[0]->fin);
                $mes_1 = strtotime($periodo[0]->mes_1);
                $mes_2 = strtotime($periodo[0]->mes_2);
                $mes_3 = strtotime($periodo[0]->mes_3);
                $mes_4 = strtotime($periodo[0]->mes_4);
                $entrega_final = strtotime($periodo[0]->reporte_final);
                $fecha_actual = strtotime(date('Y-m-d', time()));

            @endphp

            <div class="row img-font-all"
                style="border-radius: 10px;margin-top: 30px;background-image: url({{ $alumnos_tutor[0]->tutor->carrera->fondo }});">
                <div class="col-5" style="border-radius: 10px; background: white; margin: 5px">
                    <p class="head-alumnos-tutor"><b>Nombre Tutor de grupo: </b>
                        {{ $alumnos_tutor[0]->tutor->nombre . ' ' . $alumnos_tutor[0]->tutor->ap_paterno . ' ' . $alumnos_tutor[0]->tutor->ap_materno }}
                    </p>
                    <p class="head-alumnos-tutor"><b>Carrera: </b> {{ $alumnos_tutor[0]->tutor->carrera->nombre_carrera }}
                    </p>

                    @if ($asigno != 0)
                        <p class="head-alumnos-tutor"><b>Semetre:</b>
                            {{ $asignado[0]->semestre }} </p>
                        <p class="head-alumnos-tutor"><b>Grupo:</b> {{ $asignado[0]->grupo }} </p>
                    @else
                        <div class="alert alert-danger">
                            No se ha asignado grupo
                        </div>
                    @endif

                    <p class="head-alumnos-tutor"><b>Telefono:</b> {{ $alumnos_tutor[0]->tutor->telefono }} </p>

                    @php
                        $periodo_inicio = date('d/m/Y', strtotime($alumnos_tutor[0]->periodo->inicio));
                        $periodo_fin = date('d/m/Y', strtotime($alumnos_tutor[0]->periodo->fin));
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
                <div class="container m-3">
                    <div class="row justify-content-end">
                        <div class="col-md-6 offset-md-3">
                            <form class="input-group" method="POST"
                                action="{{ route('searchAluTutor', $alumnos_tutor[0]->tutor->id) }} ">
                                @csrf
                                <input name="search_tutor" type="text" class="form-control" placeholder="Bucar"
                                    aria-label="Buscar" id="search-input" value="{{ $palabra }} ">
                                <div class="input-group-append">
                                    <!-- Botón de buscar -->
                                    <button class="btn btn-primary" type="submit" id="search-btn">Buscar</button>
                                    <!-- Botón de borrar datos -->
                                    <a href="{{ route('alumnos-tutor.show', $alumnos_tutor[0]->tutor->id) }} "
                                        class="btn btn-danger" type="button" id="clear-btn">Borrar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!--  _________________________________  fin de la barra de busqueda-->


                <table class="table text-center table-striped" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="title-table" scope="col">N° CONTROL</th>
                            <th class="title-table" scope="col">NOMBRE COMPLETO</th>
                            <th class="title-table" scope="col">TELEFONO</th>
                            <th scope="col">MES<br>1</th>
                            <th scope="col">O.E.<br>1</th>
                            <th scope="col">MES<br>2</th>
                            <th scope="col">O.E.<br>2</th>
                            <th scope="col">MES<br>3</th>
                            <th scope="col">O.E.<br>3</th>
                            <th scope="col">MES<br>4</th>
                            <th scope="col">O.E.<br>4</th>
                            <th scope="col">RESULTADOS</th>
                            @can('solo.admin')
                                <th scope="col">OPCIONES</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumnos_tutor as $alumnos)
                            <tr>
                                <td style="background: {{ $alumnos->semaforo->fondo }} ">
                                    <p>{{ $alumnos->alumno->id }} </p>
                                </td>

                                <td>{{ $alumnos->alumno->nombre . ' ' . $alumnos->alumno->ap_paterno . ' ' . $alumnos->alumno->ap_paterno }}
                                </td>
                                <td>
                                    {{ $alumnos->alumno->telefono }}
                                </td>

                                <td class="p-0">

                                    <div class="d-grid gap-2" style="padding: 0%">
                                        <div
                                            style="pading: 0; height: 5px; background:{{ $alumnos->lights[0]->semaforos[0]->fondo }}; ">
                                        </div>
                                        <div>
                                            {{ $alumnos->mes_1 }}
                                        </div>

                                        @if ($alumnos->entrega_1 != null)
                                            <b>
                                                @php
                                                    echo date('d/m/Y', strtotime($alumnos->entrega_1));
                                                @endphp
                                            </b>
                                        @endif

                                    </div>
                                </td>

                                <td class="p-0 align-bottom">
                                    <div>
                                        {{ $alumnos->oe_1 }}
                                    </div>
                                    @can('solo.admin')
                                        <div class="d-grid gap-2 align-bottom">
                                            <a href="" type="button" class="btn btn-primary seg" data-bs-toggle="modal"
                                                data-bs-target="#oe1Modal{{ $alumnos->id }}" data-bs-whatever="@mdo">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                </svg>
                                            </a>
                                        </div>


                                        @include('modal.orientacion.mes1')
                                    @endcan

                                </td>

                                <td class="p-0">
                                    <div style="height: 5px; background:{{ $alumnos->lights[1]->semaforos[0]->fondo }}; ">
                                    </div>
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

                                <td class="p-0 align-bottom">

                                    <div>
                                        {{ $alumnos->oe_2 }}
                                    </div>
                                    @can('solo.admin')
                                        <div class="d-grid gap-2 align-bottom">
                                            <a href="" type="button" class="btn btn-primary seg"
                                                data-bs-toggle="modal" data-bs-target="#oe2Modal{{ $alumnos->id }}"
                                                data-bs-whatever="@mdo">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                </svg>
                                            </a>
                                        </div>
                                        @include('modal.orientacion.mes2')
                                    @endcan
                                </td>

                                <td class="p-0">
                                    <div style="height: 5px; background:{{ $alumnos->lights[2]->semaforos[0]->fondo }}; ">
                                    </div>
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

                                <td class="p-0 align-bottom">
                                    <div>
                                        {{ $alumnos->oe_3 }}
                                    </div>
                                    @can('solo.admin')
                                        <div class="d-grid gap-2 align-bottom">
                                            <a href="" type="button" class="btn btn-primary seg"
                                                data-bs-toggle="modal" data-bs-target="#oe3Modal{{ $alumnos->id }}"
                                                data-bs-whatever="@mdo">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                </svg>
                                            </a>
                                        </div>
                                        @include('modal.orientacion.mes3')
                                    @endcan

                                </td>

                                <td class="p-0">
                                    <div style="height: 5px; background:{{ $alumnos->lights[3]->semaforos[0]->fondo }}; ">
                                    </div>
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

                                <td class="p-0 align-bottom">
                                    <div>
                                        {{ $alumnos->oe_4 }}
                                    </div>

                                    @can('solo.admin')
                                        <div class="d-grid gap-2">
                                            <a href="" type="button" class="btn btn-primary seg"
                                                data-bs-toggle="modal" data-bs-target="#oe4Modal{{ $alumnos->id }}"
                                                data-bs-whatever="@mdo">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                </svg>
                                            </a>
                                        </div>
                                        @include('modal.orientacion.mes4')
                                    @endcan

                                </td>

                                <td class="p-0 align-bottom">
                                    <div>
                                        {{ $alumnos->reporte_final }}
                                    </div>

                                    <div class="d-grid gap-2">
                                        <a href="" type="button" class="btn btn-primary seg"
                                            data-bs-toggle="modal" data-bs-target="#endMatter{{ $alumnos->id }}"
                                            data-bs-whatever="@mdo">
                                            Materias
                                        </a>

                                    </div>
                                    @include('modal.materia.resultado-materia')
                                </td>
                                <td>

                                    @can('solo.admin')
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
            </div>
            {{ $alumnos_tutor->links('pagination::bootstrap-4') }}

            <div class="btn-regresar">
                @can('mes.admin')
                    <a class="btn btn-secondary" href="{{ route('tutor.show', $alumnos_tutor[0]->tutor->carrera->id) }} ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40   " fill="currentColor"
                            class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                        </svg>
                        Regresar

                    </a>
                @endcan

            </div>
        </div>
    </div>
    @endif
    @include('modal.alumno.add-alumno')

@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Elimado!',
                'Tu archivo ha sido eliminado.',
                'success'
            )
        </script>
    @endif

    <script>
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault();


            Swal.fire({
                title: 'Estas Seguro de eliminar?',
                text: "El alumno se eliminara definitivamente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })
        });
    </script>
@endsection
