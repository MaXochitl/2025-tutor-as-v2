<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"
        integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
</head>

<body>
    <form action="{{ route('tests.store') }}" method="POST">
        @csrf


        <br><br>
        <div class="col d-flex flex-column flex-shrink-0"
            style="padding: 2px; background: rgb(0, 22, 112); border-radius: 20px; color:white">
            <h2 style="padding: 8px">Esta es una pregunta</h2>
            <div class="d-flex flex-column" style="background: white;border-radius: 20px; color:black; padding: 10px">

                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                            checked value="check1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Radio 1
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                            value="check2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Radio 2
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3"
                            value="check3">
                        <label class="form-check-label" for="flexRadioDefault3">
                            Radio 3
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <br><br>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="1" id="rad1" checked value="uno">
                <label class="form-check-label" for="rad1">
                    Radio 1
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="1" id="rad2" value="dos">
                <label class="form-check-label" for="rad2">
                    Radio 2
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="1" id="rad3" value="tres">
                <label class="form-check-label" for="rad3">
                    Radio 3
                </label>
            </div>
        </div>


        <br><br>

        <button>Nex</button>
    </form>

    @foreach ($alumnos as $item)
        @if ($item->eval_respuesta != null)
            @if ($item->eval_respuesta->periodo_eval_id == 3)
                {{ $item->nombre }} <br>
            @endif
        @endif
    @endforeach

    @foreach ($alumnos as $item)

        <div style="background: red">
            @foreach ($item->periodo_eval as $iteme)
                {{ $iteme }}
                <br>
            @endforeach
        </div>

        @if (count($item->preguntas) != 0)
            <h2 style="background: blue">{{ $item->nombre }}</h2>

            <br>
            @php
                $contador = 0;
            @endphp
            @foreach ($item->respuestas as $items)
                <!--this is a data for analysis-->
                <br>
                @if ($items->pregunta->evaluacion_id == 1)
                    {{ $items->pregunta->pregunta }}
                    <br>
                    {{ $items->respuesta . ' valor: ' . $items->valor }}

                @endif

                <br>

                @if ($items->valor != 0 && $items->pregunta->evaluacion_id == 1)
                    @php
                        $contador++;
                    @endphp
                @endif

                </b>

            @endforeach
            <h1 style="color: red"> {{ $contador }} </h1>
            <br>
        @endif

    @endforeach

</body>

</html>
