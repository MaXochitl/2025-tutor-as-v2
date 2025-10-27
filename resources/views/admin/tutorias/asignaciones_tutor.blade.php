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
    <!-- Mostrar alerts -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" aria-label="Close"></button>
        </div>
    @endif

    <div class="row ">

        <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">
            <div style="text-align: center">
                <h1>
                    Asignación de Tutores
                </h1>
            </div>

            @if ($asig == 0)
            <!-- Crear asignaciones iniciales -->
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
                        <a href="{{ route('asignaciones.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle" style="font-size: 1.5rem"></i>
                        </a>

                    </div>
                </div>
            <!--Fin Crear asignaciones iniciales -->   

            @else

            <!-- Si ya existen asignaciones -->
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
                            <i class="bi bi-search" style="font-size: 1.5rem"></i>
                            </button>
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
                    <table id="table" class="table table-striped text-center align-middle">  <!-- align-middle>-->
                        <thead>
                            <tr>
                                <th scope="col">FOTO</th>
                                <th scope="col">CARRERA</th>
                                <th scope="col">NOMBRE COMPLETO</th>
                                <th scope="col">CORREO</th>
                                <th scope="col">TELEFONO</th>
                                <th scope="col">ASIGNACIONES</th><!-- mostrara los semestres y grupos-->
                                <th scope="col">ACCIONES</th><!-- asignara los semestres y grupos-->

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($asignaciones as $item)
                            @if ($item->carrera_id)
                            @php
                            $asigPeriodo = $item->asignaciones->where('periodo_id', $periodo);
                            @endphp
                            <tr>
                                <td>
                                    <img src="{{ $item->foto }} " alt="" height="50px" width="50px" class="img-icon" style="border-radius: 40px; padding: 0px ">
                                </td>
                                <td>{{ $item->carrera->nombre_carrera }}</td>
                                <td>{{ $item->nombre . ' ' . $item->ap_paterno . ' ' . $item->ap_materno }}
                                </td>
                                <td>{{ $item->user->email }}</td>
                                <td>{{ $item->telefono }} </td>

                                <!--penultima columna, td que remplaza los antiguos td semestres y td grupos-->
                                <td>
                                    @if ($asigPeriodo->isNotEmpty())
                                        {{-- Verificar si solo hay una asignación con semestre=0 y grupo="sin asignar" --}}
                                        @php
                                            $soloSinAsignar = $asigPeriodo->count() === 1 &&
                                                            $asigPeriodo->first()->semestre == 0 &&
                                                            strtolower(trim($asigPeriodo->first()->grupo)) == 'sin asignar';
                                        @endphp

                                        @if ($soloSinAsignar)
                                            <span class="text-muted fst-italic">
                                                Sin asignación actual.
                                            </span>
                                        @else
                                            @foreach ($asigPeriodo as $a)
                                                {{-- Saltar el registro "sin asignar" si hay más asignaciones --}}
                                                @if ($a->semestre != 0 && strtolower(trim($a->grupo)) != 'sin asignar')
                                                    <div class="d-flex justify-content-between align-items-center mb-1 border rounded p-1">
                                                        <span>
                                                            <span class="badge bg-primary">{{ $a->semestre }}</span>
                                                            <span class="badge bg-secondary">{{ $a->grupo }}</span>
                                                        </span>
                                                        <form action="{{ route('asignaciones.destroy', $a->id) }}" method="POST" class="formulario-eliminar-grupo" data-id="{{ $a->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="bi bi-x-lg"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                        <span class="text-muted">Sin asignaciones</span>
                                    @endif
                                </td>


                                <td> <!--ultima columna, botones de asignacion-->
                                    <button type="button" class="btn btn-success btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal-agregar{{ $item->id }}">
                                    + Grupo
                                    </button>
                                    {{-- Modal de agregar grupo --}}
                                    @include('modal.asignaciones.agregar_grupo', [
                                    'item' => $item,
                                    'semestres' => $semestres,
                                    'grupos' => $grupos,
                                    'periodo' => $periodo
                                    ])

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
<script src="{{ asset('js/custom/alerts.js') }}"></script> <!--animacion para alerts-->
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

        //confirmacion antes de eliminar un grupo
        $('.formulario-eliminar-grupo').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta asignación será eliminada permanentemente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endsection
