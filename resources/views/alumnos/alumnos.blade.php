@extends('master.master')

@section('structure-content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <div class="container">

        @if (session('creado') == 'no')
            <div class="alert alert-danger">
                El Alumno ya se encuentra registrado!
            </div>
        @endif
        @if (session('creado') == 'si')
            <div class="alert alert-success">
                El Alumno se registro correctamente!
            </div>
        @endif
        <div class="row ">

            <div class="col d-flex flex-column">
                <div class="text-center">
                    <h1>
                        Lista de Alumnos
                    </h1>
                </div>
                <div class="row p-2">
                    <div class="col-6 col-md-2">
                        <a href="{{ route('alumnos.create') }} " type="button" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#alumno-modal" data-bs-whatever="@mdo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                <path fill-rule="evenodd"
                                    d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                            </svg>
                            Nuevo
                        </a>

                    </div>

                    <div class="col-6 col-md-9">
                        <form method="POST" action="{{ route('importAlumnos') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input name="file" type="file" class="form-control " id="fileexcel" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <button class="btn btn-success" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                        </svg>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>


                <div class="table-responsive">
                    <div class="d-md-flex justify-content-md-end">
                        <form method="GET" action="{{ route('searchAlumno') }} ">
                            @csrf
                            <div class="btn-group">
                                <input name="busqueda" type="text" id="searchInput" class="form-control"
                                    placeholder="Buscar por nombre" value="{{ $palabra }}">
                                <button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg></button>
                                <a href="{{ route('alumnos.index') }} " class="btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                        fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                        <path
                                            d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                    </svg>
                                </a>
                            </div>
                        </form>
                    </div>

                    <table id="table" class="table table-striped text-center" style="font-size: 13px">
                        <thead>
                            <tr>

                                <th scope="col">EDITAR</th>

                                <th scope="col">N° CONTROL</th>
                                <th scope="col">NOMBRE COMPLETO</th>
                                <th scope="col">SEXO</th>
                                <th scope="col">Fecha Nacimiento</th>
                                <th scope="col">DOMICILIO</th>
                                <th scope="col">GRUPO</th>
                                <th scope="col">TELEFONO</th>
                                <th scope="col">CORREO</th>
                                <th scope="col">CARRERA</th>
                                <th scope="col">STATUS</th>
                                @can('solo.admin')
                                    <th scope="col">Eliminar</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $contador = 1;
                            @endphp
                            @foreach ($alumnos as $alum)
                                <tr>
                                    <th scope="row">
                                        <a href="{{ route('alumnos.edit', $alum->id) }}" type="button"
                                            class="btn btn-warning" style="color: white" data-bs-toggle="modal"
                                            data-bs-target="#alumnoedit-modal{{ $alum->id }}" data-bs-whatever="@mdo">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                        @include('modal.alumno.editar')
                                    </th>


                                    <td>{{ $alum->id }} </td>
                                    <td>{{ $alum->nombre . ' ' . $alum->ap_paterno . ' ' . $alum->ap_materno }} </td>
                                    <td>{{ $alum->sexo }} </td>
                                    <td>{{ $alum->fecha_nacimiento }} </td>
                                    <td>{{ $alum->domicilio }} </td>
                                    <td>{{ $alum->grupo }} </td>
                                    <td>{{ $alum->telefono }} </td>
                                    <td>{{ $alum->correo }} </td>
                                    <td>{{ $alum->carrera->nombre_carrera }} </td>
                                    <td>
                                        @switch($alum->estado)
                                            @case(1)
                                                {{ 'Activo' }}
                                            @break

                                            @case(2)
                                                {{ 'Baja Temporal' }}
                                            @break

                                            @default
                                                {{ 'Baja definitiva' }}
                                        @endswitch
                                    </td>
                                    @can('solo.admin')
                                        <td>
                                            <form action="{{ route('alumnos.destroy', $alum->id) }} "
                                                class="formulario-eliminar" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                </button>

                                            </form>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    <!--El parametro  de busqueda se debe enviar en los enlaces de la paginacion con appens() -->
        {{ $alumnos->appends(['busqueda' => request()->get('busqueda')])->links('pagination::bootstrap-4') }}

    </div>
    @can('solo.tutor')
        @include('modal.alumno.nuevo')
    @endcan
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El Alumno se ha sido eliminado.',
                'success'
            )
        </script>
    @endif

    <script>
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault();


            Swal.fire({
                title: 'Estas Seguro de eliminar?',
                text: "El alumno se eliminara definitivamente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })
        });
    </script>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script>
        /*
    <script src="https://code.jquery.com/jquery-3.5.1.js">

                                $(document).ready(function() {
                                    $('#table').DataTable({
                                        //para cambiar el lenguaje a español
                                        "language": {
                                            "lengthMenu": "Mostrar _MENU_ registros",
                                            "zeroRecords": "No se encontraron resultados",
                                            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                                            "sSearch": "Buscar:",
                                            "oPaginate": {
                                                "sFirst": "Primero",
                                                "sLast": "Último",
                                                "sNext": "Siguiente",
                                                "sPrevious": "Anterior"
                                            },
                                            "sProcessing": "Procesando...",
                                        }
                                    });
                                });
                                */
    </script>
@endsection
