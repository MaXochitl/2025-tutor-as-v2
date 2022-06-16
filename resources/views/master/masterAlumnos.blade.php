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


    <link rel="stylesheet" href="{{ URL::asset('css/structure/menu-left.css') }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/structure/style_forms.css') }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/testColores/colores.css') }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/alumnos_tutor/tutor_alumnos.css') }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/exam/examenes.css') }} ">

</head>


<body>
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }} "></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }} "></script>

    @yield('contenido')
    @include('secciones.footer')

    <script type="text/javascript" src="{{ URL::asset('js/validacion.js') }}"></script>

</body>

</html>
