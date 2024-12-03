
    <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">
        
        @if (session('hay_alumnos') == 'si')
            <div class="alert alert-danger">
                Ya está registrado!
            </div>
        @endif

        @if (session('existe_alumno') == 'no')
            <div class="alert alert-danger">
                El alumno no está registrado, puedes registrarlo en la sección Alumnos.
            </div>
        @endif
        
        <div class="col-8 d-flex align-items-center">
    <!-- Botón para agregar actividades -->
    <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addActivityModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
             class="bi bi-person-plus-fill" viewBox="0 0 16 16">
            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
            <path fill-rule="evenodd"
                  d="M13.5 5a.5.5 0 0 1 .5.57h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5
                   0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
        </svg>
        
    </a>Agregar Actividades

    <!-- Botón para descargar PDF -->
    <div class="d-flex align-items-center ms-3"> 
    <a href="{{ route('pdf-actividades') }}" class="btn btn-danger d-flex align-items-center me-2" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
        </svg>
    </a>
    <span class="ms-2">Descargar Actividades!</span> 
</div>


</div>
        
        <!-- Modal Crear Actividad-->
        <div class="modal fade" id="addActivityModal" tabindex="-1" aria-labelledby="addActivityModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        @include('tutor-alumno.add-actividades') 
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar-->
        <div class="modal fade" id="editActivityModal" tabindex="-1" aria-labelledby="editActivityModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        @include('tutor-alumno.edit-actividades') 
                    </div>
                </div>
            </div>
        </div>
        
        <div class="overflow-scroll table-responsive">
        <table class="table text-center table-striped" style="font-size: 12px">
    <thead>
        <tr>
            <th scope="col">NUMERO DE SESIONES</th>
            <th scope="col">TEMA</th>
            <th scope="col">DESCRIPCION DE LA ACTIVIDAD</th>
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
                <td>{{ $actividad->tema }}</td>
                <td>{{ $actividad->descripcion_actividad }}</td>
                <td>{{ $actividad->fecha->format('d/m/Y') }}</td> 
                <td>
    @php
        // Usar Carbon para formatear el valor del tiempo
        $hora = \Carbon\Carbon::parse($actividad->tiempo);
    @endphp
    {{ $hora->format('H:i') }} hrs <!-- Muestra la hora y los minutos -->
</td>


                <td>{{ $actividad->recursos }}</td>
                <td>
                <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Opciones
                        </button>
                        <ul class="dropdown-menu">
                            <!-- Opción Editar -->
                            <li>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editActivityModal" href="{{ route('actividades-tutoria.edit', $actividad->id) }}">Editar</a>
                            </li>
                            <!-- Opción Eliminar -->
                            <li>
                                <form action="{{ route('actividades-tutoria.destroy', $actividad->id) }}" method="POST" class="d-inline formulario-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item" onclick="return confirm('¿Estás seguro de que deseas eliminar esta actividad?')">Eliminar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


