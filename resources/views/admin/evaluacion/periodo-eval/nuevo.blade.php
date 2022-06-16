@extends('master.master')


@section('structure-content')


    <div class="container " style="margin-top: 20px">
        <div class="row col-md-4" style="margin: auto">
            <div class="form-group row">
                <h1>Nuevo Periodo</h1>

            </div>

            <form method="POST" action="{{ route('periodo-eval.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="inicio" class="form-label">Fecha inicio</label>
                    <input name="inicio" type="date" class="form-control" id="inicio">
                </div>

                <div class="form-group row">
                    <label for="fin" class="form-label">Fecha fin</label>
                    <input name="fin" type="date" class="form-control" id="fin">
                </div>

                <div class="form-group row">
                    <label for="activo" class="form-label">Activar periodo</label>
                    <select name="activo" class="form-select" aria-label="Default select example">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>

                <div class="form-group row">
                    <div style="text-align: center">
                        <a href="{{ route('periodo-eval.index') }} " type="buutton" class="btn btn-danger" style="margin-top: 20px">Cancelar</a>
                        <button type="submit" class="btn btn-primary" style="margin-top: 20px">Guardar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
