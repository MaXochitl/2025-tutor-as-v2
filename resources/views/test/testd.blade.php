<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Hola</h1>
    @foreach ($control_materias as $item)
        {{ $item->periodo->inicio.' - '.$item->periodo->fin }}
        {{ $item->materia->nombre }}
        {{ $item->alumno->nombre }}
    @endforeach
</body>

</html>
