@extends('master.master')


@section('structure-content')

    <div class="container " style="margin-top: 20px">
        <div class="row col-md-4" style="margin: auto">
            <div class="form-group row">
                <h1>Editar Alumno</h1>
            </div>

            @if (count($errors) > 0)
                @include('secciones.errores')
            @endif



            <form  action="{{ route('alumnos.update', $alumnos->id)}}"  method="post">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="ncontrol" class="form-label">Numero Control</label>
                    <input name="ncontrol" type="text" class="form-control" id="ncontrol"
                    value="{{$alumnos->id}}">
                </div>

                <div class="form-group row">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input name="nombre" type="text" class="form-control" id="nombre"
                     value="{{$alumnos->nombre}}">
                </div>

                <div class="form-group row">
                    <label for="ap_paterno" class="form-label">Apellido Paterno</label>
                    <input name="ap_paterno" type="text" class="form-control" id="ap_paterno"
                     value="{{$alumnos->ap_paterno}}">
                </div>

                <div class="form-group row">
                    <label for="ap_materno" class="form-label">Apellido Materno</label>
                    <input name="ap_materno" type="text" class="form-control" id="ap_materno" 
                    value="{{$alumnos->ap_materno}}">
                </div>

                
                <div class="form-group row">
                    <label for="carrera" class="form-label">Carrera</label>
                    <select name="carrera" class="form-select" aria-label="Default select example">
                        @foreach ($carreras as $item)
                            <option   @if ($alumnos->carrera_id==$item->id){{ 'selected' }}@endif  value="{{ $item->id }}">{{ $item->nombre_carrera }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group row">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select name="sexo" class="form-select" aria-label="Default select example">
                        <option  @if ($alumnos->sexo=='F') {{ 'selected' }} @endif value="F">Femenino</option>
                        <option @if ($alumnos->sexo=='M') {{ 'selected' }} @endif value="M">Masculino</option>
                        </select>
                </div>


                <div class="form-group row">
                    <label for="nacimiento" class="form-label">Fecha Nacimiento</label>
                    <input name="nacimiento" type="date" class="form-control" id="nacimiento"
                    value="{{$alumnos->fecha_nacimiento}}">
                </div>

                <div class="form-group row">
                    <label for="domicilio" class="form-label">Domicilio</label>
                    <input name="domicilio" type="text" class="form-control" id="domicilio"
                    value="{{$alumnos->domicilio}}">
                </div>

                <div class="form-group row">
                    <label for="grupo" class="form-label">Grupo</label>

                    <select name="grupo" class="form-select" aria-label="Default select example">
                        <option @if ($alumnos->grupo=='A') {{ 'selected' }} @endif value="A">A</option>
                        <option @if ($alumnos->grupo=='B') {{ 'selected' }} @endif value="B">B</option>
                        <option @if ($alumnos->grupo=='C') {{ 'selected' }} @endif value="C">C</option>
                        <option @if ($alumnos->grupo=='D') {{ 'selected' }} @endif value="D">D</option>
                        <option @if ($alumnos->grupo=='E') {{ 'selected' }} @endif value="E">E</option>
                        <option @if ($alumnos->grupo=='F') {{ 'selected' }} @endif value="F">F</option>
                        <option @if ($alumnos->grupo=='G') {{ 'selected' }} @endif value="G">G</option>
                        <option @if ($alumnos->grupo=='H') {{ 'selected' }} @endif value="H">H</option>
                        <option @if ($alumnos->grupo=='I') {{ 'selected' }} @endif value="I">I</option>
                        <option @if ($alumnos->grupo=='J') {{ 'selected' }} @endif value="J">J</option>
                        <option @if ($alumnos->grupo=='K') {{ 'selected' }} @endif value="K">K</option>
                        <option @if ($alumnos->grupo=='L') {{ 'selected' }} @endif value="L">L</option>
                        <option @if ($alumnos->grupo=='M') {{ 'selected' }} @endif value="M">M</option>
                        <option @if ($alumnos->grupo=='N') {{ 'selected' }} @endif value="N">N</option>
                        <option @if ($alumnos->grupo=='Ñ') {{ 'selected' }} @endif value="Ñ">Ñ</option>
                        <option @if ($alumnos->grupo=='O') {{ 'selected' }} @endif value="O">O</option>
                    </select>
                </div>

                <div class="form-group row">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input name="telefono" type="number" class="form-control" id="telefono"
                    value="{{$alumnos->telefono}}">
                </div>


                <div class="form-group row">
                    <label for="correo" class="form-label">Correo</label>
                    <input name="correo" type="email" class="form-control" id="mail"
                    value="{{$alumnos->correo}}">
                </div>

                <div class="form-group row">
                    <div style="text-align: center">
                        <a href="{{ route('alumnos.index') }} " type="buutton" class="btn btn-danger"
                            style="margin-top: 20px">Cancelar</a>

                        <button type="submit" class="btn btn-primary" style="margin-top: 20px">Guardar</button>
                    </div>
                </div>

            </form>
        </div>
    </div> 

@endsection
