<div class="modal fade" id="avisos-modal" tabindex="-1" aria-labelledby="aviso-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content alert-warning">

            <div class="modal-header border-0">
                <h5 class="modal-title" id="aviso-modal">Avisos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                @if ($avisos->isEmpty())
                    <div class="text-center py-4 text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="34"
                            height="34"
                            fill="currentColor"
                            class="bi bi-bell-slash-fill mb-3"
                            viewBox="0 0 16 16">
                            <path d="M5.164 14H15c-1.5-1-2-5.902-2-7q0-.396-.06-.776zm6.288-10.617A5 5 0 0 0 8.995 2.1a1 1 0 1 0-1.99 0A5 5 0 0 0 3 7c0 .898-.335 4.342-1.278 6.113zM10 15a2 2 0 1 1-4 0zm-9.375.625a.53.53 0 0 0 .75.75l14.75-14.75a.53.53 0 0 0-.75-.75z"/>
                        </svg>

                        <h6 class="fw-semibold mb-1">No hay avisos disponibles</h6>
                        <p class="mb-0 small">
                            Por el momento no existen avisos para mostrar.
                        </p>
                    </div>
                @else
                    @foreach ($avisos as $item)
                        <div class="alert alert-warning rounded p-3 mb-3">

                            <h6 class="fw-bold mb-2" style="color:brown">
                                {{ $item->titulo }}
                            </h6>

                            <p class="mb-0" style="text-align: justify;">
                                {{ $item->aviso }}
                            </p>
                        </div>
                    @endforeach
                @endif

            </div>

        </div>
    </div>
</div>
