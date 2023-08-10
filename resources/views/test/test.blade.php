<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @foreach ($alumnos as $item)
        nombre:{{ $item->alumno->nombre }}
        <br>
        @if (count($item->lights) > 0)
            {{ $item->lights[0]->semestre }}
            <br>
            {{ $item->lights[0]->semaforos[0]->nombre }}
            <br>
            {{ $item->lights[1]->semestre }}
            <br>
            {{ $item->lights[1]->semaforos[0]->nombre }}
            <br>
            {{ $item->lights[2]->semestre }}
            <br>
            {{ $item->lights[2]->semaforos[0]->nombre }}
            <br>
            {{ $item->lights[3]->semestre }}
            <br>
            {{ $item->lights[3]->semaforos[0]->nombre }}
            <br>

        @endif
        <br>
    @endforeach
</body>

</html>
