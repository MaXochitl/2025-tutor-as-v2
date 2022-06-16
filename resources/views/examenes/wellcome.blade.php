@extends('master.masterAlumnos')
@section('contenido')
    <div style="background-image: url('/tutores/home_itsta.jpg')">
        <div class="container" style="padding: 10px">
            <div class="row text-center col-md-8 shadow-lg p-3 mb-5"
                style="margin: auto;border-radius: 17px; background: rgb(0, 26, 130); color: white">
                <h1>Examen Alumnos de Nuevo Ingreso </h1>
            </div>
            <div class="row col-md-8 shadow-lg p-3 mb-5 bg-body " style="margin: auto;border-radius: 17px">
                <div class="row" style="margin: 5px">
                    <div class="col d-flex flex-column flex-shrink-0"
                        style="padding: 2px; background: rgb(104, 104, 104); border-radius: 20px; color:white">
                        <h5 style="padding: 8px"></h5>

                        <div class="d-flex flex-column"
                            style="background: white;border-radius: 20px; color:black; padding: 10px">

                            @if (count($periodo_evaluacion) == 0)
                                <div class="text-center" style="color: red">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor"
                                        class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg>
                                    <p><b>Actualmente no se encuentra examen disponible</b> </p>
                                </div>
                            @else
                                <p>Instrucciónes:</p>
                                <p>1: Registrate para realizar el examen</p>
                                <p>2: Una vez registrado podras hacer el examen (Socioeconomico, Habilidades mentales, Test
                                    de
                                    colores)</p>
                                <p>3: El examen no se puede realizar dos veces</p>
                                <p>4: Dudas hablar con orientacion educativa</p>
                                <p><b>Nota: Si te registras y cierras por error la pagina debes hablar a orientacion
                                        educativa, las respuestas no se guardaran hasta que termines el examen</b> </p>

                                <div class="text-center">
                                    <a href="{{ route('registro.index') }}" type="submit"
                                        class="btn btn-primary">Registrate Aqui! </a>
                                </div>

                            @endif

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
