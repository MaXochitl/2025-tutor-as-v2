@extends('master.master')


@section('structure-content')


    <div class="container " style="margin-top: 20px">
        <div class="row col-md-4" style="margin: auto">
            <div class="form-group row " style="text-align: center">
                <h1>Editar Periodo de Evaluacion</h1>

            </div>
            <form method="POST" action="{{ route("periodo-eval.update",[$periodo_eval->id]) }}"  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="inicio" class="form-label">Cambiar Fecha inicio</label>
                    <input name="inicio" type="date" class="form-control" id="inicio" value="{{ $periodo_eval->inicio }}">
                </div>

                <div class="form-group row">
                    <label for="fin" class="form-label">Cambiar Fecha fin</label>
                    <input name="fin" type="date" class="form-control" id="fin" value="{{$periodo_eval->fin }}">
                </div>

                <div class="form-group row">
                    <label for="estado" class="form-label">Activar periodo</label>
                    <select name="estado" class="form-select" aria-label="Default select example">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>

                <div class="form-group row">
                    <div style="text-align: center">
                        <a href="{{ route('periodo-eval.index') }} " type="buutton" class="btn btn-danger"
                            style="margin-top: 20px">Cancelar</a>

                        <button type="submit" class="btn btn-primary" style="margin-top: 20px">Guardar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
