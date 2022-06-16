@extends('master.master')
@section('structure-content')
    <div class="container " style="margin-top: 20px">
        <div class="row col-md-7  text-center shadow-lg p-3 mb-5 bg-body " style="margin: auto;border-radius: 17px">
            <div class="form-group row">
                <h1>Nueva Materia</h1>
            </div>

            @if (count($errors) > 0)
                @include('secciones.errores')
            @endif

            <form method="POST" action="{{ route('materia.store') }}">
                @csrf

                <div class="row">

                    <div class="col-md-9">
                        <div class="form-group row">
                            <label for="materia" class="form-label">Nombre de la Materia</label>
                            <input name="materia" type="text" class="form-control" id="materia">
                        </div>
                    </div>



                    <div class="col-md-2">
                        <div class="form-group row">
                            <label for="semestre" class="form-label">Semestre</label>

                            <select name="semestre" class="form-select" aria-label="Default select example">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-11">
                        <label for="carrera" class="form-label">Carrera</label>
                        <select name="carrera" class="form-select" aria-label="Default select example">
                            @foreach ($carreras as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre_carrera }}</option>
                            @endforeach
                        </select>
                    </div>




                    <div class="form-group row">
                        <div style="text-align: center">
                            <a href="{{ route('materia.index') }} " type="buutton" class="btn btn-danger"
                                style="margin-top: 20px">Cancelar</a>
                            <button type="submit" class="btn btn-primary" style="margin-top: 20px">Guardar</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
