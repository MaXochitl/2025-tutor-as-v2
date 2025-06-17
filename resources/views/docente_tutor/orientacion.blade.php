
<div class="row row-tutor">
    <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">
        <div class="col-8">
            <div class="col-8 d-flex align-items-center">
                <a href="{{ route('alumnos-tutor.create') }} " type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        <path fill-rule="evenodd"
                            d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                </a> Agregar alumnos Tutorados!
                <br>

                <div class="col-8" style="margin-top: 15px">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#jefeDepartamentoModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="25" fill="currentColor"
                            class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                        </svg>
                    </button>Descargar Reporte Semestral del Tutor
                </div>

            </div>
        </div>

        @if (session('hay_alumnos') == 'si')
            <div class="alert alert-danger">
                Ya esta registrado!
            </div>
        @endif

        @if (session('existe_alumno') == 'no')
            <div class="alert alert-danger">
                El alumno no esta registrado puedes registrarlo en la seccion Alumnos
            </div>
        @endif
        <div class="overflow-scroll">
            <table class="table text-center table-striped" style="font-size: 12px">
                <thead>
                    <tr>
                        <th class="title-table" scope="col">N° CONTROL</th>
                        <th class="title-table" scope="col">NOMBRE COMPLETO</th>
                        <th class="title-table" scope="col">TELEFONO</th>
                        <th scope="col">MES 1</th>
                        <th scope="col">SEGUIMIENTO O.E. </th>
                        <th scope="col">MES 2</th>
                        <th scope="col">SEGUIMIENTO O.E. </th>
                        <th scope="col">MES 3</th>
                        <th scope="col">SEGUIMIENTO O.E. </th>
                        <th scope="col">MES 4</th>
                        <th scope="col">SEGUIMIENTO O.E. </th>
                        <th scope="col">RESULTADOS</th>
                        <th scope="col">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $contador = 1;

                    @endphp
                    @foreach ($alumnos_tutor as $alumnos)
                        <tr>

                            <td style="background: {{ $alumnos->semaforo->fondo }} ">
                                <p>{{ $alumnos->alumno->id }} </p>
                                {{ $alumnos->semaforo->nombre }}
                            </td>
                            <td>{{ $alumnos->alumno->nombre . ' ' . $alumnos->alumno->ap_paterno . ' ' . $alumnos->alumno->ap_materno }}
                            </td>
                            <td>
                                {{ $alumnos->alumno->telefono }}
                            </td>
                            <td class="p-0">
                                <div
                                    style="pading: 0; height: 5px; background:{{ $alumnos->lights[0]->semaforos[0]->fondo }}; ">
                                </div>
                                <div>
                                    {{ $alumnos->mes_1 }}
                                    <br>
                                </div>
                                <div class="d-grid gap-2">
                                    @if (($fecha_actual >= $inicio && $fecha_actual <= $mes_1) || $altera_entrega->mes_1)
                                        <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#month1Modal{{ $alumnos->id }} "
                                            data-bs-id="{{ $alumnos->id }}">
                                            Seguimiento
                                        </a>
                                        @include('modal.meses.mes1')
                                    @endif
                                </div>
                            </td>

                            <td>
                                <div>
                                    {{ $alumnos->oe_1 }}
                                </div>
                            </td>

                            <td class="p-0">
                                <div style="height: 5px; background:{{ $alumnos->lights[1]->semaforos[0]->fondo }}; ">
                                    <div>
                                        {{ $alumnos->mes_2 }}
                                        <br>
                                    </div>
                                    @if ($fecha_actual == $mes_2 || ($fecha_actual >= $mes_1 && $fecha_actual <= $mes_2) || $altera_entrega->mes_2)
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#month2Modal{{ $alumnos->id }}" data-bs-id="">
                                                Seguimiento
                                            </button>
                                        </div>
                                        @include('modal.meses.mes2')
                                    @endif
                            </td>
                            <td>
                                <div>
                                    {{ $alumnos->oe_2 }}
                                </div>
                            </td>

                            <td class="p-0">
                                <div style="height: 5px; background:{{ $alumnos->lights[2]->semaforos[0]->fondo }}; ">
                                    <div>
                                        {{ $alumnos->mes_3 }}
                                    </div>
                                    @if (($fecha_actual >= $mes_2 && $fecha_actual <= $mes_3) || $altera_entrega->mes_3)
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#month3Modal{{ $alumnos->id }} "
                                                data-bs-id="{{ $alumnos->id }}">
                                                Seguimiento
                                            </button>
                                        </div>
                                        @include('modal.meses.mes3')
                                    @endif

                            </td>

                            <td>
                                <div>{{ $alumnos->oe_3 }}</div>
                            </td>

                            <td class="p-0">
                                <div style="height: 5px; background:{{ $alumnos->lights[3]->semaforos[0]->fondo }}; ">
                                    <div>
                                        {{ $alumnos->mes_4 }}
                                    </div>
                                    @if (($fecha_actual >= $mes_3 && $fecha_actual <= $mes_4) || $altera_entrega->mes_4)
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#month4Modal{{ $alumnos->id }} "
                                                data-bs-id="{{ $alumnos->id }}">
                                                Seguimiento
                                            </button>
                                        </div>
                                        @include('modal.meses.mes4')
                                    @endif

                            </td>

                            <td>
                                <div>
                                    {{ $alumnos->oe_4 }}
                                </div>
                            </td>

                            <td>
                                <div>
                                    {{ $alumnos->reporte_final }}
                                </div>
                                @if (($fecha_actual >= $mes_4 && $fecha_actual <= $entrega_final) || $altera_entrega->mes_5)
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('reporte.show', $alumnos->id) }} " type="button"
                                            class="btn btn-primary">
                                            Seguimiento
                                        </a>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <form action="{{ route('alumnos-tutor.destroy', $alumnos->id) }} "
                                        class="formulario-eliminar" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-danger dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Opciones
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button type="button" class="dropdown-item canalizacion-btn"
                                                        data-bs-toggle="modal" data-bs-target="#modalFormulario"
                                                        data-id="{{ $alumnos->alumno->id }}">
                                                        Canalización
                                                    </button>

                                                <li><button type="submit" class="dropdown-item"
                                                        href="#">Eliminar</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>


                                    <!-- Modal Crear Actividad -->
                                    <div class="modal fade" id="modalFormulario" tabindex="-1"
                                        aria-labelledby="modalFormularioLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalFormularioLabel">Canalización
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="loadingIndicator" style="display: none;">Cargando...
                                                    </div>
                                                    <div id="formContent">
                                                        <form id="formAlumno" method="POST"
                                                            action="{{ route('atenciones.store') }}">
                                                            @csrf
                                                            <!-- Número de Control -->
                                                            <div class="form-group">
                                                                <label for="alumno_id">Número de Control</label>
                                                                <input type="text" name="alumno_id" id="alumno_id"
                                                                    class="form-control" readonly>
                                                            </div>

                                                            <!-- Atención -->
                                                            <div class="form-group">
                                                                <label for="atencion">Atención</label>
                                                                <select name="atencion" id="atencion"
                                                                    class="form-select" required>
                                                                    <option value="">Selecciona</option>
                                                                    <option value="Grupal">Grupal</option>
                                                                    <option value="Individual">Individual</option>
                                                                    <option value="Grupal/Individual">Grupal/Individual
                                                                    </option>
                                                                </select>
                                                            </div>

                                                            <!-- Canalizado -->
                                                            <div class="form-group">
                                                                <label for="canalizado">¿Canalizado?</label>
                                                                <select name="canalizado" id="canalizado"
                                                                    class="form-select" required>
                                                                    <option value="">Selecciona</option>
                                                                    <option value="Sí">Sí</option>
                                                                    <option value="No">No</option>
                                                                </select>
                                                            </div>

                                                            <!-- Área canalizada -->
                                                            <div class="form-group">
                                                                <label for="area_canalizada">Área Canalizada</label>
                                                                <input type="text" name="area_canalizada"
                                                                    id="area_canalizada" class="form-control">
                                                            </div>

                                                            <!-- Botón de Enviar -->
                                                            <button type="submit"
                                                                class="btn btn-primary mt-3">Agregar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- MODAL JEFE DE CARRERA-->
                                    <div class="modal fade" id="jefeDepartamentoModal" tabindex="-1"
                                        aria-labelledby="jefeDepartamentoModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('reporte.pdf', ['id' => $tutor->id]) }}"
                                                    method="GET" target="_blank">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="jefeDepartamentoModalLabel">
                                                            Generar Reporte</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="jefe_departamento" class="form-label">Nombre
                                                                del Jefe del Departamento</label>
                                                            <input type="text" name="jefe_departamento"
                                                                id="jefe_departamento" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Generar
                                                            PDF</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            document.querySelectorAll(".canalizacion-btn").forEach(button => {
                                                button.addEventListener("click", function() {
                                                    let alumnoId = this.getAttribute("data-id");

                                                    // Muestra el indicador de carga
                                                    document.getElementById("loadingIndicator").style.display = "block";
                                                    document.getElementById("formContent").style.display = "none";

                                                    // Realiza la petición AJAX
                                                    fetch(`/atenciones/${alumnoId}`)
                                                        .then(response => {
                                                            if (!response.ok) {
                                                                throw new Error("Error en la respuesta del servidor");
                                                            }
                                                            return response.json();
                                                        })
                                                        .then(data => {
                                                            // Oculta el indicador de carga y muestra el formulario
                                                            document.getElementById("loadingIndicator").style.display = "none";
                                                            document.getElementById("formContent").style.display = "block";

                                                            // Verifica si los elementos existen antes de asignar valores
                                                            if (document.getElementById("alumno_id")) {
                                                                document.getElementById("alumno_id").value = data.id || "";
                                                            }

                                                            if (document.getElementById("atencion")) {
                                                                document.getElementById("atencion").value = data.atencion || "";
                                                            }
                                                            if (document.getElementById("canalizado")) {
                                                                document.getElementById("canalizado").value = data.canalizado ||
                                                                    "";
                                                            }
                                                            if (document.getElementById("area_canalizada")) {
                                                                document.getElementById("area_canalizada").value = data
                                                                    .area_canalizada || "";
                                                            }
                                                        })
                                                        .catch(error => {
                                                            console.error("Error al cargar datos:", error);
                                                            document.getElementById("loadingIndicator").style.display = "none";
                                                            document.getElementById("formContent").style.display = "block";
                                                        });
                                                });
                                            });
                                        });
                                    </script>



                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@include("modal.alumno.add-alumno")
