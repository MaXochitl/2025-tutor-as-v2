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
                                <th class="text-center">PDF</th>
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
                                        <a href="{{ route('pdf.show', $item->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.523 12.424q.21-.124.459-.238a8 8 0 0 1-.45.606c-.28.337-.498.516-.635.572l-.035.012a.3.3 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647q-.178.037-.356.078a21 21 0 0 0 .5-1.05 12 12 0 0 0 .51.858q-.326.048-.654.114m2.525.939a4 4 0 0 1-.435-.41q.344.007.612.054c.317.057.466.147.518.209a.1.1 0 0 1 .026.064.44.44 0 0 1-.06.2.3.3 0 0 1-.094.124.1.1 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 6.97c-.04.244-.108.524-.2.829a5 5 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.5.5 0 0 1 .145-.04c.013.03.028.092.032.198q.008.183-.038.465z" />
                                                <path fill-rule="evenodd"
                                                    d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.7 11.7 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.86.86 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.84.84 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.8 5.8 0 0 0-1.335-.05 11 11 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.24 1.24 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a20 20 0 0 1-1.062 2.227 7.7 7.7 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103" />
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
