<div class="row row-tutor">
    <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">
        <div class="col-8">
            <div class="col-8 d-flex align-items-center gap-2">
                <a href="{{ route('alumnos-tutor.create') }} " type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        <path fill-rule="evenodd"
                            d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                </a> <span style="margin-left: 10px;">Nuevo alumno tutorado</span> <!-- Añadido un margen a la izquierda -->
                <br>

                <div class="col-8 d-flex align-items-center gap-3">
                    <form action="{{ route('reporte.pdf', ['id' => $tutor->id]) }}" method="GET" target="_blank">
                        <button type="submit" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="25" fill="currentColor"
                                class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                            </svg>
                        </button>
                    </form>
                    Reporte semestral
                </div>
            </div>
        </div>
        <br>

        @if (session('hay_alumnos') == 'si')
            <div class="alert alert-danger">
                Ya esta registrado!
            </div>
        @endif

        @if (session('existe_alumno') == 'no')
            <div class="alert alert-danger">
                Alumno no encontrado. Verifique el NC o regístrelo en "Alumnos".
            </div>
        @endif

        <!-- Ordenar Semestres de tabla periodo_tutorado y Grupos de tabla alumnos -->
        @php
            // Ordenamos por semestre y luego por grupo
            $alumnosOrdenados = $alumnos_tutor->sortBy([
                ['semestre', 'asc'],
                ['alumno.grupo', 'asc']
            ]);

            // Agrupamos por semestre y grupo
            $grupos = $alumnosOrdenados->groupBy(function($alumno) {
                return $alumno->semestre . '-' . $alumno->alumno->grupo;
            });
        @endphp

        @foreach ($grupos as $grupoKey => $alumnosGrupo)
            @php
                $partes = explode('-', $grupoKey);
                $semestre = $partes[0];
                $grupo = $partes[1];
                $sgActual = $semestre . '-' . $grupo;   
            @endphp

            <!--A. comparar arreglo sgActual de semestregrupos asignados al tutor con los que se a asignado el el tutor-->
            @if(!in_array($sgActual, $sgAsignados))
                <h5 class="mt-3 mb-4 text-danger">Semestre: {{ $semestre }} - Grupo: {{ $grupo }} (No asignado)</h5>
            @else
                <h5 class="mt-3 mb-4">Semestre: {{ $semestre }} - Grupo: {{ $grupo }}</h5>
            @endif

        <div class="table-responsive pb-5">
            <table class="table text-start table-striped" style="font-size: 12px"> <!--texto alineado a la izq-->
                <thead>
                    <tr>
                        <!--th scope="col">SG</th> //test-->
                        <th class="title-table" scope="col">N° CONTROL</th>
                        <th class="title-table" scope="col">NOMBRE COMPLETO</th>
                        <th class="title-table" scope="col">TELEFONO</th>
                        <th class="text-center" scope="col">MES 1</th>
                        <th class="text-center" scope="col">SEGUIMIENTO O.E. </th>
                        <th class="text-center" scope="col">MES 2</th>
                        <th class="text-center" scope="col">SEGUIMIENTO O.E. </th>
                        <th class="text-center" scope="col">MES 3</th>
                        <th class="text-center" scope="col">SEGUIMIENTO O.E. </th>
                        <th class="text-center" scope="col">MES 4</th>
                        <th class="text-center" scope="col">SEGUIMIENTO O.E. </th>
                        <th scope="col">RESULTADOS</th>
                        <th scope="col">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($alumnosGrupo as $alumnos)
                        <tr>

                            <!--<td>{{ $alumnos->semestre }}{{ $alumnos->alumno->grupo}}</td> test-->
                            <td style="background: {{ $alumnos->semaforo->fondo }} ">
                                <p>{{ $alumnos->alumno->id }} </p>
                                {{ $alumnos->semaforo->nombre }}
                            </td>
                            <td>{{ $alumnos->alumno->nombre . ' ' . $alumnos->alumno->ap_paterno . ' ' . $alumnos->alumno->ap_materno }}
                            </td>
                            <td>
                                {{ $alumnos->alumno->telefono }}
                            </td>

                        <!--MES 1 btn seguim invicible-->
                        @if (($fecha_actual >= $inicio && $fecha_actual <= $mes_1) || $altera_entrega->mes_1)
                            <td class="casilla editable"
                                data-bs-toggle="modal"
                                data-bs-target="#month1Modal{{ $alumnos->id }}"
                                data-bs-toggle="tooltip"
                                title="Seguimiento 1">
                                    <div style="height: 5px; background:{{ $alumnos->lights[0]->semaforos[0]->fondo }};"></div>
                                    <div>{{ ucfirst($alumnos->mes_1) }}</div>
                            </td>
                            @include('modal.meses.mes1')
                        @else
                            <td class="text-muted" data-bs-toggle="tooltip" title="Seguimiento 1 bloqueado">
                                <div style="height: 5px; background:{{ $alumnos->lights[0]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->mes_1) }}</div>
                            </td>
                        @endif

                            <td>
                                <div>
                                    {{ ucfirst($alumnos->oe_1) }}
                                </div>
                            </td>

                        <!--MES 2 btn seguim invicible-->
                        @if (($fecha_actual >= $mes_1 && $fecha_actual <= $mes_2) || $altera_entrega->mes_2)
                            <td class="casilla editable"
                                data-bs-toggle="modal"
                                data-bs-target="#month2Modal{{ $alumnos->id }}"
                                data-bs-toggle="tooltip"
                                title="Seguimiento 2">
                                <div style="height: 5px; background:{{ $alumnos->lights[1]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->mes_2) }}</div>
                            </td>
                            @include('modal.meses.mes2')
                        @else
                            <td class="text-muted" data-bs-toggle="tooltip" title="Seguimiento 2 bloqueado">
                                <div style="height: 5px; background:{{ $alumnos->lights[1]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->mes_2) }}</div>
                            </td>
                        @endif
                            <td>
                                <div>
                                    {{ ucfirst($alumnos->oe_2) }}
                                </div>
                            </td>

                        <!--MES 3 btn seguim invicible-->
                        @if (($fecha_actual >= $mes_2 && $fecha_actual <= $mes_3) || $altera_entrega->mes_3)
                            <td class="casilla editable"
                                data-bs-toggle="modal"
                                data-bs-target="#month3Modal{{ $alumnos->id }}"
                                data-bs-toggle="tooltip"
                                title="Seguimiento 3">
                                <div style="height: 5px; background:{{ $alumnos->lights[2]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->mes_3) }}</div>
                            </td>
                            @include('modal.meses.mes3')
                        @else
                            <td class="text-muted" data-bs-toggle="tooltip" title="Seguimiento 3 bloqueado">
                                <div style="height: 5px; background:{{ $alumnos->lights[2]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->mes_3) }}</div>
                            </td>
                        @endif

                            <td>
                                {{ ucfirst($alumnos->oe_3) }}
                            </td>

                        <!--MES 4 btn seguim invicible-->
                        @if (($fecha_actual >= $mes_3 && $fecha_actual <= $mes_4) || $altera_entrega->mes_4)
                            <td class="casilla editable"
                                data-bs-toggle="modal"
                                data-bs-target="#month4Modal{{ $alumnos->id }}"
                                data-bs-toggle="tooltip"
                                title="Seguimiento 4">
                                <div style="height: 5px; background:{{ $alumnos->lights[3]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->mes_4) }}</div>
                            </td>
                            @include('modal.meses.mes4')
                        @else
                            <td class="text-muted" data-bs-toggle="tooltip" title="Seguimiento 4 bloqueado">
                                <div style="height: 5px; background:{{ $alumnos->lights[3]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->mes_4) }}</div>
                            </td>
                        @endif

                            <td>
                                <div>
                                    {{ ucfirst($alumnos->oe_4) }}
                                </div>
                            </td>

                        <!--RF con casilla-->
                        @if (($fecha_actual >= $mes_4 && $fecha_actual <= $entrega_final) || $altera_entrega->mes_5)
                            <td class="casilla editable text-center" 
                                data-bs-toggle="tooltip" 
                                title="Reporte Final"
                                onclick="window.location='{{ route('reporte.show', $alumnos->id) }}'">
                                <div style="height: 5px; background:{{ $alumnos->lights[4]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->reporte_final) }}</div>
                            </td>
                        @else
                            <td class="text-muted" data-bs-toggle="tooltip" title="Reporte final bloqueado">
                                <div style="height: 5px; background:{{ $alumnos->lights[4]->semaforos[0]->fondo }};"></div>
                                <div>{{ ucfirst($alumnos->reporte_final) }}</div>
                            </td>
                        @endif
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                        Opciones
                                    </button>
                                    <ul class="dropdown-menu mini-dropdown">
                                        <li>
                                            <button type="button"
                                                    class="dropdown-item canalizacion-btn"
                                                    data-id="{{ $alumnos->alumno->id }}"
                                                    data-periodo="{{ $alumnos->periodo_id }}">
                                                Atención Individual
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button"
                                                    class="dropdown-item text-primary actualizar-alumno-btn"
                                                    data-id="{{ $alumnos->id }}"
                                                    data-alumno-id="{{ $alumnos->alumno->id }}"
                                                    data-semestre="{{ $alumnos->semestre }}"
                                                    data-grupo="{{ $alumnos->alumno->grupo }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#updateAlumnoModal">
                                                    Actualizar
                                            </button>
                                        </li>
                                        <li>
                                            <form action="{{ route('alumnos-tutor.destroy', $alumnos->id) }}"
                                                method="POST"
                                                class="formulario-eliminar">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="dropdown-item text-danger">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>

