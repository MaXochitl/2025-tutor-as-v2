<div class="modal fade" id="res-color-modal{{ $item->alumno_id }}" tabindex="-1" aria-labelledby="carrera-modal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carrera-modal">
                    Definición Color: {{ $color[0]->color->nombre }}
                </h5> <br> <br>
                {{ $item->alumno->nombre . ' ' . $item->alumno->ap_paterno . ' ' . $item->ap_materno }}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p style="text-align: justify">
                    {{ $color[0]->color->caracteristicas }}
                </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
