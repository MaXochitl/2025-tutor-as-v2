@extends('master.master')


@section('structure-content')


    <div class="container " style="margin-top: 20px">
        <div class="row col-md-4  text-center shadow-lg p-3 mb-5 bg-body " style="margin: auto;border-radius: 17px">
            <div class="form-group row">
                <h1>Nueva Carrera</h1>
            </div>

            @if (count($errors) > 0)
                @include('secciones.errores')
            @endif

            <form method="POST" action="{{ route('carrera.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="carrera" class="form-label">Carrera</label>
                    <input name="carrera" type="text" class="form-control" id="carrera">
                </div>

                <div class="form-group row">
                    <div style="text-align: center">
                        <a href="{{ route('carrera.index') }} " type="buutton" class="btn btn-danger"
                            style="margin-top: 20px">Cancelar</a>
                        <button type="submit" class="btn btn-primary" style="margin-top: 20px">Guardar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
