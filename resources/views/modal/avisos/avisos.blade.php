<div class="modal  fade" id="avisos-modal" tabindex="-1" aria-labelledby="aviso-modal" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content alert-warning">
            <div class="modal-header">
                <h5 class="modal-title" id="aviso-modal">
                    Avisos
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach ($avisos as $item)
                    <div class="rounded alert-warning mb-3" role="alert">
                        <div class="modal-header">
                            <b style="color: brown">{{ $item->titulo }}</b>
                        </div>
                        {{ $item->aviso }}
                    </div>
                @endforeach

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
