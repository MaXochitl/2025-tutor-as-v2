@extends('master.master')

@section('structure-content')
    <div class="container " style="margin-top: 20px">
        <div class="row col-md-4" style="margin: auto">
            <div class="form-group row">
                <h1>Nuevo Alumno</h1>
            </div>

            @if (count($errors) > 0)
                @include('secciones.errores')
            @endif

            <form method="POST" action="{{ route('alumnos.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="ncontrol" class="form-label">Numero Control</label>
                    <input name="ncontrol" type="text" class="form-control" id="ncontrol">
                </div>

                <div class="form-group row">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input name="nombre" type="text" class="form-control" id="nombre">
                </div>

                <div class="form-group row">
                    <label for="ap_paterno" class="form-label">Apellido Paterno</label>
                    <input name="ap_paterno" type="text" class="form-control" id="ap_paterno">
                </div>

                <div class="form-group row">
                    <label for="ap_materno" class="form-label">Apellido Materno</label>
                    <input name="ap_materno" type="text" class="form-control" id="ap_materno">
                </div>

                <div class="form-group row">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select name="sexo" class="form-select" aria-label="Default select example">
                        <option value="F">Femenino</option>
                        <option value="M">Masculino</option>
                    </select>
                </div>

                <div class="form-group row">
                    <label for="carrera" class="form-label">Carrera</label>
                    <select name="carrera" class="form-select" aria-label="Default select example">
                        @foreach ($carreras as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre_carrera }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group row">
                    <label for="grupo" class="form-label">Grupo</label>

                    <select name="grupo" class="form-select" aria-label="Default select example" required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                        <option value="H">H</option>
                        <option value="I">I</option>
                        <option value="J">J</option>
                        <option value="K">K</option>
                        <option value="L">L</option>
                        <option value="M">M</option>
                        <option value="N">N</option>
                        <option value="Ñ">Ñ</option>
                        <option value="O">O</option>
                    </select>
                </div>


                <div class="form-group row">
                    <label for="nacimiento" class="form-label">Fecha Nacimiento</label>
                    <input name="nacimiento" type="date" class="form-control" id="inicio" required>
                </div>

                <div class="form-group row">
                    <label for="domicilio" class="form-label">Domicilio</label>
                    <input name="domicilio" type="text" class="form-control" id="domicilio" required>
                </div>


                <div class="form-group row">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input name="telefono" type="text" class="form-control" id="telefono" required>
                </div>

                <div class="form-group row">
                    <label for="correo" class="form-label">Correo</label>
                    <input name="correo" type="email" class="form-control" id="mail">
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
