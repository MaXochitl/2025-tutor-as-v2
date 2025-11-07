@php
    $carreras = App\Models\Carrera::all();
@endphp

<div class="modal fade" id="new-materia-modal" tabindex="-1" aria-labelledby="new-materia-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="new-materia-modal">
                    <b>Nueva materia</b>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                @if (count($errors) > 0)
                    @include('secciones.errores')
                @endif

                <form method="POST" action="{{ route('materia.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <label for="materia" class="form-label">Nombre de la materia</label>
                            <input name="materia" type="text" class="form-control" id="materia" required>
                        </div>

                        <div class="col-9">
                            <label for="clave" class="form-label">Clave materia</label>
                            <input name="clave" type="text" class="form-control" id="clave" required>
                        </div>

                        <div class="col-3">
                            <label for="semestre" class="form-label">Semestre</label>
                            <select name="semestre" class="form-select">
                                @for ($i = 1; $i <= 16; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="carrera" class="form-label">Carrera</label>
                            <select name="carrera" class="form-select">
                                @foreach ($carreras as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre_carrera }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" style="margin-top: 20px">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
