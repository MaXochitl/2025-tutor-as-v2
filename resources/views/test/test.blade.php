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

        <input type="date" name="dato" value="2021-02-12">
        <select name="car" class="form-select" aria-label="Default select example">
            @foreach ($carreras as $item)
                <option value="{{ $item->id }}">{{ $item->nombre_carrera }}</option>
            @endforeach
        </select>

        <select name="sexo" class="form-select" aria-label="Default select example">
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>

        <div class="mb-3">
            <label for="formFile" class="form-label">Default file input example</label>
            <input id="formFile" name="foto" class="form-control" type="file">
        </div>

        <div class="list-group">
            <label class="list-group-item">
                <input name="1" class="form-check-input me-1" type="checkbox" value="uno">
                First checkbox
            </label>
            <label class="list-group-item">
                <input name="2" class="form-check-input me-1" type="checkbox" value="dos">
                Second checkbox
            </label>
            <label class="list-group-item">
                <input name="3" class="form-check-input me-1" type="checkbox" value="tres">
                Third checkbox
            </label>
            <label class="list-group-item">
                <input name="4" class="form-check-input me-1" type="checkbox" value="cuatro">
                Fourth checkbox
            </label>
            <label class="list-group-item">
                <input name="5" class="form-check-input me-1" type="checkbox" value="cinco">
                Fifth checkbox
            </label>
        </div>

        <br><br>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked value="check1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Radio 1
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="check2">
                <label class="form-check-label" for="flexRadioDefault2">
                    Radio 2
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" value="check3">
                <label class="form-check-label" for="flexRadioDefault3">
                    Radio 3
                </label>
            </div>
        </div>

        <br><br>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="data" id="rad1" checked value="uno">
                <label class="form-check-label" for="rad1">
                    Radio 1
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="data" id="rad2" value="dos">
                <label class="form-check-label" for="rad2">
                    Radio 2
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="data" id="rad3" value="tres">
                <label class="form-check-label" for="rad3">
                    Radio 3
                </label>
            </div>
        </div>


        <br><br>

        <button>Nex</button>
    </form>


    @foreach ($preguntas as $item)
        {{ $item->evaluacion }} <br>
        @foreach ($respuestas->where('pregunta_id', $item->id) as $item)
            {{ $item->respuesta }}
        @endforeach
    @endforeach

    <br>
    <br>
    <br>


    @foreach ($periodo_tutor as $item)
        --> {{ $item->id }}
        <br>
        {{ $item->semaforos[0]->nombre }}
        <br>
    @endforeach

    @for ($i = 0; $i < count($periodo_tutor); $i++)
        {{ $periodo_tutor[$i]->alumno_id }}
        <br>
        <b>{{ $periodo_tutor[$i]->semaforos[$i]->nombre }}</b>
        <br>
    @endfor


    <br>


    <input type="time" name="hora">
    <br>
    {{ $periodo_tutor[0]->semaforos[1]->nombre }}

    <br>
    <br>
    @php
        $a = [
            'uno' => 1,
            'dos' => 2,
            'tres' => 3,
            'diecisiete' => 17,
        ];
        
        foreach ($a as $k => $v) {
            echo "\$a[$k] => $v.\n";
        }
    @endphp

</body>

</html>
