@extends('master.master')


@section('structure-content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <div class="container" >
        <div style="text-align: right;">
            <a href="{{ route('carrera.index') }} ">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40   " fill="currentColor"
                    class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                </svg>
            </a>
        </div>
        <div class="row ">
            <div class="col d-flex flex-column flex-shrink-0">
                <div style="text-align: center">
                    <h1>
                        Lista de Tutores
                    </h1>
                </div>

                <div class="row ">

                    <table id="table" class="table table-striped" style="font-size: 10px">
                        <thead>
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Matricula</th>
                                <th scope="col">Carrera</th>
                                <th scope="col">Nombre Completo</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Domicilio</th>
                                <th scope="col">Alumnos</th>
                                <th scope="col">Reset</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $contador = 1;
                            @endphp
                            @foreach ($tutores as $item)
                                @if ($item->carrera_id != null)
                                    <tr>
                                        <td>{{ $contador++ }}</td>
                                        <td>
                                            <img src="{{ $item->foto }} " alt="" height="50px" width="50px"
                                                class="img-icon" style="border-radius: 40px; padding: 0px ">
                                        </td>

                                        <td>{{ $item->id }} </td>
                                        <td>{{ $item->carrera->nombre_carrera }}</td>
                                        <td>{{ $item->nombre . ' ' . $item->ap_paterno . ' ' . $item->ap_materno }}
                                        </td>
                                        <td>
                                            {{ $item->user->email }}
                                        </td>
                                        <td>{{ $item->telefono }} </td>
                                        <td>{{ $item->domicilio }} </td>
                                        <td>
                                            <a href="{{ route('alumnos-tutor.show', $item->id) }} "
                                                class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                                </svg>
                                            </a>
                                        </td>
                                        <th>
                                            <a class="btn btn-success" href="{{ route('resetPass', [$item->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    fill="currentColor" class="bi bi-unlock-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z" />
                                                </svg>
                                            </a>
                                        </th>
                                        <td>
                                            <form action="{{ route('tutor.destroy', $item->id) }}"
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
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
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
    </script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('eliminar') == 'ok')
    <script>
        Swal.fire(
            'Eliminado!',
            'El Docente ha sido eliminado.',
            'success'
        )
    </script>
@endif

@if (session('reset') == 'ok')
    <script>
        Swal.fire(
            'Contraseña Reseteada!',
            'La contraseña para el docente ahora es: tutor123',
            'success'
        )
    </script>
@endif

<script>
    $('.formulario-eliminar').submit(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Estas Seguro de eliminar?',
            text: "El docente se eliminara junto con todos sus registros!",
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
