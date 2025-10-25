<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--________________________BOTSTRAP____________________________________________________________________________________________-->

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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">



    <link rel="stylesheet" href="{{ URL::asset('css/structure/menu-left.css') }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/structure/navBar.css') }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/structure/style_forms.css') }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/alumnos_tutor/tutor_alumnos.css') }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/table/box.css') }}"> <!--css casillas visuales de color-->


    <!--DRAWN AND DROP-->

    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <!--____________________________________________________________________________________________________________________-->
    <title>@yield('titulo', 'itsta')</title>
</head>

<body>


    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }} "></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }} "></script>


    <!--------------------------------------------------------------------INICIO-->
    @include('secciones.menu-bar')

    <div class="content ">
        <div id="cont" class="mov">
            @include('secciones.navBar')
            @yield('structure-content')
        </div>


        @include('secciones.footer')

    </div>

    <!--------------------------------------------------------------------FIN-->

    @can('solo.admin')
        <script type="text/javascript" src="{{ URL::asset('js/estructure/ocultar.js') }}"></script>
    @endcan

    <script type="text/javascript" src="{{ URL::asset('js/estructure/bigSlide.js') }}"></script>


    @yield('js')

    <script type="text/javascript" src="{{ URL::asset('js/validacion.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

    <script src="{{ asset('js/tooltips.js') }}"></script><!--scrip para usar tooltips -->

</body>

</html>
