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
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                          </svg>
                        
                    </a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Editar</th>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </a>
                                    @include('modal.materia.editar-materia')
                                </th>
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
                    {{ $materias->links('pagination::bootstrap-4') }}
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
