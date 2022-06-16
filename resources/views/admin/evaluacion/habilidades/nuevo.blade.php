@extends('master.master')


@section('structure-content')
    <div class="container">
        <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">

            <div style="text-align: center">
                <h1>
                    Nueva Pregunta
                </h1>
            </div>

            <form method="POST" action="{{ route('habilidades.store') }}">
                @csrf

                <div>
                    <label for="pregunta" class="form-label">Pregunta</label>
                    <input name="pregunta" type="text" class="form-control" id="inicio">
                </div>

                <div class="row mb-3">
                    <div class="col-sm-6 col-lg-8 themed-grid-col">
                        <label for="respuesta1" class="form-label">Respuesta 1</label>
                        <input name="respuesta1" type="text" class="form-control" id="inicio">
                    </div>
                    <div class="col-6 col-lg-2 themed-grid-col">
                        <label for="valor1" class="form-label">Valor</label>
                        <input name="valor1" type="number" class="form-control" id="inicio" value="0">
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-sm-6 col-lg-8 themed-grid-col">
                        <label for="respuesta2" class="form-label">Respuesta 2</label>
                        <input name="respuesta2" type="text" class="form-control" id="inicio">
                    </div>
                    <div class="col-6 col-lg-2 themed-grid-col">
                        <label for="valor2" class="form-label">Valor</label>
                        <input name="valor2" type="number" class="form-control" id="inicio" value="0">
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-sm-6 col-lg-8 themed-grid-col">
                        <label for="respuesta3" class="form-label">Respuesta 3</label>
                        <input name="respuesta3" type="text" class="form-control" id="inicio" >
                    </div>
                    <div class="col-6 col-lg-2 themed-grid-col">
                        <label for="valor3" class="form-label">Valor</label>
                        <input name="valor3" type="number" class="form-control" id="inicio" value="0">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6 col-lg-8 themed-grid-col">
                        <label for="respuesta4" class="form-label">Respuesta 4</label>
                        <input name="respuesta4" type="text" class="form-control" id="inicio">
                    </div>
                    <div class="col-6 col-lg-2 themed-grid-col">
                        <label for="valor4" class="form-label">Valor</label>
                        <input name="valor4" type="number" class="form-control" id="inicio" value="0">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6 col-lg-8 themed-grid-col">
                        <label for="respuesta5" class="form-label">Respuesta 5</label>
                        <input name="respuesta5" type="text" class="form-control" id="inicio">
                    </div>
                    <div class="col-6 col-lg-2 themed-grid-col">
                        <label for="valor5" class="form-label">Valor</label>
                        <input name="valor5" type="number" class="form-control" id="inicio" value="0">
                    </div>
                </div>


                <div class="form-group row">
                    <div style="text-align: center">
                        <a href="{{ route('habilidades.index') }} " type="buutton" class="btn btn-danger"
                            style="margin-top: 20px">Cancelar</a>

                        <button type="submit" class="btn btn-primary" style="margin-top: 20px">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
