@extends('master.master')


@section('structure-content')
    @php
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_ALL, 'es_ES');
    $diassemana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'];
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    @endphp


    @if (session('activos') == 'si')
        <div class="alert alert-danger">
            No pueden Haber dos periodos Activos!
        </div>
    @endif
    @if (session('eliminar') == 'no')
        <div class="alert alert-danger">
            No se pueden eliminar periodos que contienen datos!
        </div>
    @endif

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

            <div class="col d-flex flex-column flex-shrink-0 P-2">
                <div class="text-center" style="color: rgb(3, 123, 150)">
                    <h1>
                        Periodos de Evaluación
                    </h1>
                </div>
                <div class="p-2">
                    <a href="{{ route('periodo-eval.create') }} " type="button" class="btn btn-primary"
                        data-bs-toggle="modal" data-bs-target="#modal-eval" data-bs-whatever="@mdo">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-calendar-plus-fill" viewBox="0 0 16 16">
                            <path
                                d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM8.5 8.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5a.5.5 0 0 1 1 0z" />
                        </svg>
                        Nuevo
                    </a>
                </div>
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">Editar</th>
                            <th scope="col">Inicio</th>
                            <th scope="col">Fin</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($periodo_eval as $item)
                            <tr>
                                <th scope="row">
                                    <a href="" type="button" class="btn btn-warning" style="color: white"
                                        data-bs-toggle="modal" data-bs-target="#modal-eval{{ $item->id }}"
                                        data-bs-whatever="@mdo">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </a>
                                    @include('modal.periodo.periodo-eval-edit')
                                </th>
                                <td>
                                    @php
                                        $inicio = $diassemana[date('w', strtotime($item->inicio))].' ' .date('d', strtotime($item->inicio)) . ' ' . $meses[date('n', strtotime($item->inicio)) - 1] . '  ' . date('Y', strtotime($item->inicio));
                                    @endphp
                                    {{ $inicio }}
                                </td>
                                <td>
                                    @php
                                        $fin =$diassemana[date('w', strtotime($item->fin))].' '. date('d', strtotime($item->fin)) . ' ' . $meses[date('n', strtotime($item->fin)) - 1] . '  ' . date('Y', strtotime($item->fin));
                                        
                                    @endphp
                                    {{ $fin }} </td>
                                @if ($item->estado)
                                    <td>
                                        <a type="button" class="btn btn-success">Activo</a>
                                    </td>
                                @else
                                    <td>
                                        <div type="button" class="btn btn-danger">Inactivo</div>

                                    </td>
                                @endif
                                <td>
                                    <form action="{{ route('periodo-eval.destroy', $item->id) }} " method="POST">
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
    @include('modal.periodo.periodo-eval')
@endsection
