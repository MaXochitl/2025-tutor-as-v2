@extends('master.master')


@section('structure-content')
    <div class="row p-4">

        <div class="row mb-9">

            <div class="row text-center col-md-8 shadow-lg p-3 mb-2"
                style="margin: auto;border-radius: 17px; background: rgb(0, 26, 130); color: white">
                <h3>DATOS CONSTANCIA Y MEMORANDUM</h3>
            </div>

            <div class="row col-md-10 shadow-lg p-3 " style="margin: auto;border-radius: 17px;background: white">
                <table class="table table-sm table-bordered text-center ">
                    <thead>
                        <tr>
                            <th rowspan=" 2" scope="col">EDITAR</th>
                            <th rowspan="2" scope="col">NOMBRE ARCHIVO</th>
                            <th rowspan="2" scope="col">DESTINATARIO</th>
                            <th colspan="2" scope="col">FIRMA 1</th>
                            <th colspan="2" scope="col">FIRMA 2</th>
                            <th colspan="2" scope="col">FIRMA 3</th>

                        </tr>
                        <tr>
                            <th>NOMBRE</th>
                            <th>CARGO</th>
                            <th>NOMBRE</th>
                            <th>CARGO</th>
                            <th>NOMBRE</th>
                            <th>CARGO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $item)

                            <tr>
                                <th scope="row" style="width: 20px;">
                                    <a style="color: white" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#datos-constancia{{ $item->id }}" data-bs-whatever="@mdo">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </a>
                                    @include('modal.constancias.datos')
                                </th>
                                <td>{{ $item->nombre_archivo }}</td>
                                <td>{{ $item->destinatario }}</td>
                                <td>{{ $item->atentamente_1 }} </td>
                                <td>{{ $item->cargo }} </td>
                                <td>{{ $item->atentamente_2 }} </td>
                                <td>{{ $item->cargo_2 }} </td>
                                <td>{{ $item->atentamente_3 }} </td>
                                <td>{{ $item->cargo_3 }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
