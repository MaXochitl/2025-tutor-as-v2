@extends('master.masterAlumnos')


@section('contenido')

    <body class="img-fond-home">


        <div class="container">


            <div class="row col-md-8 shadow-lg p-3 mb-5"
                style="margin: auto;border-radius: 17px; background: rgb(0, 26, 130); color: white">
                <h1>Test Socioeconomico</h1>
                <h5>Nombre: {{ $alumno->nombre . ' ' . $alumno->ap_paterno . ' ' . $alumno->ap_materno }} </h5>
                <h5>Numero de control: {{ $alumno->id }} </h5>
            </div>
            <div class="row col-md-8 shadow-lg p-3 mb-5 bg-body " style="margin: auto;border-radius: 17px">
                <div class="overflow-scroll" style="height: 800px">

                    @php
                        $contador = 1;
                    @endphp
                    <form method="POST" action="{{ route('guardar_examen.guardarRespuestas', $alumno->id) }}">
                        @csrf
                        @foreach ($preguntas as $item)
                            <div class="row" style="margin: 5px">
                                <div class="col d-flex flex-column flex-shrink-0"
                                    style="padding: 2px; background: rgb(0, 26, 130); border-radius: 20px; color:white">
                                    <h5 style="padding: 8px"> {{ $contador++ . ') ' . $item->pregunta }} </h5>
                                    <div class="d-flex flex-column"
                                        style="background: white;border-radius: 20px; color:black; padding: 10px">

                                        @foreach ($item->respuestas as $item_resp)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="{{ $item->id }}"
                                                    id="rad{{ $item_resp->id }}" value="{{ $item_resp->id }}" required>
                                                <label class="form-check-label" for="rad{{ $item_resp->id }}">
                                                    {{ $item_resp->respuesta }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Guardar y continuar</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </body>
@endsection
