@extends('master.master')



@section('structure-content')

@php
date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL, 'es_ES');
$diassemana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'];
$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
$semestres = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17];
$grupos = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N'];
@endphp

<div class="container">

    <div class="row ">

        <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">
            <div style="text-align: center">
                <h1>
                    Asignacion de Tutores
                </h1>
            </div>

            @if ($asig == 0)
            <div class="row row-tutor">
                <div class="row  shadow-lg p-3">
                    <div class="col-3 col-md-4">
                        <label for="periodo">Periodo Actual</label>

                        <select name="periodo" class="form-select" aria-label="Default select example">
                            @foreach ($periodos->where('id', $periodo) as $item)
                            @php
                            $inicio = $meses[date('n', strtotime($item->inicio)) - 1] . ' ' . date('Y', strtotime($item->inicio));
                            $fin = $meses[date('n', strtotime($item->fin)) - 1] . ' ' . date('Y', strtotime($item->fin));
                            @endphp
                            <option value="{{ $item->id }} ">
                                {{ $inicio . ' - ' . $fin }}
                            </option>
                            @endforeach
                        </select>

                    </div>

                    <div class="col-5 col-md-1 " style="margin-top: 21px">
                        <a href="{{ route('asignaciones.create') }} " type="submit" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                        </a>

                    </div>
                </div>
            </div>

            @else


            <div class="row row-tutor">
                <form action="{{ route('asignaciones.store') }}" method="post">
                    @csrf
                    <div class="row  shadow-lg p-3">

                        <div class="col-3 col-md-4">
                            <label for="periodo">Selecciona un periodo</label>

                            <select name="periodo" class="form-select" aria-label="Default select example">
                                @foreach ($periodos as $item)
                                @php
                                $inicio = $meses[date('n', strtotime($item->inicio)) - 1] . ' ' . date('Y', strtotime($item->inicio));
                                $fin = $meses[date('n', strtotime($item->fin)) - 1] . ' ' . date('Y', strtotime($item->fin));
                                @endphp
                                <option @if ($periodo==$item->id){{ 'selected' }}@endif value="{{ $item->id }} ">
                                    {{ $inicio . ' - ' . $fin }}
                                </option>
                                @endforeach
                            </select>


                        </div>

                        <div class="col-5 col-md-1 " style="margin-top: 21px">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </div>

                        <div class="col-5 col-md-1 " style="margin-top: 21px">
                            <a href="{{ route('memorandum.create') }} " class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width=25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                </svg>
                            </a>
                        </div>

                    </div>
                </form>
                <div class="overflow-scroll" style="height: 500px">
                    <table id="table" class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">FOTO</th>
                                <th scope="col">CARRERA</th>
                                <th scope="col">NOMBRE COMPLETO</th>
                                <th scope="col">CORREO</th>
                                <th scope="col">TELEFONO</th>
                                <th scope="col">SEMESTRE</th>
                                <th scope="col">GRUPO</th>
                                <th scope="col">ASIGNAR</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($asignaciones as $item)
                            @if ($item->carrera_id != null)
                            <tr>
                                <td>
                                    <img src="{{ $item->foto }} " alt="" height="50px" width="50px" class="img-icon" style="border-radius: 40px; padding: 0px ">
                                </td>
                                <td>{{ $item->carrera->nombre_carrera }}</td>
                                <td>{{ $item->nombre . ' ' . $item->ap_paterno . ' ' . $item->ap_materno }}
                                </td>
                                <td>{{ $item->user->email }}</td>
                                <td>{{ $item->telefono }} </td>

                                <td>
                                    @foreach ($item->asignaciones->where('periodo_id', $periodo) as $tems)
                                    {{ $tems->semestre }}
                                    @php
                                    $id_modal = $tems->id;
                                    @endphp
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($item->asignaciones->where('periodo_id', $periodo) as $tems)
                                    {{ $tems->grupo }}
                                    @endforeach
                                </td>


                                <td>
                                    <a href="" type="button" class="btn btn-warning" style="color: white" data-bs-toggle="modal" data-bs-target="#modal-asignacion{{ $item->id }}" data-bs-whatever="@mdo">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />

                                        </svg>
                                    </a>

                                    @include('modal.asignaciones.mes_semestre')

                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



            @endif

        </div>
    </div>
    

</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table').DataTable({
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
            }
        });

        // Muestra un cuadro de diálogo SweetAlert


    });

    Swal.fire({
        title: '¡Hola!',
        text: 'Este es un mensaje de ejemplo',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    });
</script>
@endsection