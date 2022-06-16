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
            <a href="{{ route('evaluacion.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40   " fill="currentColor"
                    class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                </svg>
            </a>
        </div>
        <div class="row ">

            <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">
                <div style="text-align: center">
                    <h1>
                        Resultados De Evaluaciones
                    </h1>
                </div>

                <div class="container p-2">
                    <form action="{{ route('evaluacion.store') }}" method="post">
                        @csrf
                        <div class="row shadow-lg p-3">
                            <div class="col-6 col-md-4">
                                <label for="periodo">Selecciona un periodo</label>
                                <select name="periodo" class="form-select" aria-label="Default select example">
                                    @foreach ($periodo_evaluacion as $item)
                                        @php
                                            $inicio = date('d', strtotime($item->inicio)) . ' ' . $meses[date('n', strtotime($item->inicio)) - 1] . '  ' . date('Y', strtotime($item->inicio));
                                            $fin = date('d', strtotime($item->fin)) . ' ' . $meses[date('n', strtotime($item->fin)) - 1] . '  ' . date('Y', strtotime($item->fin));
                                        @endphp
                                        <option @if ($periodo == $item->id){{ 'selected' }}@endif value="{{ $item->id }} ">
                                            {{ $inicio . ' - ' . $fin }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 col-md-5">
                                <label for="carrera">Selecciona una carrera</label>
                                <select name="carrera" class="form-select" aria-label="Default select example">
                                    @foreach ($carreras as $item)

                                        <option @if ($carrera_select == $item->id){{ 'selected' }}@endif value="{{ $item->id }} ">
                                            {{ $item->nombre_carrera }}</option>
                                    @endforeach
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
                <div class="overflow-scroll" style="height: 500px">

                    <table class="table table-striped text-center" style="border-collapse: collapse; font-size: 13px">
                        <thead>
                            <tr>
                                <th rowspan="2" scope="col">N° CONTROL</th>
                                <th rowspan="2" scope="col">NOMBRE</th>
                                <th rowspan="2" scope="col">CARRERA</th>
                                <th rowspan="2" scope="col">TELEFONO</th>
                                <th rowspan="2" scope="col">CORREO</th>
                                <th colspan="6" scope="col">PSICOMETRICO</th>
                                <th rowspan="2" scope="col">RAZONAMIENTO Y HABILIDADES</th>
                                <th rowspan="2" scope="col">SOCIOECONOMICO</th>
                                <th rowspan="2" scope="col">test de colores</th>

                            </tr>
                            <tr>
                                <th scope="col">I</th>
                                <th scope="col">II</th>
                                <th scope="col">III</th>
                                <th scope="col">IV</th>
                                <th scope="col">V</th>
                                <th scope="col">VI</th>

                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($resultados as $item)
                                <tr>
                                    <th scope="row">
                                        {{ $item->alumno->id }}
                                    </th>
                                    <td>
                                        {{ $item->alumno->nombre . ' ' . $item->alumno->ap_paterno . ' ' . $item->alumno->ap_materno }}
                                    </td>
                                    <td>
                                        {{ $item->alumno->carrera->nombre_carrera }}
                                    </td>
                                    <td>
                                        {{ $item->alumno->telefono }}
                                    </td>
                                    <td>
                                        {{ $item->alumno->correo }}
                                    </td>
                                    <td>
                                        {{ $item->psicometrico_I }}

                                    </td>

                                    <td>
                                        {{ $item->psicometrico_II }}

                                    </td>
                                    <td>
                                        {{ $item->psicometrico_III }}

                                    </td>
                                    <td>
                                        {{ $item->psicometrico_IV }}

                                    </td>
                                    <td>
                                        {{ $item->psicometrico_V }}

                                    </td>
                                    <td>
                                        {{ $item->psicometrico_VI }}

                                    </td>


                                    <td>
                                        {{ $item->razonamiento }}
                                    </td>
                                    <td>
                                        {{ $item->socioeconomico }}
                                    </td>
                                    @php
                                        $color = App\Models\Posicion::where('alumno_id', $item->alumno->id)
                                            ->where('posicion', 1)
                                            ->get();
                                    @endphp
                                    @if (count($color) == 0)
                                        <td>
                                            {{ 'Pendiente' }}
                                        </td>
                                    @else
                                        <td>
                                            <a class="rounded-circle btn btn-primary" href="" type="button"
                                                style="border-radius: 6px ;height: 50px; width: 50px; background: {{ $color[0]->color->codigo }};"
                                                data-bs-toggle="modal"
                                                data-bs-target="#res-color-modal{{ $item->alumno_id }}"
                                                data-bs-whatever="@mdo"></a>
                                            <br>

                                        </td>

                                        @include('modal.resultados.modal-color')

                                    @endif


                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                    @if (count($resultados) == 0)
                        <div class="alert alert-danger">
                            Ningun Alumno ha realizado el examen!
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
