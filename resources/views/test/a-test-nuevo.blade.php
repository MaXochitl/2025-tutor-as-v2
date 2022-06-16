@extends('master.master')


@section('structure-content')


    <div class="container text-center" style="margin-top: 20px">
        <div class="row col-md-4" style="margin: auto">

            <form method="POST" action="{{ route('periodo-eval.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="validationServer01" class="form-label">Nombre</label>
                    <input type="date" class="form-control">
                    <input type="date" name="fecha" id="fecha">
                </div>
                <div class="form-group row">

                    <button type="submit" class="btn btn-primary">Primary</button>
                </div>

            </form>
        </div>
    </div>
@endsection
