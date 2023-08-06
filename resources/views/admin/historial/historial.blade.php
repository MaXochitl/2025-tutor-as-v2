@extends('master.master')
@section('structure-content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    @php
        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_ALL, 'es_ES');
        $diassemana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'];
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    @endphp


    <div class="container">
        <div class="row text-center col-md-8 shadow-lg p-3 mb-5"
            style="margin: auto;margin-top: 5PX;border-radius: 10px; background: rgb(0, 130, 63); color: white">
            <h3>SEGUIMIENTOS ARCHIVADOS</h3>
        </div>
    </div>

    <div class="container ">
        <form action="{{ route('historial.store') }}" method="post">
            @csrf
            <div class="row shadow-lg p-3">
                <div class="col-6 col-md-3">
                    <label for="periodo">Selecciona un periodo</label>
                    <select name="periodo" class="form-select" aria-label="Default select example">
                        @if ($periodo_actual == 0)
                            @foreach ($periodos as $item)
                                @php
                                    $inicio = $meses[date('n', strtotime($item->inicio)) - 1] . '  ' . date('Y', strtotime($item->inicio));
                                    $fin = $meses[date('n', strtotime($item->fin)) - 1] . '  ' . date('Y', strtotime($item->fin));
                                @endphp
                                <option value="{{ $item->id }} ">
                                    {{ $inicio . ' - ' . $fin }}
                                </option>
                            @endforeach
                        @else
                            @foreach ($periodos as $item)
                                @php
                                    $inicio = $meses[date('n', strtotime($item->inicio)) - 1] . '  ' . date('Y', strtotime($item->inicio));
                                    $fin = $meses[date('n', strtotime($item->fin)) - 1] . '  ' . date('Y', strtotime($item->fin));
                                @endphp
                                <option @if ($periodo_actual == $item->id) {{ 'selected' }} @endif
                                    value="{{ $item->id }} ">
                                    {{ $inicio . ' - ' . $fin }}
                                </option>
                            @endforeach
                        @endif

                    </select>
                </div>
                <div class="col-6 col-md-5">
                    <label for="carrera">Selecciona una carrera</label>
                    <select name="carrera" class="form-select" aria-label="Default select example">
                        @if ($carrera_select == 0)
                            @foreach ($carreras as $item)
                                <option value="{{ $item->id }} ">{{ $item->nombre_carrera }}</option>
                            @endforeach
                        @else
                            @foreach ($carreras as $item)
                                <option @if ($carrera_select == $item->id) {{ 'selected' }} @endif
                                    value="{{ $item->id }} ">{{ $item->nombre_carrera }}
                                </option>
                            @endforeach
                        @endif

                    </select>
                </div>

                <div class="col-6 col-md-3 " style="margin-top: 21px">
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg></button>
                </div>
            </div>
        </form>
    </div>

    <div class="row row-tutor">

        <div class="table-responsive">
            @if ($historial->count() == 0)
                <div class="alert alert-danger" role="alert">
                    ups! No se encontraron registros!
                </div>
            @else
                <table id="table" class="table text-center table-striped" style="font-size: 12px">
                    <thead>
                        <tr>
                            <th scope="col">N° CONTROL</th>
                            <th scope="col">Carrera</th>
                            <th scope="col">NOMBRE COMPLETO</th>
                            <th scope="col">TELEFONO ALUMNO</th>

                            <th scope="col">TUTOR</th>
                            <th scope="col">TELEFONO TUTOR</th>
                            <th scope="col">MES 1</th>
                            <th scope="col">SEGUIMIENTO O.E. </th>
                            <th scope="col">MES 2</th>
                            <th scope="col">SEGUIMIENTO O.E. </th>
                            <th scope="col">MES 3</th>
                            <th scope="col">SEGUIMIENTO O.E. </th>
                            <th scope="col">MES 4</th>
                            <th scope="col">SEGUIMIENTO O.E. </th>
                            <th scope="col">RESULTADOS</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($historial as $item)
                            <tr>

                                <td style="background: {{ $item->semaforo->fondo }} ">
                                    <p>{{ $item->alumno->id }} </p>
                                </td>

                                <td>
                                    {{ $item->alumno->carrera->nombre_carrera }}
                                </td>
                                <td>{{ $item->alumno->nombre . ' ' . $item->alumno->ap_paterno . ' ' . $item->alumno->ap_paterno }}
                                <td>
                                    {{ $item->alumno->telefono }}
                                </td>
                                <td>
                                    {{ $item->tutor->nombre . ' ' . $item->tutor->ap_paterno . ' ' . $item->tutor->ap_materno }}
                                </td>
                                <td>
                                    {{ $item->tutor->telefono }}
                                </td>
                                <td>
                                    {{ $item->mes_1 }}
                                </td>
                                <td>
                                    {{ $item->oe_1 }}
                                </td>
                                <td>
                                    {{ $item->mes_2 }}
                                </td>
                                <td>
                                    {{ $item->oe_2 }}
                                </td>
                                <td>
                                    {{ $item->mes_3 }}
                                </td>
                                <td>
                                    {{ $item->oe_3 }}
                                </td>
                                <td>
                                    {{ $item->mes_4 }}
                                </td>
                                <td>
                                    {{ $item->oe_4 }}
                                </td>
                                <td>
                                    {{ $item->reporte_final }}
                                    <br>
                                    <b>A:</b>{{ $control_materias->where('alumno_id', $item->alumno_id)->where('periodo_id', $item->periodo_id)->where('status', 1)->count() }}
                                    <b>R:</b>{{ $control_materias->where('alumno_id', $item->alumno_id)->where('periodo_id', $item->periodo_id)->where('status', 0)->count() }}
                                    <br>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
        <div id="pagination-container">
            {{ $historial->links('pagination::bootstrap-4') }}
        </div>

        <div class="btn-regresar">
            <a class="btn btn-secondary" href="{{ route('orientacion.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40   " fill="currentColor"
                    class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                </svg>
                Regresar

            </a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        /*
        $(document).ready(function() {
            var table = $('#table').DataTable({
                //para cambiar el lenguaje a español
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "sProcessing": "Procesando...",
                },
                "drawCallback": function() {
                    // Obtenemos el HTML de la paginación generada por Laravel
                    var pagination = $("#pagination-container ul.pagination").clone();

                    // Vaciamos el contenedor de paginación actual del DataTable
                    $("#table_paginate").empty();

                    // Insertamos la paginación en el lugar deseado dentro del DataTable
                    $("#table_paginate").append(pagination);
                }
            });
        });
        */
    </script>
    @include('modal.alumno.add-alumno')

@endsection
