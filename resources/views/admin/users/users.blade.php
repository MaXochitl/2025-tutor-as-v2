    @extends('master.master')


    @section('structure-content')
        <div class="container">
            <div class="m-5 text-center">
                <h1>Usuarios y Roles</h1>
            </div>
            <div>
                <a href="" class="editButton btn btn-primary rounded-circle" data-bs-toggle="modal"
                    data-bs-target="#m-new-user">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        <path fill-rule="evenodd"
                            d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                </a>
            </div>
            <div class="d-md-flex justify-content-md-end">
                <form method="GET" action="{{ route('usersAdmin.index') }}">
                    @csrf
                    <div class="btn-group">
                        <input name="busqueda" type="text" id="searchInput" class="form-control"
                            placeholder="Buscar por nombre">
                        <button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg></button>
                        <a href="{{ route('usersAdmin.index') }} " class="btn btn-success">
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
            <table class="table table-striped mt-2">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Editar </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->name }}</th>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles[0]->name }} </td>
                            <td>
                                <button class="editButton btn btn-warning rounded-circle" data-bs-toggle="modal"
                                    data-bs-target="#m-user-edit{{ $user->id }}">
                                    <svg style="color:white" xmlns="http://www.w3.org/2000/svg" width="25"
                                        height="25" fill="currentColor" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z" />
                                    </svg>
                                </button>
                                @include('admin.users.m_user_edit')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
        @include('admin.users.m_new_user');


        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        @if (session('create') == 'no')
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'No se pudo Crear',
                    text: 'El nombre o correo ya se encuantra registrado',
                    confirmButtonText: 'Aceptar'
                });
            </script>
        @endif
    @endsection