<!-- Modal Atencion individual -->
<div class="modal fade" id="modalFormulario" tabindex="-1"
    aria-labelledby="modalFormularioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalFormularioLabel">Atención Individual</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <div id="formContent">
                    <form id="formAlumno" method="POST" action="{{ route('atenciones.store') }}">
                        @csrf

                        <!-- Número de Control -->
                        <div class="form-group mb-3">
                            <label for="alumno_id">Número de control</label>
                            <input type="text" name="alumno_id" id="alumno_id" class="form-control" readonly>
                        </div>

                        <!-- Campo oculto para periodo_id -->
                        <input type="hidden" name="periodo_id" id="periodo_id">

                        <!-- Atención individual -->
                        <div class="form-group mb-3">
                            <label for="atencion_individual">¿Atención individual?</label>
                            <select id="atencion_individual" class="form-select" required>
                                <option value="">Selecciona</option>
                                <option value="Individual">Sí</option>
                                <option value="No">No</option>
                            </select>
                            <input type="hidden" name="atencion" id="atencion">
                        </div>

                        <!-- Canalizado -->
                        <div class="form-group mb-3">
                            <label for="canalizado">¿Requiere canalización a algún área?</label>
                            <select name="canalizado" id="canalizado" class="form-select" disabled required>
                                <option value="">Selecciona</option>
                                <option value="SI">Sí</option>
                                <option value="NO">No</option>
                            </select>
                        </div>

                        <!-- Área canalizada -->
                        <div class="form-group mb-3">
                            <label for="area_canalizada">Área canalizada</label>
                            <input type="text" name="area_canalizada" id="area_canalizada"
                                class="form-control" disabled>
                        </div>

                        <div class="modal-footer">
                            <button type="button" 
                                    id="deleteAtencionBtn" 
                                    class="btn btn-danger me-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                                Eliminar atencion
                            </button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
