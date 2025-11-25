<div class="modal fade" id="updateAlumnoModal" tabindex="-1" aria-labelledby="updateAlumnoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateAlumnoModalLabel">Actualizar Alumno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (count($errors) > 0)
                    @include('secciones.errores')
                @endif

                <form method="POST" id="updateAlumnoForm">
                    @method('PUT')
                    @csrf
                    
                    <!-- Campo oculto para el ID del periodo_tutorado -->
                    <input type="hidden" id="periodo_tutorado_id" name="periodo_tutorado_id">

                    <div class="mb-3">
                        <label for="numero_control_update" class="col-form-label">Número de control:</label>
                        <input type="text" 
                            id="numero_control_update"
                            class="form-control" 
                            readonly
                            disabled>
                    </div>

                    <div class="mb-3">
                        <label for="semestre_update" class="col-form-label">Semestre</label>
                        <select id="semestre_update" name="semestre" class="form-select" required>
                            <option value="">Selecciona un semestre</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="grupo_update" class="col-form-label">Grupo</label>
                        <select id="grupo_update" name="grupo" class="form-select" required>
                            <option value="">Selecciona un grupo</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Alumno</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Datos de asignaciones del tutor (convertidos a JSON desde Laravel)
    const asignaciones = @json($asignado);
    
    const semestreSelect = document.getElementById('semestre_update');
    const grupoSelect = document.getElementById('grupo_update');
    const updateForm = document.getElementById('updateAlumnoForm');

    // Función para actualizar opciones de grupo según semestre seleccionado
    function actualizarGrupos() {
        const semestreSeleccionado = semestreSelect.value;
        
        grupoSelect.innerHTML = '<option value="">Selecciona un grupo</option>';
        
        if (semestreSeleccionado === '') {
            return;
        }
        
        // Filtrar grupos unicos para el semestre seleccionado
        const gruposFiltrados = [...new Set(
            asignaciones
                .filter(asig => asig.semestre == semestreSeleccionado)
                .map(asig => asig.grupo)
        )].sort();
        
        if (gruposFiltrados.length === 0) {
            grupoSelect.innerHTML += '<option value="" disabled>No hay grupos para este semestre</option>';
            return;
        }
        
        // Agregar opciones de grupos
        gruposFiltrados.forEach(grupo => {
            const option = document.createElement('option');
            option.value = grupo;
            option.textContent = grupo;
            grupoSelect.appendChild(option);
        });

        // Si solo hay un grupo, seleccionarlo automáticamente
        if (gruposFiltrados.length === 1) {
            grupoSelect.value = gruposFiltrados[0];
        }
    }

    semestreSelect.addEventListener('change', actualizarGrupos);

    // Cargar datos cuando se abre el modal
    document.querySelectorAll('.actualizar-alumno-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const periodoTutoradoId = this.getAttribute('data-id');
            const alumnoId = this.getAttribute('data-alumno-id');
            const semestreActual = this.getAttribute('data-semestre');
            const grupoActual = this.getAttribute('data-grupo');

            // Rellenar el formulario con los datos actuales
            document.getElementById('numero_control_update').value = alumnoId;
            document.getElementById('periodo_tutorado_id').value = periodoTutoradoId;

            // Llenar selects con semestres disponibles
            semestreSelect.innerHTML = '<option value="">Selecciona un semestre</option>';
            
            const semestresUnicos = [...new Set(
                asignaciones.map(asig => asig.semestre)
            )].sort((a, b) => a - b);

            semestresUnicos.forEach(sem => {
                const option = document.createElement('option');
                option.value = sem;
                option.textContent = sem;
                if (sem == semestreActual) {
                    option.selected = true;
                }
                semestreSelect.appendChild(option);
            });

            // actualizar grupos basado en el semestre actual
            actualizarGrupos();
            
            // Si tenemos grupo actual, seleccionarlo
            if (grupoActual) {
                setTimeout(() => {
                    grupoSelect.value = grupoActual;
                }, 100);
            }
        });
    });

    // Manejar el envio del formulario
    updateForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const periodoTutoradoId = document.getElementById('periodo_tutorado_id').value;
        const semestre = document.getElementById('semestre_update').value;
        const grupo = document.getElementById('grupo_update').value;

        if (!periodoTutoradoId || !semestre || !grupo) {
            alert('Por favor completa todos los campos');
            return;
        }

        // Crear objeto con los datos a enviar
        const data = {
            semestre: semestre,
            grupo: grupo,
            _method: 'PUT',
            _token: document.querySelector('meta[name="csrf-token"]').content
        };

        console.log('Enviando datos:', data);
        console.log('URL:', `/alumnos-tutor/${periodoTutoradoId}`);
        
        fetch(`/alumnos-tutor/${periodoTutoradoId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            console.log('Response status:', response.status);
            
            if (!response.ok) {
                return response.json().then(err => {
                    throw new Error(err.message || `Error HTTP: ${response.status}`);
                });
            }
            return response.json();
        })
        .then(data => {
            console.log('Respuesta del servidor:', data);
            
            if (data.success) {
                // Cerrar el modal
                const modalElement = document.getElementById('updateAlumnoModal');
                const modal = bootstrap.Modal.getInstance(modalElement);
                modal.hide();
                
                // Mostrar mensaje de éxito
                alert('Alumno actualizado correctamente');
                
                // Recargar la pagina después de 1 segundo
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                alert(data.message || 'Error al actualizar');
            }
        })
        .catch(error => {
            console.error('Error completo:', error);
            alert('Error al actualizar el alumno: ' + error.message);
        });
    });
});
</script>