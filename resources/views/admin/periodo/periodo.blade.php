@extends('master.master')


@section('structure-content')
    @php
        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_ALL, 'es_ES');
        $diassemana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'];
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    @endphp

    <div class="container">
        <div style="text-align: right; margin: 20px">
            <a href="{{ route('evaluacion.index') }} ">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40   " fill="currentColor"
                    class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                </svg>
            </a>
        </div>

        <div class="row ">

            <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px; text-align: center">
                @if (session('eliminar') == 'no')
                    <div class="alert alert-danger">
                        No se pueden eliminar periodos que contienen datos!
                    </div>
                @endif
                <div>
                    <h1>
                        Periodo Tutorado
                    </h1>
                </div>

                <div style="text-align: left" class="p-2">
                    <a href=" " type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#periodo-t-modal" data-bs-whatever="@mdo">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-calendar2-week-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zm9.954 3H2.545c-.3 0-.545.224-.545.5v1c0 .276.244.5.545.5h10.91c.3 0 .545-.224.545-.5v-1c0-.276-.244-.5-.546-.5zM8.5 7a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM3 10.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z" />
                        </svg>
                        Nuevo
                    </a>

                    @if (!$registro->status)
                        <a href="{{ route('periodo-tutorado.edit', 1) }} " type="button" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="bi bi-person-x-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('periodo-tutorado.edit', 0) }} " type="button" class="btn btn-success">

                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="bi bi-person-check-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                        </a>
                    @endif

                    <a href="" class="btn" style="background: purple; color:white" data-bs-toggle="modal"
                        data-bs-target="#modal-active-inactive" data-bs-whatever="@mdo">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-calendar2-week-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zm9.954 3H2.545c-.3 0-.545.224-.545.5v1c0 .276.244.5.545.5h10.91c.3 0 .545-.224.545-.5v-1c0-.276-.244-.5-.546-.5zM8.5 7a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM3 10.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z" />
                        </svg>
                    </a>

                </div>
                <div class="overflow-scroll" style="height: 500px">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Editar</th>
                                <th scope="col">N°</th>
                                <th scope="col">Inicio</th>
                                <th scope="col">Fin</th>
                                <th scope="col">mes 1</th>
                                <th scope="col">mes 2</th>
                                <th scope="col">mes 3</th>
                                <th scope="col">mes 4</th>
                                <th scope="col">Entrega Final</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $contador = 1;
                            @endphp
                            @foreach ($periodo_tutorado as $item)
                                <tr>
                                    <th scope="row">
                                        <a href="" type="button" class="btn btn-warning" style="color: white"
                                            data-bs-toggle="modal" data-bs-target="#edit-p-t-modal" data-bs-whatever="@mdo">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                        @include('modal.periodo.periodo-tutor-edit')
                                    </th>
                                    <th>{{ $contador++ }}</th>
                                    <td>
                                        @php
                                            $inicio = date('d', strtotime($item->inicio)) . ' ' . $meses[date('n', strtotime($item->inicio)) - 1] . '  ' . date('Y', strtotime($item->inicio));
                                        @endphp
                                        {{ $inicio }}
                                    </td>
                                    <td>
                                        @php
                                            $fin = date('d', strtotime($item->fin)) . ' ' . $meses[date('n', strtotime($item->fin)) - 1] . '  ' . date('Y', strtotime($item->fin));
                                        @endphp
                                        {{ $fin }}
                                    </td>
                                    <td>
                                        @php
                                            $mes_1 = date('d', strtotime($item->mes_1)) . ' ' . $meses[date('n', strtotime($item->mes_1)) - 1] . '  ' . date('Y', strtotime($item->mes_1));
                                        @endphp
                                        {{ $mes_1 }}
                                    </td>
                                    <td>
                                        @php
                                            $mes_2 = date('d', strtotime($item->mes_2)) . ' ' . $meses[date('n', strtotime($item->mes_2)) - 1] . '  ' . date('Y', strtotime($item->mes_2));
                                        @endphp
                                        {{ $mes_2 }}

                                    </td>
                                    <td>
                                        @php
                                            $mes_3 = date('d', strtotime($item->mes_3)) . ' ' . $meses[date('n', strtotime($item->mes_2)) - 1] . '  ' . date('Y', strtotime($item->mes_3));
                                        @endphp
                                        {{ $mes_3 }}


                                    </td>
                                    <td>
                                        @php
                                            $mes_4 = date('d', strtotime($item->mes_4)) . ' ' . $meses[date('n', strtotime($item->mes_2)) - 1] . '  ' . date('Y', strtotime($item->mes_4));
                                        @endphp
                                        {{ $mes_4 }}

                                    </td>
                                    <td>
                                        @php
                                            $reporte_final = date('d', strtotime($item->reporte_final)) . ' ' . $meses[date('n', strtotime($item->reporte_final)) - 1] . '  ' . date('Y', strtotime($item->reporte_final));
                                        @endphp
                                        {{ $reporte_final }}

                                    </td>
                                    <td>
                                        <form action="{{ route('periodo-tutorado.destroy', $item->id) }} " method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @include('modal.periodo.activar_desactivar_p')
    <script>
        const periodo = @json($altera_entrega);
        const ruta = '{{ route('entrega.store') }}';
    </script>
    <script type="text/javascript" src="{{ URL::asset('js/periodo.js') }}"></script>
@endsection
