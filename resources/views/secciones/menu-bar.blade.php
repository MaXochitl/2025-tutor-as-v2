@can('solo.admin')
    <div id="sidebar" class="sidebar">
        <div class="toggle-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                <path fill-rule="evenodd"
                    d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
            </svg>
        </div>

        <div class="text-center" style="background: white">
            <img src="/tutores/logo.png">
        </div>

        <ul class="menu">
            <li><a class="enlaces" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class=" icono izquierda bi bi-card-checklist" viewBox="0 0 16 16">
                        <path
                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                        <path
                            d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                    </svg>
                    Evaluacion
                    <svg class="icono derecha" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-compact-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z" />
                    </svg> </a>
                <ul>
                    <li><a class="enlaces" href="{{ route('evaluacion.create') }}">Resultados</a></li>
                    <li><a class="enlaces" href="{{ route('periodo-eval.index') }}">Periodo Evaluacion</a></li>
                </ul>
            </li>


            <li><a class="enlaces" href="#">
                    <svg class="icono izquierda" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    Nuevo<svg class="icono derecha" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-chevron-compact-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z" />
                    </svg>
                </a>
                <ul>

                    <li>
                        <a class="enlaces" href="#" data-bs-toggle="modal" data-bs-target="#aviso-modal"
                            data-bs-whatever="@mdo">Aviso</a>
                    </li>

                    <li>
                        <a class="enlaces" href="#" data-bs-toggle="modal" data-bs-target="#periodo-t-modal"
                            data-bs-whatever="@mdo">Periodo</a>
                    </li>

                    <li>
                        <a class="modal-bar" href="{{ route('alumnos.create') }} " data-bs-toggle="modal"
                            data-bs-target="#alumno-modal" data-bs-whatever="@mdo">Alumno</a>
                    </li>


                    <li>
                        <a class="modal-bar" href="{{ route('carrera.create') }}" data-bs-toggle="modal"
                            data-bs-target="#carrera-modal" data-bs-whatever="@mdo">Carrera</a>
                    </li>

                    <li>
                        <a class="enlaces" href="#" data-bs-toggle="modal" data-bs-target="#new-materia-modal"
                            data-bs-whatever="@mdo">Materia</a>
                    </li>

                </ul>
            </li>

            <li><a class="enlaces" href="#">
                    <svg class="icono izquierda" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                        <path
                            d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                    </svg>
                    Listas <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class=" icono derecha bi bi-chevron-compact-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z" />
                    </svg></a>
                <ul>
                    <li><a class="enlaces" href="{{ route('tutor.index') }} ">Tutores</a></li>
                    <li><a class="enlaces" href="{{ route('alumnos.index') }}">Alumnos</a></li>
                    <li><a class="enlaces" href="{{ route('periodo-tutorado.index') }} ">Periodos</a></li>
                    <li><a class="enlaces" href="{{ route('materia.index') }} ">Materias</a></li>
                    <li><a class="enlaces" href="{{ route('historial.index') }}">Archivados</a> </li>
                    <li><a class="enlaces" href="{{ route('carrera.index') }} ">Carreras</a></li>
                </ul>
            </li>

            <li><a class="enlaces" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="icono izquierda bi bi-clipboard-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                        <path
                            d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                        <path
                            d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                    </svg>
                    Asignaciones <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="icono derecha bi bi-chevron-compact-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z" />
                    </svg>
                </a>
                <ul>
                    <li><a class="enlaces" href="{{ route('asignaciones.index') }} ">Asignaciónes Tutores</a></li>
                    <li><a class="enlaces" href="{{ route('pdf.create') }} ">Constancias</a> </li>
                    <li><a class="enlaces" href="{{ route('datospdf.index') }} ">Archivos</a></li>

                </ul>
            </li>

        </ul>
    </div>


    @include('modal.carrera.nuevo')
    @include('modal.periodo.periodo-tutorado')
    @include('modal.materia.new-materia')
    @include('modal.avisos.nuevo-aviso')
    @include('modal.alumno.nuevo')
    @include('modal.carrera.nuevo')
@endcan
