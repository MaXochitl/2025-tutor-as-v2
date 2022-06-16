@extends('master.master')


@section('structure-content')

    @php
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_ALL, 'es_ES');
    $diassemana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'];
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    $inicio = $diassemana[date('w', strtotime($periodo_actual->inicio))] . ' ' . date('d', strtotime($periodo_actual->inicio)) . ' de ' . $meses[date('n', strtotime($periodo_actual->inicio)) - 1] . ' ' . date('Y', strtotime($periodo_actual->inicio));
    $fin = $diassemana[date('w', strtotime($periodo_actual->fin))] . ' ' . date('d', strtotime($periodo_actual->fin)) . ' de ' . $meses[date('n', strtotime($periodo_actual->fin)) - 1] . ' ' . date('Y', strtotime($periodo_actual->fin));

    @endphp
    <div class="container">
        <div class="row ">

            <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">
                <div class="text-center">
                    <h1>
                        Alumnos Nuevo Ingreso
                    </h1>
                    {{ $inicio . ' - ' . $fin }}
                </div>
                <div class="p-2">
                    <div class="row">
                        <div class="col-6 col-md-2">
                            <a href="{{ route('alumnos.create') }} " type="button" class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#nuevo-ingreso" data-bs-whatever="@mdo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                  </svg>
                                
                            </a>
                        </div>
                        <div class="col-6 col-md-9">
                            <form method="POST" action="{{ route('importExcel') }}" enctype="multipart/form-data">
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


                </div>
                @if (count($lista_alumnos) == 0)
                    <div class="alert alert-danger">
                        No hay lista para este periodo, puedes crear uno nuevo!
                    </div>
                @else

                    <table class="table table-striped text-center" style="font-size: 13px">
                        <thead>
                            <tr>
                                <th scope="col">EDITAR</th>
                                <th scope="col">N° CONTROL</th>
                                <th scope="col">NOMBRE COMPLETO</th>
                                <th scope="col">TELEFONO</th>
                                <th scope="col">CORREO</th>
                                <th scope="col">CARRERA</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lista_alumnos as $alum)
                                <tr>
                                    <th scope="row">
                                        <a href="" type="button" class="btn btn-warning" style="color: white"
                                            data-bs-toggle="modal" data-bs-target="#nuevo-ingreso-edit{{ $alum->id }}"
                                            data-bs-whatever="@mdo">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                        @include('admin.alumnos_ni.editar')
                                    </th>

                                    <td>{{ $alum->num_control }} </td>
                                    <td>{{ $alum->nombre . ' ' . $alum->ap_paterno . ' ' . $alum->ap_materno }} </td>
                                    <td>{{ $alum->telefono }} </td>
                                    <td>{{ $alum->correo }} </td>
                                    <td>{{ $alum->carrera->nombre_carrera }} </td>

                                    <td>
                                        @if ($alum->status)
                                            {{ 'Realizado' }}

                                        @else
                                            {{ 'Pendiente' }}
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('alumnos_examenes.destroy', $alum->id) }}"
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

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>

        @include('admin.alumnos_ni.nuevo')
    </div>
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

@endsection
