<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar alumno (Tutor)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (count($errors) > 0)
                    @include('secciones.errores')
                @endif

                <form method="POST" action="{{ route('addAlumno', 1) }}">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Número de control:</label>

                        <input name="numero_control" 
                            type="text" 
                            class="form-control" 
                            required
                            data-bs-toggle="tooltip"
                            data-bs-placement="right"
                            title="La búsqueda distingue entre mayúsculas y minúsculas. Escribe el NC exactamente como está registrado en alumnos.">
                    </div>

                    <div class="mb-3">
                        <label for="semestre" class="col-form-label">Semestre</label>
                        <select name="semestre" class="form-select" aria-label="Default select example" required>
                            @php
                                // Extraer semestres únicos de $asignado sin duplicados
                                $semestresUnicos = $asignado->pluck('semestre')->unique()->sort()->values();
                                $tieneUnaAsignacion = $semestresUnicos->count() === 1;
                            @endphp
                            @if($tieneUnaAsignacion)
                                <option value="{{ $semestresUnicos->first() }}" selected>{{ $semestresUnicos->first() }}</option>
                            @else
                                <option value="">Selecciona un semestre</option>
                                @forelse($semestresUnicos as $sem)
                                    <option value="{{ $sem }}">{{ $sem }}</option>
                                @empty
                                    <option value="" disabled>No hay semestres asignados</option>
                                @endforelse
                            @endif
                        </select>
                    </div>

                    <!-- alumno.grupo se pedira para mostrar en las multiples tablas a que sem-grupo pertenecera en este periodo-->
                    <div class="mb-3">
                        <label for="grupo" class="col-form-label">Grupo</label>
                        <select name="grupo" class="form-select" aria-label="Default select example" required>
                            @php
                                // Extraer grupos únicos de $asignado sin duplicados
                                $gruposUnicos = $asignado->pluck('grupo')->unique()->sort()->values();
                                $tieneUnGrupo = $gruposUnicos->count() === 1;
                            @endphp
                            @if($tieneUnaAsignacion && $tieneUnGrupo)
                                <option value="{{ $gruposUnicos->first() }}" selected>{{ $gruposUnicos->first() }}</option>
                            @else
                                <option value="">Selecciona un grupo</option>
                                @forelse($gruposUnicos as $grp)
                                    <option value="{{ $grp }}" class="grupo-option" data-semestre="*">{{ $grp }}</option>
                                @empty
                                    <option value="" disabled>No hay grupos asignados</option>
                                @endforelse
                            @endif
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Agregar Alumno</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Datos de asignaciones del tutor (convertidos a JSON desde Larav)
    const asignaciones = @json($asignado);
    
    const semestreSelect = document.querySelector('select[name="semestre"]');
    const grupoSelect = document.querySelector('select[name="grupo"]');

    // funcion para actualizar opciones de grupo segun semestre seleccionado
    function actualizarGrupos() {
        const semestreSeleccionado = semestreSelect.value;
        
        // limpiar opciones previas excepto la primera
        grupoSelect.innerHTML = '<option value="">Selecciona un grupo</option>';
        
        if (semestreSeleccionado === '') {
            return;
        }
        
        // filtrar grupos únicos para el semestre seleccionado
        const gruposFiltrados = [...new Set(
            asignaciones
                .filter(asig => asig.semestre == semestreSeleccionado)
                .map(asig => asig.grupo)
        )].sort();
        
        if (gruposFiltrados.length === 0) {
            grupoSelect.innerHTML += '<option value="" disabled>No hay grupos para este semestre</option>';
            return;
        }
        
        // agregar opciones de grupos
        gruposFiltrados.forEach(grupo => {
            const option = document.createElement('option');
            option.value = grupo;
            option.textContent = grupo;
            grupoSelect.appendChild(option);
        });

        // Si solo hay un grupo, seleccionarlo automaticamente
        if (gruposFiltrados.length === 1) {
            grupoSelect.value = gruposFiltrados[0];
        }
    }

    semestreSelect.addEventListener('change', actualizarGrupos);

    // Ejecutar al cargar si el semestre ya tiene valor (una sola asignacion)
    if (semestreSelect.value !== '') {
        actualizarGrupos();
    }
});
</script>