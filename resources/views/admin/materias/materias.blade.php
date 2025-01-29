@extends('master.master')


@section('structure-content')


    <div class="container">
        <div class="row ">

            <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px; text-align: center">
                <div>
                    <h1>
                        Lista de Materias
                    </h1>
                </div>
                <div class="text-left p-2">
                    <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#new-materia-modal" data-bs-whatever="@mdo">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg>

                    </a>
                </div>
                <div class="d-md-flex justify-content-md-end">
                    <form method="GET" action="{{ route('searchMateria') }} ">
                        @csrf
                        <div class="btn-group">
                            <input name="busqueda" type="text" id="searchInput" class="form-control"
                                placeholder="Buscar por nombre" value="{{ $palabra }}">
                            <button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                            <a href="{{ route('materia.index') }} " class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                    <path
                                        d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                </svg>
                            </a>
                        </div>
                    </form>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Editar</th>
                            <th scope="col">Clave</th>
                            <th scope="col">Materia</th>
                            <th scope="col">Semestre</th>
                            <th scope="col">Carrera</th>
                            @can('solo.admin')
                                <th scope="col">Eliminar</th>
                            @endcan

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materias as $mater)
                            <tr>
                                <th scope="row">
                                    <a type="button" class="btn btn-warning" style="color: white" data-bs-toggle="modal"
                                        data-bs-target="#edit-m-{{ $mater->id }}" data-bs-whatever="@mdo">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </a>
                                    @include('modal.materia.editar-materia')
                                </th>
                                <td>{{ $mater->clave }}</td>
                                <td>{{ $mater->nombre }} </td>
                                <td>{{ $mater->semestre }} </td>
                                <td>{{ $mater->carrera->nombre_carrera }} </td>
                                @can('solo.admin')
                                    <td>
                                        <div>
                                            <form class="form-delete-m" action="{{ route('materia.destroy', $mater->id) }} "
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endcan

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="padding: 20px; text-align: center">
                    {{ $materias->appends(['busqueda' => request()->get('busqueda')])->links('pagination::bootstrap-4') }}

                </div>
            </div>
        </div>

    </div>

    @can('solo.tutor')
        @include('modal.materia.new-materia')
    @endcan
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'La materia se ha eliminado.',
                'success'
            )
        </script>
    @endif

    @if (session('error') == 'clave')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: 'Error',
                    text: 'La clave ya existe, intenta con otra.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    timer: 4000
                });
            });
        </script>
    @endif


    <script>
        $('.form-delete-m').submit(function(e) {
            e.preventDefault();


            Swal.fire({
                title: 'Estas Seguro de eliminar?',
                text: "La materia se eliminara definitivamente",
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

@endsection
