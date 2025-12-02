<div class="modal fade" id="avisos-modal" tabindex="-1" aria-labelledby="aviso-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content alert-warning">

            <div class="modal-header border-0">
                <h5 class="modal-title" id="aviso-modal">Avisos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

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

            </div>

        </div>
    </div>
</div>
