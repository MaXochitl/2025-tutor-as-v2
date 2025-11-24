<div class="row row-tutor">
    <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">
        
        <div class="col-12 d-flex align-items-center gap-3">
            <!-- Botón para agregar actividades -->  
            <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addActivityModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                    <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0"/>
                </svg>
            </a> Agregar actividades
        
            <!-- Botón para abrir el modal -->
            <div class="col-6 d-flex align-items-center gap-2">
                <button type="button" class="btn btn-danger d-flex align-items-center me-2" data-bs-toggle="modal" data-bs-target="#nombreModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                    </svg>
                </button>Descargar actividades
            </div>
        </div>
    

            <!-- Modal para solicitar el nombre -->
            <div class="modal fade" id="nombreModal" tabindex="-1" aria-labelledby="nombreModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <form id="pdfForm" action="{{ route('pdf-actividades') }}" method="POST" target="_blank">
                    @csrf
                    <div class="modal-header bg-white text-black">
                    <h5 class="modal-title" id="nombreModalLabel">Nombre del coordinador de tutorías</h5>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Escribir nombre" required>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Generar PDF</button>
                    </div>
                </form>
                </div>
            </div>
            </div>

        

        <!-- Modal para el nombre del jefe de carrera-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actividades PDF</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="pdfForm" action="{{ route('pdf-actividades') }}" method="POST" target="_blank">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre del Coordinador de tutorías por programa eduacativo (Jefe de Carrera):</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Ingresa tu nombre" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Generar PDF</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <br>
        <div class="overflow-scroll table-responsive">
            <table class="table table-bordered text-start table-striped" style="font-size: 12px">
                <thead>
                    <tr>
                        <th scope="col">N° DE SESIONES</th>
                        <th scope="col">TEMA</th>
                        <th scope="col">DESCRIPCIÓN DE LA ACTIVIDAD</th>
                        <th scope="col">FECHA</th>
                        <th scope="col">TIEMPO</th>
                        <th scope="col">RECURSOS</th>
                        <th scope="col">OPCIONES</th>
                    </tr>
                </thead>
            <tbody>
                @foreach ($actividades as $index => $actividad)
                    <tr>
                        <td>{{ $index + 1 }}</td> 
                        <td>{{ ucfirst($actividad->tema) }}</td>
                        <td>{{ ucfirst($actividad->descripcion_actividad) }}</td>
                        <td>{{ $actividad->fecha->format('d/m/Y') }}</td> 
                        <td>
                                @php
                                        $hora = \Carbon\Carbon::parse($actividad->tiempo);
                                @endphp
                                {{ $hora->format('H:i') }} hrs </td>
                        <td>{{ ucfirst($actividad->recursos) }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Opciones
                                </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-actividad-{{ $actividad->id }}">
                                                    Editar
                                            </a>
                                        </li>
                                    
                                        <li>
            
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $actividad->id }}">
                                                    Eliminar
                                            </button>
                                        </li>
                                    </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>

            @foreach ($actividades as $actividad)
                @include('tutor-alumno.edit-actividades', ['actividad' => $actividad])
                @include('tutor-alumno.delete-actividades', ['actividad' => $actividad])
                
            @endforeach
        </div>
    </div>
</div>
@include('tutor-alumno.add-actividades')
