@extends('master.master')
@section('structure-content')

    <div class="container" style="margin-top: 10px">
        <div class="row col-md-10 text-center shadow-lg p-3 mb-5 bg-body rounded " style="margin: auto">
            <h4>Reporte final de: </h4>
            <h4>{{ $periodo_tutorado->alumno->nombre . ' ' . $periodo_tutorado->alumno->ap_paterno . ' ' . $periodo_tutorado->alumno->ap_materno }}
            </h4>

            <div class="row m-2">

                <div class="col">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <label for="">Materias Aprobadas</label>
                        <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#materiaModal" data-bs-whatever="@mdo">
                            Agregar
                        </a>
                        @if (count($materia_aprobadas) != 0)
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Materia</th>
                                        <th scope="col">Quitar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($materia_aprobadas as $approved)
                                        <tr>
                                            <th scope="row">
                                                {{ $approved->materia->nombre }}
                                            </th>

                                            <td>
                                                <form
                                                    action="{{ route('removMateria.removMateria', [$periodo_tutorado->id, $approved->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                            fill="currentColor" class="bi bi-x-square-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>

                        @endif
                        @include('modal.materia.add-approved')

                    </div>

                </div>
                <div class="col">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <label for="">Materias Reprobadas</label>
                        <a href="{{ route('alumnos-tutor.create') }} " type="button" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#materiaFailed" data-bs-whatever="@mdo">
                            Agregar
                        </a>
                        @if (count($materia_reprobadas) != 0)

                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Materia</th>
                                        <th scope="col">Quitar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($materia_reprobadas as $failed)
                                        <tr>
                                            <th scope="row">
                                                {{ $failed->materia->nombre }}
                                            </th>

                                            <td>
                                                <form
                                                    action="{{ route('removMateria.removMateria', [$periodo_tutorado->id, $failed->id]) }} "
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                            fill="currentColor" class="bi bi-x-square-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        @include('modal.materia.add-failed')
                    </div>
                </div>
            </div>
            <div class="form-group  col-md-6 row " style="margin: auto">
                <form method="POST" action="{{ route('seguimiento-alumno.seguimiento', [$periodo_tutorado->id, 5]) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="seguimiento">Describe Reporte</label>
                        <textarea style="text-align: left" name="seguimiento" class="form-control"
                            placeholder="Describe reporte"
                            id="seguimiento">{{ $periodo_tutorado->reporte_final }}</textarea>
                    </div>
                    <div>
                        <label for="color" class="col-form-label">Color</label>
                        <select name="color" class="form-select" aria-label="Default select example">
                            @foreach ($semaforo as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <div style="text-align: center">
                            <a href="{{ route('reportes_tutor.show', $periodo_tutorado->tutor_id) }}" type="buutton"
                                class="btn btn-danger" style="margin-top: 20px">Cancelar</a>
                            <button type="submit" class="btn btn-primary" style="margin-top: 20px">Guardar</button>
                        </div>
                    </div>
                </form>


            </div>


        </div>
    </div>
@endsection
