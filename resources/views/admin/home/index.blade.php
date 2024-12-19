@extends('master.master')


@section('structure-content')

    @php
        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_ALL, 'es_ES');
        $diassemana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'];
        $meses = [
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Septiembre',
            'Octubre',
            'Noviembre',
            'Diciembre',
        ];

    @endphp


    <div class="row img-fond-home p-4">

        <div class="row mb-9">

            <div class="row text-center col-md-8 shadow-lg p-3 mb-2"
                style="margin: auto;border-radius: 17px; background: rgb(0, 26, 130); color: white">
                <h3>PROGRAMA INSTITUCIONAL DE TUTORIAS </h3>
                <form method="POST" action="{{ route('orientacion.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row  justify-content-center">

                        <div class="col-4">
                            <select name="periodo_select" class="form-select" aria-label="Default select example">
                                @foreach ($periodos as $itemx)
                                    @php
                                        $inicio =
                                            $meses[date('n', strtotime($itemx->inicio)) - 1] .
                                            '  ' .
                                            date('Y', strtotime($itemx->inicio));
                                        $fin =
                                            $meses[date('n', strtotime($itemx->fin)) - 1] .
                                            '  ' .
                                            date('Y', strtotime($itemx->fin));
                                    @endphp
                                    <option @if ($periodo_view->id == $itemx->id) {{ 'selected' }} @endif
                                        value="{{ $itemx->id }} ">
                                        {{ $inicio . ' - ' . $fin }}
                                    </option>
                                @endforeach

                            </select>
                        </div>


                        <div class="col-1">
                            <button type="submit" class="btn btn-success">Establecer</button>
                        </div>
                    </div>
                </form>

            </div>

            <div class="row col-md-8 shadow-lg p-3 " style="margin: auto;border-radius: 17px;background: white">
                <div class="overflow-scroll" style="height: 400px">

                    <table class="table table-striped text-heigth">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th scope="col" class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                    </svg>
                                </th>

                                <th scope="col">CARRERA</th>
                                <th class="text-center">EXCEL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carreras as $item)
                                <tr>

                                    <th style="width: 2%">{{ $item->id }}</th>
                                    <th scope="row" style="width: 20px">
                                        <a href="{{ route('tutor.show', $item->id) }} ">
                                            <img src="{{ $item->icono }} " alt="" height="50px" width="50px"
                                                class="img-icon" style="border-radius: 40px; padding: 0px ">
                                        </a>


                                    </th>
                                    <td>{{ $item->nombre_carrera }}</td>
                                    <td class="text-center">
                                        <a  href="{{ route('ReportsExports.show', $item->id) }}" >
                                            <svg style="color: green" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                                                <path d="M6 12v-2h3v2z"/>
                                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3z"/>
                                              </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>

            @if (count($avisos) != 0)
                <div class="row  col-md-3 shadow-lg p-3 overflow-scroll" style="height: 300px">

                    @foreach ($avisos as $item)
                        <div class="rounded alert-warning mb-3" role="alert">
                            <div class="modal-header">
                                <b style="color: brown">{{ $item->titulo }}</b>
                                <form action="{{ route('aviso.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </form>

                            </div>
                            {{ $item->aviso }}
                        </div>
                    @endforeach


                </div>
            @endif

        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('change') == 'yes')
        <script>
            Swal.fire(
                'Actualizada!',
                'Se actualizo el periodo a visualizar.',
                'success'
            )
        </script>
    @endif

@endsection
