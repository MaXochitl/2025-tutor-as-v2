@extends('master.master')

@section('structure-content')

<div class="container">
    <div class="row">
        <div class="col d-flex flex-column flex-shrink-0" style="margin-top: 40px">
            <div style="text-align: center">
                <h1>Asignación de Tutores</h1>
            </div>

            @if ($asig == 0)
            <!-- Crear asignaciones iniciales -->
            <div class="row shadow-lg p-3">
                <div class="col-3 col-md-4">
                    <label for="periodo">Periodo Actual</label>
                    <select name="periodo" class="form-select" aria-label="Default select example">
                        @foreach ($periodos->where('id', $periodo) as $item)
                        @php
                        $inicio = $meses[date('n', strtotime($item->inicio)) - 1] . ' ' . date('Y', strtotime($item->inicio));
                        $fin = $meses[date('n', strtotime($item->fin)) - 1] . ' ' . date('Y', strtotime($item->fin));
                        @endphp
                        <option value="{{ $item->id }}">
                            {{ $inicio . ' - ' . $fin }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-5 col-md-1" style="margin-top: 21px">
                    <a href="{{ route('asignaciones.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle" style="font-size: 1.5rem"></i>
                    </a>
                </div>
            </div>
            @else
            <!-- Si ya existen asignaciones -->
            <div class="row row-tutor">
                <form action="{{ route('asignaciones.store') }}" method="post">
                    @csrf
                    <div class="row shadow-lg p-3">
                        <div class="col-3 col-md-4">
                            <label for="periodo">Selecciona un periodo</label>
                            <select name="periodo" class="form-select" aria-label="Default select example">
                                @foreach ($periodos as $item)
                                @php
                                $inicio = $meses[date('n', strtotime($item->inicio)) - 1] . ' ' . date('Y', strtotime($item->inicio));
                                $fin = $meses[date('n', strtotime($item->fin)) - 1] . ' ' . date('Y', strtotime($item->fin));
                                @endphp
                                <option @if ($periodo==$item->id) selected @endif value="{{ $item->id }}">
                                    {{ $inicio . ' - ' . $fin }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5 col-md-1" style="margin-top: 15px">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search" style="font-size: 1.5rem"></i>
                            </button>
                        </div>
                        <div class="col-5 col-md-3 d-flex align-items-center" style="margin-top: 15px">
                            <a href="{{ route('memorandum.create') }}" class="btn btn-primary d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="34" fill="currentColor" class="bi bi-file-word" viewBox="0 0 16 16">
                                <path d="M4.879 4.515a.5.5 0 0 1 .606.364l1.036 4.144.997-3.655a.5.5 0 0 1 .964 0l.997 3.655 1.036-4.144a.5.5 0 0 1 .97.242l-1.5 6a.5.5 0 0 1-.967.01L8 7.402l-1.018 3.73a.5.5 0 0 1-.967-.01l-1.5-6a.5.5 0 0 1 .364-.606z"/>
                                <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1"/>
                                </svg>
                            </a>

                            <span class="ms-2 fw-semibold">Memorándum</span>
                        </div>
                    </div>
                </form>

                <div class="overflow-scroll" style="height: 500px">
                    <table id="table" class="table table-striped text-center align-middle">
                        <thead>
                            <tr>
                                <th scope="col">FOTO</th>
                                <th scope="col">CARRERA</th>
                                <th scope="col">NOMBRE COMPLETO</th>
                                <th scope="col">CORREO</th>
                                <th scope="col">TELEFONO</th>
                                <th scope="col">ASIGNACIONES</th>
                                <th scope="col">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asignaciones as $item)
                            @if ($item->carrera_id)
                            @php
                            $asigPeriodo = $item->asignaciones->where('periodo_id', $periodo);
                            @endphp
                            <tr data-tutor-id="{{ $item->id }}">
                                <td>
                                    <img src="{{ $item->foto }}" alt="" height="50px" width="50px" class="img-icon" style="border-radius: 40px; padding: 0px">
                                </td>
                                <td>{{ $item->carrera->nombre_carrera }}</td>
                                <td>{{ $item->nombre . ' ' . $item->ap_paterno . ' ' . $item->ap_materno }}</td>
                                <td>{{ $item->user->email }}</td>
                                <td>{{ $item->telefono }}</td>
                                <td class="asignaciones-container">
                                    @if ($asigPeriodo->isNotEmpty())
                                        @php
                                            $soloSinAsignar = $asigPeriodo->count() === 1 &&
                                                            $asigPeriodo->first()->semestre == 0 &&
                                                            strtolower(trim($asigPeriodo->first()->grupo)) == 'sin asignar';
                                        @endphp
                                        @if ($soloSinAsignar)
                                            <span class="text-muted fst-italic">Sin asignación actual.</span>
                                        @else
                                            @foreach ($asigPeriodo as $a)
                                                @if ($a->semestre != 0 && strtolower(trim($a->grupo)) != 'sin asignar')
                                                    <div class="d-flex justify-content-between align-items-center mb-1 border rounded p-1">
                                                        <span>
                                                            <span class="badge bg-primary">{{ $a->semestre }}</span>
                                                            <span class="badge bg-secondary">{{ $a->grupo }}</span>
                                                        </span>
                                                        <button type="button" class="btn btn-sm btn-danger btn-eliminar-grupo" data-id="{{ $a->id }}">
                                                            <i class="bi bi-x-lg"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                        <span class="text-muted">Sin asignaciones</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm btn-agregar-grupo"
                                        data-tutor-id="{{ $item->id }}"
                                        data-tutor-nombre="{{ $item->nombre }}"
                                        data-periodo-id="{{ $periodo }}">
                                        + Grupo
                                    </button>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal para agregar grupo -->
<div class="modal fade" id="modal-agregar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-agregar-grupo">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-agregar-titulo">Asignar nuevo grupo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="tutor_id" id="tutor_id">
                    <input type="hidden" name="periodo_id" id="periodo_id">

                    <div class="mb-3">
                        <label for="semestre">Semestre</label>
                        <select name="semestre" id="semestre" class="form-select" required>
                            @foreach ($semestres as $s)
                                <option value="{{ $s }}">{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="grupo">Grupo</label>
                        <select name="grupo" id="grupo" class="form-select" required>
                            @foreach ($grupos as $g)
                                <option value="{{ $g }}">{{ $g }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/custom/alerts.js') }}"></script>

<script>
$(document).ready(function() {
    $('#table').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando..."
        }
    });

    // Abrir modal para agregar grupo
    $(document).on('click', '.btn-agregar-grupo', function() {
        const tutorId = $(this).data('tutor-id');
        const tutorNombre = $(this).data('tutor-nombre');
        const periodoId = $(this).data('periodo-id');

        $('#tutor_id').val(tutorId);
        $('#periodo_id').val(periodoId);
        $('#modal-agregar-titulo').text('Asignar nuevo grupo a ' + tutorNombre);
        
        $('#modal-agregar').modal('show');
    });

    // enviar formulario de agregar grupo con AJAX
    $('#form-agregar-grupo').on('submit', function(e) {
        e.preventDefault();

        const formData = $(this).serialize();
        const tutorId = $('#tutor_id').val();

        $.ajax({
            url: '{{ route("asignaciones.agregarGrupo") }}',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // actualizar la columna de asignaciones
                    $('tr[data-tutor-id="' + tutorId + '"] .asignaciones-container').html(response.html);

                    // cerrar modal
                    $('#modal-agregar').modal('hide');

                    // mostrar mensaje de exito
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        showConfirmButton: true,
                        timer: 3000
                    });

                    // limpiar formulario
                    $('#form-agregar-grupo')[0].reset();
                }
            },
            error: function(xhr) {
                let errorMessage = 'Error al agregar el grupo.';
                
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                    showConfirmButton: true
                });
            }
        });
    });

    // Eliminar grupo con AJAX
    $(document).on('click', '.btn-eliminar-grupo', function() {
        const asignacionId = $(this).data('id');
        const tutorRow = $(this).closest('tr');
        const tutorId = tutorRow.data('tutor-id');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta asignación será eliminada permanentemente.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/asignaciones/' + asignacionId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // actualizar la columna de asignaciones
                            tutorRow.find('.asignaciones-container').html(response.html);

                            Swal.fire({
                                icon: 'success',
                                title: 'Eliminado',
                                text: response.message,
                                showConfirmButton: true,
                                timer: 3000
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Error al eliminar el grupo.';
                        
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage,
                            showConfirmButton: true
                        });
                    }
                });
            }
        });
    });

    // Mostrar SweetAlert para 'success'
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '{{ session('success') }}',
            showConfirmButton: true
        });
    @endif

    // Mostrar SweetAlert para 'error'
    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            showConfirmButton: true
        });
    @endif
});
</script>

@endsection