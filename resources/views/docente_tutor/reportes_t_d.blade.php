@extends('master.master')
@section('structure-content')
<div class="d-flex flex-column" style="min-height: 100vh;">
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
                <a href="" type="button" class="btn btn-warning m-3 position-relative" data-bs-toggle="modal"
                    data-bs-target="#avisos-modal" data-bs-whatever="@mdo" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    title="Avisos">
                    <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                        fill="currentColor" class="bi bi-chat-square-text-fill" viewBox="0 0 16 16">
                        <path
                            d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z" />
                    </svg>

                    @if(count($avisos) > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count($avisos) }}
                        </span>
                    @endif
                </a>
                @include('modal.avisos.avisos')
            </div>

            <div class="row img-font-all"
                style="border-radius: 10px; background-image: url({{ $tutor->carrera->fondo }});">

                <div class="col-5 py-2 px-3" style="border-radius: 10px; background: white; margin: 5px">
                    <p class="head-alumnos-tutor mb-1"><b>Nombre: </b>
                        {{ $tutor->nombre . ' ' . $tutor->ap_paterno . ' ' . $tutor->ap_materno }}
                    </p>
                    <p class="head-alumnos-tutor mb-1"><b>Carrera: </b> {{ $tutor->carrera->nombre_carrera }}
                    </p>

                    @if ($asigno != 0 && !($asignado[0]->semestre == 0 || $asignado[0]->grupo == 'sin asignar'))
                        <p class="head-alumnos-tutor mb-1">
                            <b>Semestres y grupos:</b>
                                @foreach ($asignado->sortBy(function($asig) {
                                    return $asig->semestre . str_pad($asig->grupo, 2, '0', STR_PAD_LEFT);
                                }) as $asig)
                                    {{ $asig->semestre }}{{ $asig->grupo }}@if(!$loop->last),@endif
                                @endforeach
                        </p>
                    @else
                        <div class="mt-1 mb-1">
                            <div class="alert alert-warning mb-0 d-flex justify-content-center"
                                role="alert" style="padding: 4px 12px; ">
                                No se ha asignado grupo.
                            </div>
                        </div>
                    @endif
                    
                    @php
                        $sgAsignados = $asignado->map(function($a){
                            return $a->semestre . '-' . $a->grupo;
                        })->toArray();
                    @endphp
                    <p class="head-alumnos-tutor mb-1"><b>Telefono:</b> {{ $tutor->telefono }} </p>
                    <p class="mb-1"> <b>Periodo: </b>{{ $inicio_p . ' - ' . $fin_p }}</p>
                </div>
                
                <div class="col-2 py-2 px-3 d-flex flex-column justify-content-center" style="border-radius: 10px; background: white; margin: 5px;">
                    <div class="d-flex justify-content-between mb-1">
                        <strong>Baja Temporal:</strong> <span>{{ $temporal }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <strong>Baja:</strong> <span>{{ $baja }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <strong>Verde:</strong> <span>{{ $verde }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <strong>Amarillo:</strong> <span>{{ $naranja }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-0">
                        <strong>Rojo:</strong> <span>{{ $rojo }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row row-tutor flex-grow-1 mt-3">
            <div class="bd-example d-flex flex-column">
                @php
                    $tieneAsignacion = $asigno != 0 && !($asignado[0]->semestre == 0 || $asignado[0]->grupo == 'sin asignar');
                @endphp

                <nav>
                    <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                        <a class="nav-link tabs_s {{ $tieneAsignacion ? 'show active' : 'disabled' }}" 
                        id="nav-home-tab" 
                        data-bs-toggle="{{ $tieneAsignacion ? 'tab' : '' }}" 
                        href="{{ $tieneAsignacion ? '#nav-home' : '#' }}" 
                        role="tab"
                        aria-controls="nav-home" 
                        aria-selected="{{ $tieneAsignacion ? 'false' : 'false' }}"
                        {{ !$tieneAsignacion ? 'onclick="return false;" style="cursor: not-allowed; opacity: 0.5;"' : '' }}>
                            Orientación
                        </a>

                        <a class="nav-link tabs_s {{ !$tieneAsignacion ? 'disabled' : '' }}" 
                        id="nav-profile-tab" 
                        data-bs-toggle="{{ $tieneAsignacion ? 'tab' : '' }}" 
                        href="{{ $tieneAsignacion ? '#nav-profile' : '#' }}" 
                        role="tab"
                        aria-controls="nav-profile" 
                        aria-selected="false"
                        {{ !$tieneAsignacion ? 'onclick="return false;" style="cursor: not-allowed; opacity: 0.5;"' : '' }}>
                            Tutor
                        </a>

                        <a class="nav-link tabs_s {{ !$tieneAsignacion ? 'show active' : '' }}" 
                        id="nav-contact-tab" 
                        data-bs-toggle="tab" 
                        href="#nav-contact" 
                        role="tab"
                        aria-controls="nav-contact" 
                        aria-selected="{{ !$tieneAsignacion ? 'true' : 'false' }}">
                            Docente
                        </a>

                        <a class="nav-link tabs_s {{ !$tieneAsignacion ? 'disabled' : '' }}" 
                        id="nav-activities-tab" 
                        data-bs-toggle="{{ $tieneAsignacion ? 'tab' : '' }}" 
                        href="{{ $tieneAsignacion ? '#nav-activities' : '#' }}" 
                        role="tab"
                        aria-controls="nav-activities" 
                        aria-selected="false"
                        {{ !$tieneAsignacion ? 'onclick="return false;" style="cursor: not-allowed; opacity: 0.5;"' : '' }}>
                            Actividades
                        </a>
                    </div>
                </nav>
                
                <div class="tab-content flex-grow-1" id="nav-tabContent">
                    <div class="tab-pane fade {{ $tieneAsignacion ? 'show active' : '' }}" 
                        id="nav-home" 
                        role="tabpanel" 
                        aria-labelledby="nav-home-tab">
                        @if($tieneAsignacion)
                            @include('docente_tutor.orientacion')
                        @else
                            <div class="alert alert-warning">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                <strong>Sección no disponible</strong><br>
                                Esta sección estará disponible una vez que el departamento de Orientación Educativa 
                                haya completado la asignación de su grupo.
                            </div>
                        @endif
                    </div>
                    
                    <div class="tab-pane fade" 
                        id="nav-profile" 
                        role="tabpanel" 
                        aria-labelledby="nav-profile-tab">
                        @if($tieneAsignacion)
                            @include('docente_tutor.tutor')
                        @else
                            <div class="alert alert-warning">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                <strong>Sección no disponible</strong><br>
                                Esta sección estará disponible una vez que el departamento de Orientación Educativa 
                                haya completado la asignación de su grupo.
                            </div>
                        @endif
                    </div>
                    
                    <div class="tab-pane fade {{ !$tieneAsignacion ? 'show active' : '' }}" 
                        id="nav-contact" 
                        role="tabpanel" 
                        aria-labelledby="nav-contact-tab">
                        @include('docente_tutor.docente')
                    </div>
                    
                    <div class="tab-pane fade" 
                        id="nav-activities" 
                        role="tabpanel" 
                        aria-labelledby="nav-activities-tab">
                        @if($tieneAsignacion)
                            @include('docente_tutor.actividades')
                        @else
                            <div class="alert alert-warning">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                <strong>Sección no disponible</strong><br>
                                Esta sección estará disponible una vez que el departamento de Orientación Educativa 
                                haya completado la asignación de su grupo.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container text-center flex-grow-1">
            <div class="row img-font-all" style="border-radius: 10px;margin-top: 30px; background: rgb(8, 2, 126)">
                <div class="col-5" style="border-radius: 10px; background: white; margin: 5px">
                    <p class="head-alumnos-tutor"><b>Orientación Educativa Se encuentra Trabajando Espera Indicaciónes</b></p>
                </div>
            </div>
        </div>
    @endif
</div>

@include('modal.alumno.add-alumno')
@include('modal.alumno.add-alumno2')

<script>
    const activeTab = localStorage.getItem('activeTab');

    if (activeTab==null) {
        const defaultTab = '#nav-home-tab';
        localStorage.setItem('activeTab', defaultTab);
        activeTab = localStorage.getItem('activeTab');
    }

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

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            localStorage.setItem('activeTab', `#${this.id}`);
        });
    });
</script>
@endsection