@extends('master.master')


@section('structure-content')


    <div class="container">

        <div style="text-align: right; margin: 20px">
            <a href="{{ route('evaluacion.index') }} ">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40   " fill="currentColor"
                    class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                </svg>
            </a>
        </div>
        <div class="row ">

            <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">
                <div style="text-align: center">
                    <h1>
                        LISTA DE COLORES
                    </h1>
                </div>
                <div class="overflow-scroll" style="height: 500px">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">COLOR</th>
                                <th scope="col">DESCRIPCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colores as $item)

                                <tr>

                                    <td>
                                        <div class="btn "
                                            style="background: {{ $item->codigo }}; width: 80px; height: 90px;"></div>
                                    </td>
                                    <td>
                                        <p>
                                            {{ $item->caracteristicas }}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
