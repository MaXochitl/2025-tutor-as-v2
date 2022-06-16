@extends('master.masterAlumnos')
@section('contenido')
    <div class="img-fond-home">
        <div class="container" style="padding: 10px">
            <div class="row text-center col-md-8 shadow-lg p-3 mb-5"
                style="margin: auto;border-radius: 17px; background: rgb(0, 26, 130); color: white">
                <h1>Examenes a realizar</h1>

            </div>
            <div class="row col-md-10 shadow-lg p-3 mb-5 bg-body " style="margin: auto;border-radius: 17px">
                <div class="row" style="margin: 5px">
                    <div class="col d-flex flex-column flex-shrink-0"
                        style="padding: 2px; background: rgb(104, 104, 104); border-radius: 20px; color:white">
                        <h4 class="text-center">Alumno:
                            <b>{{ $alumno->nombre . ' ' . $alumno->ap_paterno . ' ' . $alumno->ap_materno }} </b>
                        </h4>
                        <h4 class="text-center">Numero de control: <b>{{ $alumno->id }} </b> </h4>
                        <h4 class="text-center">Correo: <b>{{ $alumno->correo }} </b> </h4>

                        <h2></h2>
                        <div class="d-flex flex-column"
                            style="background: white;border-radius: 20px; color:black; padding: 10px">


                            <div class="text-center">

                                <a href="{{ route('test_socioeconomico.testEconomico', $alumno) }}" type="submit"
                                    class="btn btn-primary @if ($economico->count() != 0){{ 'disabled btn-success' }}@endif ">Test Socioeconomico</a>

                                <a href="{{ route('examen_psicometrico.testPsicometrico', $alumno) }}" type="submit"
                                    class="btn btn-primary  @if ($psicometrico->count() != 0){{ 'disabled btn-success' }}@endif ">Examen Psicometrico </a>

                                <a href="{{ route('test_colores.show', $alumno->id) }} " type="submit"
                                    class="btn btn-primary @if ($testColores->count() != 0){{ 'disabled btn-success' }}@endif">Test de Colores </a>

                                <a href="{{ route('examen_habilidades.examenHabilidades', $alumno) }}" type="submit"
                                    class="btn btn-primary @if ($razonamiento->count() != 0){{ 'disabled btn-success' }}@endif  ">Prueba de Razonamiento </a>

                            </div>
                            <div class="text-center p-3">
                                <a href="{{ route('examen.index', $alumno) }}" type="submit"
                                    class="btn btn-warning ">Finalizar Examen</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