@include("modal.alumno.add-alumno")
@include("modal.alumno.update-alumno")

<script>
document.addEventListener("DOMContentLoaded", function () {

    const modalElement = document.getElementById("modalFormulario");
    const modal = new bootstrap.Modal(modalElement);

    const atencionSelect = document.getElementById("atencion_individual");
    const atencionHidden = document.getElementById("atencion");

    const canalizadoSelect = document.getElementById("canalizado");
    const areaInput = document.getElementById("area_canalizada");

    // Función para habilitar/deshabilitar campos según la selección
    atencionSelect.addEventListener("change", function () {
        const value = this.value;
        atencionHidden.value = value;

        if (value === "Individual") {
            canalizadoSelect.disabled = false;
        } else {
            canalizadoSelect.value = "";
            canalizadoSelect.disabled = true;
            areaInput.value = "";
            areaInput.disabled = true;
        }
    });

    // Habilitar área canalizada si se selecciona "Sí" en canalizado
    canalizadoSelect.addEventListener("change", function () {
        if (this.value === "SI") {
            areaInput.disabled = false;
        } else {
            areaInput.value = "";
            areaInput.disabled = true;
        }
    });

    // Cargar datos cuando se hace clic en el botón
    document.querySelectorAll(".canalizacion-btn").forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            
            let alumnoId = this.getAttribute("data-id");
            let periodoId = this.getAttribute("data-periodo"); // CAPTURAR periodo_id

            // Validar que exista el periodo_id
            if (!periodoId) {
                console.error("No se encontró el periodo_id");
                return;
            }

            // Resetear formulario
            document.getElementById("alumno_id").value = alumnoId;
            document.getElementById("periodo_id").value = periodoId; // ASIGNAR periodo_id
            
            atencionSelect.value = "";
            atencionHidden.value = "";
            canalizadoSelect.value = "";
            canalizadoSelect.disabled = true;
            areaInput.value = "";
            areaInput.disabled = true;
            
            // Ocultar el botón de eliminar inicialmente
            const deleteBtn = document.getElementById("deleteAtencionBtn");
            if (deleteBtn) {
                deleteBtn.style.display = "none";
            }

            // CORRECCIÓN: Hacer fetch con periodo_id en la URL
            fetch(`/atenciones/${alumnoId}?periodo_id=${periodoId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Datos recibidos:', data);

                    // Asignar número de control
                    document.getElementById("alumno_id").value = data.id || alumnoId;

                    // Si existe una atención previa
                    if (data.exists && data.atencion) {
                        
                        // Mostrar el botón de eliminar
                        document.getElementById("deleteAtencionBtn").style.display = "inline-block";
                        
                        // Configurar atención individual
                        if (data.atencion === "Individual") {
                            atencionSelect.value = "Individual";
                            atencionHidden.value = "Individual";
                            canalizadoSelect.disabled = false;

                            // Configurar canalizado
                            if (data.canalizado) {
                                canalizadoSelect.value = data.canalizado;
                                
                                // Si está canalizado, habilitar y llenar área
                                if (data.canalizado === "SI") {
                                    areaInput.disabled = false;
                                    areaInput.value = data.area_canalizada || "";
                                }
                            }
                        } else {
                            // Si no es individual
                            atencionSelect.value = "No";
                            atencionHidden.value = "No";
                        }
                    }

                    // Mostrar el modal
                    modal.show();
                })
                .catch(error => {
                    console.error("Error al cargar datos:", error);
                    
                    // Mostrar el modal incluso si hay error
                    modal.show();
                    
                    // Opcional: mostrar mensaje en consola en lugar de alert
                    console.warn("No se pudieron cargar datos previos, mostrando formulario vacío");
                });
        });
    });

    // CORRECCIÓN: Manejar el botón de eliminar con periodo_id
    const deleteBtn = document.getElementById("deleteAtencionBtn");
    
    if (deleteBtn) {
        deleteBtn.addEventListener("click", function() {
            const alumnoId = document.getElementById("alumno_id").value;
            const periodoId = document.getElementById("periodo_id").value; // OBTENER periodo_id
            
            if (!alumnoId || !periodoId) {
                console.error("ID de alumno o periodo no válido");
                return;
            }
            
            // Mostrar indicador de carga en el botón
            const originalText = this.innerHTML;
            this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Eliminando...';
            this.disabled = true;

            // CORRECCIÓN: Enviar periodo_id en la URL
            fetch(`/atenciones/${alumnoId}?periodo_id=${periodoId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al eliminar');
                }
                return response.json();
            })
            .then(data => {
                // Cerrar el modal
                modal.hide();

                // Mostrar mensaje de éxito (opcional)
                console.log(data.message);

                // Recargar la página para reflejar los cambios
                window.location.reload();
            })
            .catch(error => {
                console.error("Error:", error);
                
                // Restaurar el botón
                this.innerHTML = originalText;
                this.disabled = false;
            });
        });
    }
});
</script>

<style>
    .mini-dropdown {
        font-size: 12px !important;   /* letras pequeñas */
        padding: 4px !important;      /* menos espacio */
        min-width: 120px !important;  /* menú más pequeño */
    }

    .mini-dropdown .dropdown-item {
        padding: 4px 8px !important;  /* botones más compactos */
    }
</style>