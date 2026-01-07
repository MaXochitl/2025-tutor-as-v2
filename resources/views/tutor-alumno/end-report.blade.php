@extends('master.master')
@section('structure-content')

@php
    $colorId = null;

    foreach ($semaforo as $item) {
        if ($cantidad_reprobadas >= 1 && strtolower($item->nombre) === 'rojo') {
            $colorId = $item->id;
            break;
        }

        if ($cantidad_reprobadas == 0 && strtolower($item->nombre) === 'verde') {
            $colorId = $item->id;
        }
    }
@endphp

<div class="container my-4">

    <div class="card shadow-lg border-0 mx-auto" style="max-width: 1100px;">
        <div class="card-body">

            {{-- HEADER --}}
            <div class="text-center mb-4">
                <h4 class="fw-semibold mb-1">Reporte Final De:</h4>
                <h4 class="fw-bold">
                    {{ $periodo_tutorado->alumno->nombre . ' ' . $periodo_tutorado->alumno->ap_paterno . ' ' . $periodo_tutorado->alumno->ap_materno }}
                </h4>
            </div>

            <div class="row g-4">

                {{-- MATERIAS APROBADAS --}}
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header text-white fw-semibold text-center" style="background-color: #1b396a;">
                            Materias Aprobadas
                        </div>

                        <div class="card-body text-center">

                            @if (count($materia_aprobadas) != 0)
                                <table class="table table-sm align-middle">
 
                                    <tbody>
                                        @foreach ($materia_aprobadas as $approved)
                                            <tr>
                                                <td>{{ $approved->materia->nombre }}</td>
                                                <td class="text-center">
                                                    <form
                                                        action="{{ route('removMateria.removMateria', [$periodo_tutorado->id, $approved->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger btn-sm">
                                                            ✕
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted mb-0">No hay materias aprobadas.</p>
                            @endif

                            <button class="btn btn-success mt-3 mb-3"
                                data-bs-toggle="modal"
                                data-bs-target="#materiaModal">
                                Agregar
                            </button>

                            @include('modal.materia.add-approved')
                        </div>
                    </div>
                </div>

                {{-- MATERIAS REPROBADAS --}}
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header text-white text-center fw-semibold" style="background-color: #1b396a;">
                            Materias Reprobadas
                        </div>

                        <div class="card-body text-center">

                            @if (count($materia_reprobadas) != 0)
                                <table class="table table-sm align-middle">

                                    <tbody>
                                        @foreach ($materia_reprobadas as $failed)
                                            <tr>
                                                <td>{{ $failed->materia->nombre }}</td>
                                                <td class="text-center">
                                                    <form
                                                        action="{{ route('removMateria.removMateria', [$periodo_tutorado->id, $failed->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger btn-sm">
                                                            ✕
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted mb-0">No hay materias reprobadas.</p>
                            @endif

                            <button class="btn btn-danger mt-3 mb-3"
                                data-bs-toggle="modal"
                                data-bs-target="#materiaFailed">
                                Agregar
                            </button>

                            @include('modal.materia.add-failed')
                        </div>
                    </div>
                </div>
            </div>

            {{-- REPORTE FINAL --}}
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-header bg-light fw-semibold text-center">
                    Reporte Final
                </div>

                <div class="card-body">
                    <form method="POST"
                        action="{{ route('seguimiento-alumno.seguimiento', [$periodo_tutorado->id, 5]) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Descripción del reporte</label>
                            <textarea name="seguimiento"
                                id="seguimiento"
                                class="form-control"
                                rows="2"
                                placeholder="Describe el reporte final...">{{ $periodo_tutorado->reporte_final }}</textarea>

                            <input type="hidden" name="color" value="{{ $colorId }}">
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('reportes_tutor.show', $periodo_tutorado->tutor_id) }}"
                                class="btn btn-secondary me-2">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        
        let materiasSeleccionadas = new Set();
        let materiasYaGuardadas = new Set();

        $("input[name='materiax[]']:disabled").each(function() {
            let id = $(this).val().trim();
            materiasYaGuardadas.add(id);
            $(this).closest('tr').addClass('materia-seleccionada-disabled');
        });

        $(document).on("change", "input[name='materiax[]']", function () {
            if ($(this).data("restaurado") === true) return;
            if ($(this).prop('disabled')) return;

            let id = $(this).val().trim();

            if (this.checked) {
                materiasSeleccionadas.add(id);
                $(this).closest('tr').addClass('materia-seleccionada');
            } else {
                materiasSeleccionadas.delete(id);
                $(this).closest('tr').removeClass('materia-seleccionada');
            }
        });

        function restaurarSeleccion() {
            setTimeout(function() {
                $("input[name='materiax[]']").each(function () {
                    let id = $(this).val().trim();

                    if ($(this).prop('disabled')) {
                        $(this).closest('tr').addClass('materia-seleccionada-disabled');
                        return;
                    }
                    
                    $(this).data("restaurado", true);
                    
                    if (materiasSeleccionadas.has(id)) {
                        $(this).prop("checked", true);
                        $(this).closest('tr').addClass('materia-seleccionada');
                    } else {
                        $(this).prop("checked", false);
                        $(this).closest('tr').removeClass('materia-seleccionada');
                    }
                    
                    $(this).data("restaurado", false);
                });
            }, 100);
        }

        let tabla1 = $('#table').DataTable({
            language: {
                lengthMenu: "Mostrar _MENU_ registros",
                zeroRecords: "No se encontraron resultados",
                info: "Selecciona Materias",
                infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                infoFiltered: "(filtrado de un total de _MAX_ registros)",
                sSearch: "Buscar:",
                oPaginate: {
                    sFirst: "Primero",
                    sLast: "Último",
                    sNext: ">",
                    sPrevious: "<"
                },
                sProcessing: "Procesando..."
            },
            drawCallback: function() {
                restaurarSeleccion();
            }
        });

        let tabla2 = $('#table_2').DataTable({
            language: {
                lengthMenu: "Mostrar _MENU_ registros",
                zeroRecords: "No se encontraron resultados",
                info: "Selecciona Materias",
                infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                infoFiltered: "(filtrado de un total de _MAX_ registros)",
                sSearch: "Buscar:",
                oPaginate: {
                    sFirst: "Primero",
                    sLast: "Último",
                    sNext: ">",
                    sPrevious: "<"
                },
                sProcessing: "Procesando..."
            },
            drawCallback: function() {
                restaurarSeleccion();
            }
        });

        restaurarSeleccion();

        $("form").on("submit", function (e) {
            const $form = $(this);

            const esFormularioMaterias = $form.find("input[name='materiax[]']").length > 0;
            
            if (esFormularioMaterias) {
                if (materiasSeleccionadas.size === 0) {
                    e.preventDefault();
                    
                    Swal.fire({
                        icon: 'warning',
                        title: 'No hay materias seleccionadas',
                        text: 'Debes seleccionar al menos una materia antes de guardar.',
                        timer: 3000,
                        timerProgressBar: true,
                        confirmButtonText: 'Entendido',
                        confirmButtonColor: '#3085d6'
                    });
                    
                    return false;
                }
                
                $form.find(".hidden-materia").remove();

                $form.find("input[name='materiax[]']:not(:disabled)").each(function() {
                    $(this).removeAttr("name");
                });

                materiasSeleccionadas.forEach(id => {
                    $form.append(
                        `<input type="hidden" class="hidden-materia" name="materiax[]" value="${id}">`
                    );
                });
            }
        });
            
        const textarea = document.getElementById("seguimiento");

        if (textarea) {
            if (localStorage.getItem("seguimientoTemp")) {
                textarea.value = localStorage.getItem("seguimientoTemp");
            }

            textarea.addEventListener("input", function () {
                localStorage.setItem("seguimientoTemp", textarea.value);
            });

            const formSeg = document.querySelector("form[action*='seguimiento-alumno']");
            if (formSeg) {
                formSeg.addEventListener("submit", function () {
                    localStorage.removeItem("seguimientoTemp");
                });
            }
        }
    });
</script>
@endsection
