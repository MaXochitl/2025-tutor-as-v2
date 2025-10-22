@extends('master.master')
@section('structure-content')
    @if (count($periodo) > 0)
        @php

            date_default_timezone_set('America/Mexico_City');
            setlocale(LC_ALL, 'es_ES');

            $inicio = strtotime($periodo[0]->inicio);
            $fin = strtotime($periodo[0]->fin);
            $mes_1 = strtotime($periodo[0]->mes_1);
            $mes_2 = strtotime($periodo[0]->mes_2);
            $mes_3 = strtotime($periodo[0]->mes_3);
            $mes_4 = strtotime($periodo[0]->mes_4);
            $entrega_final = strtotime($periodo[0]->reporte_final);
            $fecha_actual = strtotime(date('Y-m-d', time()));

            $diassemana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'];
            $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            $inicio_p = $meses[date('n', $inicio) - 1] . '  ' . date('Y', $inicio);
            $fin_p = $meses[date('n', $fin) - 1] . '  ' . date('Y', $fin);

        @endphp

        <div class="container text-center">
            <div style="text-align: left">
                <a href="" type="button" class="btn btn-warning m-2" data-bs-toggle="modal"
                    data-bs-target="#avisos-modal" data-bs-whatever="@mdo" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    title="Avisos">
                    <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                        fill="currentColor" class="bi bi-chat-square-text-fill" viewBox="0 0 16 16">
                        <path
                            d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z" />
                    </svg>
                </a>
                @include('modal.avisos.avisos')
            </div>

            <div class="row img-font-all"
                style="border-radius: 10px;margin-top: 30px;background-image: url({{ $tutor->carrera->fondo }});">

                <div class="col-5" style="border-radius: 10px; background: white; margin: 5px">
                    <p class="head-alumnos-tutor"><b>Nombre Tutor de grupo: </b>
                        {{ $tutor->nombre . ' ' . $tutor->ap_paterno . ' ' . $tutor->ap_materno }}
                    </p>
                    <p class="head-alumnos-tutor"><b>Carrera: </b> {{ $tutor->carrera->nombre_carrera }}
                    </p>

                    @if ($asigno != 0 && !($asignado[0]->semestre == 0 || $asignado[0]->grupo == 'sin asignar'))
                        <p class="head-alumnos-tutor">
                            <b>Semestre:</b> {{ $asignado[0]->semestre }}
                            <b>Grupo:</b> {{ $asignado[0]->grupo }}
                        </p>
                    @else
                        <div class="alert alert-danger">
                            No se ha asignado grupo
                        </div>
                    @endif

                    <p class="head-alumnos-tutor"><b>Telefono:</b> {{ $tutor->telefono }} </p>
                    <p> <b>Periodo: </b>{{ $inicio_p . ' - ' . $fin_p }}</p>

                </div>
                <div class="col-2" style="border-radius: 10px; background: white; margin: 5px">
                    <table>
                        <tbody>
                            <tr>
                                <th scope="col">{{ 'Baja Temporal:' }}</th>
                                <td>{{ $temporal }}</td>
                            </tr>

                            <tr>
                                <th scope="col">{{ 'Baja:' }}</th>
                                <td>{{ $baja }}</td>
                            </tr>

                            <tr>
                                <th scope="col">{{ 'Verde:' }}</th>
                                <td>{{ $verde }}</td>
                            </tr>

                            <tr>
                                <th scope="col">{{ 'Amarillo:' }}</th>
                                <td>{{ $naranja }}</td>
                            </tr>

                            <tr>
                                <th scope="col">{{ 'Rojo:' }}</th>
                                <td>{{ $rojo }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row row-tutor">

            <div class="bd-example">
                <nav>
                    <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                        <a class="nav-link tabs_s show active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab"
                            aria-controls="nav-home" aria-selected="false">Orientación</a>

                                <a class="nav-link tabs_s" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab"
                                aria-controls="nav-profile" aria-selected="true">Tutor</a>


                        <a class="nav-link tabs_s" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-contact" role="tab"
                            aria-controls="nav-contact" aria-selected="false">Docente</a>
                            <!-- Modificacion aqui -->
                        <a class="nav-link tabs_s" id="nav-activities-tab" data-bs-toggle="tab" href="#nav-activities" role="tab"
                            aria-controls="nav-activities" aria-selected="false">Actividades</a>    
                        <!--  Hasta Aqui  -->
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        @include('docente_tutor.orientacion')
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        @include('docente_tutor.tutor')
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        @include('docente_tutor.docente')

                    </div>
                    <!-- Modificacion aqui -->
                    <div class="tab-pane fade" id="nav-activities" role="tabpanel" aria-labelledby="nav-activities-tab">
                        @include('docente_tutor.actividades')
                    </div>
                    <!--  Hasta Aqui  -->
                </div>
            </div>
        @else
            <div class="container text-center">
                <div class="row img-font-all" style="border-radius: 10px;margin-top: 30px; background: rgb(8, 2, 126)">
                    <div class="col-5" style="border-radius: 10px; background: white; margin: 5px">
                        <p class="head-alumnos-tutor"><b>Orientación Educativa Se encuentra Trabajando Espera Indicaciónes
                            </b>
                        </p>
                    </div>
                </div>
            </div>
    @endif
    @include('modal.alumno.add-alumno')
    @include('modal.alumno.add-alumno2')

    <script>
        // Obtener el valor almacenado en localStorage
        const activeTab = localStorage.getItem('activeTab');

        // Si no hay un valor almacenado, establecer una pestaña por defecto y almacenarla en localStorage
        if (activeTab==null) {
            const defaultTab = '#nav-home-tab'; // Cambia esto a la pestaña por defecto que desees
            localStorage.setItem('activeTab', defaultTab);
            activeTab = localStorage.getItem('activeTab');
        }

        // Activar la pestaña almacenada en localStorage y desactivar las demás
        const tabs = document.querySelectorAll('.tabs_s');
        tabs.forEach(tab => {
            const tabId = `#${tab.id}`;
            if (activeTab === tabId) {
                tab.classList.add('active');
                const tabPane = document.querySelector(activeTab.replace('-tab', ''));
                if (tabPane) {
                    tabPane.classList.add('active', 'show');
                }
            } else {
                tab.classList.remove('active');
                const tabPane = document.querySelector(tabId.replace('-tab', ''));
                if (tabPane) {
                    tabPane.classList.remove('active', 'show');
                }
            }
        });

        // Agregar un evento de clic a cada pestaña para guardar la selección en localStorage
        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                // Guardar la pestaña activa en localStorage
                localStorage.setItem('activeTab', `#${this.id}`);
            });
        });
    </script>

@endsection
