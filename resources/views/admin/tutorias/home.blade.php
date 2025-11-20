@extends('master.master')


@section('structure-content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <div class="container">
        <div style="text-align: right; margin: 20px">
            <a href="{{ route('orientacion.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                    class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                </svg>
            </a>
        </div>

        <div class="row">
            <div class="col d-flex flex-column flex-shrink-0">
                
                <!-- SECCIÓN TUTORES -->
                <div style="text-align: center">
                    @php $tutor = $tutoresDePeriodo->first() ?: $docentes->first(); @endphp
                    <h1>{{ $tutor->carrera->nombre_carrera ?? 'N/A' }}</h1><br>
                </div>

                <!-- FORMULARIO DE BÚSQUEDA SIEMPRE VISIBLE -->
                <div class="container m-3">
                    <div class="row justify-content-end">
                        <div class="col-md-6 offset-md-3">
                            <form class="input-group" method="POST" action="{{ route('searchTutor', $carrera) }}">
                                @csrf
                                <input name="search_tutor" type="text" class="form-control" placeholder="Buscar" aria-label="Buscar" id="search-input" value="{{ $palabra }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="search-btn">Buscar</button>
                                    <a href="{{ route('tutor.show', $carrera) }}" class="btn btn-danger" type="button" id="clear-btn">Borrar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div style="text-align: center" class="mt-4">
                    @if (count($tutoresDePeriodo) == 0 && empty($palabra))
                        <div class="alert alert-warning">Actualmente no hay tutores activos de esta carrera</div>
                    @else
                        <h1>Tutores:</h1><br>
                    @endif
                </div>

                @if (count($tutoresDePeriodo) > 0)
                    <div class="row row-tutor">

                        <table id="tutoresTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Matrícula</th>
                                    <th scope="col">Carrera</th>
                                    <th scope="col">Nombre Completo</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Domicilio</th>
                                    <th scope="col">Alumnos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tutoresDePeriodo as $item)
                                    @if ($item->carrera_id != null)
                                        <tr>
                                            <td>
                                                <img src="{{ $item->foto }}" alt="" height="50px" width="50px"
                                                    class="img-icon" style="border-radius: 40px; padding: 0px">
                                            </td>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->carrera->nombre_carrera }}</td>
                                            <td>{{ $item->nombre . ' ' . $item->ap_paterno . ' ' . $item->ap_materno }}</td>
                                            <td>{{ $item->user->email }}</td>
                                            <td>{{ $item->telefono }}</td>
                                            <td>{{ $item->domicilio }}</td>
                                            <td>
                                                <a href="{{ route('alumnos-tutor.show', $item->id) }}"
                                                    class="btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                        fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <!-- SECCIÓN DOCENTES -->
                @if (count($docentes) > 0)
                    <div style="text-align: center; margin-top: 40px;">
                        <h1>Docentes:</h1><br>
                    </div>

                    <div class="row row-tutor">
                        <table id="docentesTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Matrícula</th>
                                    <th scope="col">Carrera</th>
                                    <th scope="col">Nombre Completo</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Domicilio</th>
                                    <th scope="col">Alumnos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($docentes as $item)
                                    @if ($item->carrera_id != null)
                                        <tr>
                                            <td>
                                                <img src="{{ $item->foto }}" alt="" height="50px" width="50px"
                                                    class="img-icon" style="border-radius: 40px; padding: 0px">
                                            </td>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->carrera->nombre_carrera }}</td>
                                            <td>{{ $item->nombre . ' ' . $item->ap_paterno . ' ' . $item->ap_materno }}</td>
                                            <td>{{ $item->user->email }}</td>
                                            <td>{{ $item->telefono }}</td>
                                            <td>{{ $item->domicilio }}</td>
                                            <td style="text-align: center">
                                                <a href="{{ route('alumnos-tutor.show', $item->id) }}" {{-- esta ruta se cambiara a futuro --}}
                                                    class="btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                        fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
@endsection