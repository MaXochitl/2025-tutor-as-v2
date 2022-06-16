@extends('master.master')

@section('structure-content')
    <div class="container " style="margin-top: 20px;">
        @if (session('error') == 'correo')
            <div class="alert alert-danger">
                El correo ya esta siendo utilizado intenta con otro correo!
            </div>
        @endif
        @if (session('error') == 'matricula')
            <div class="alert alert-danger">
                Estamos dando matenimiento a la actualizacion de las matriculas!
            </div>
        @endif
        @if (session('editado') == 'ok')
            <div class="alert alert-success">
                Editado Correctamente!
            </div>
        @endif
        <div class="row p-2 col-md-4" style="margin: auto; background: rgb(235, 235, 235); border-radius: 10px">
            <div class="form-group row">
                <h1>EDITAR PERFIL</h1>
            </div>

            @if (count($errors) > 0)
                @include('secciones.errores')
            @endif

            <form action="{{ route('tutor.update', $tutores->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="matricula" class="form-label">Matricula</label>
                    <input name="matricula" type="text" class="form-control mayus" id="matricula"
                        value="{{ $tutores->id }}" disabled>
                </div>

                <!-- Email Address -->
                <div class="form-group row">
                    <label for="email">Correo</label>
                    <input id="email" class="form-control min" type="email" name="email" :value="old('email')" required
                        value="{{ $tutores->user->email }}" />
                </div>

                <div class="form-group row">
                    <label for="npombre" class="form-label">Nombre</label>
                    <input name="nombre" type="text" class="form-control mayus" id="nombre"
                        value="{{ $tutores->nombre }}">
                </div>

                <div class="form-group row">
                    <label for="ap_paterno" class="form-label">Apellido Paterno</label>
                    <input name="ap_paterno" type="text" class="form-control mayus" id="ap_paterno"
                        value="{{ $tutores->ap_paterno }}">
                </div>

                <div class="form-group row">
                    <label for="ap_materno" class="form-label">Apellido Materno</label>
                    <input name="ap_materno" type="text" class="form-control mayus" id="ap_materno"
                        value="{{ $tutores->ap_materno }}">
                </div>

                <div class="form-group row">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input name="telefono" class="form-control" id="telefono" value="{{ $tutores->telefono }}">
                </div>

                <div class="form-group row">
                    <label class="form-label" for="foto">Foto</label>
                    <input id="foto" class="form-control" type="file" name="foto">
                </div>

                <div class="form-group row">
                    <label for="carrera" class="form-label">Carrera</label>
                    <select name="carrera" class="form-select" aria-label="Default select example">
                        @foreach ($carreras as $item)
                            <option @if ($tutores->carrera_id == $item->id) {{ 'selected' }} @endif
                                value="{{ $item->id }}"> {{ $item->nombre_carrera }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group row">
                    <label for="pass">Cambiar contraseña </label>
                    <input class="form-control" name="pass" type="text" placeholder="Nueva contraseña 8 caracteres">
                </div>

                <div class="form-group row">
                    <label for="domicilio" class="form-label">Domicilio</label>
                    <input name="domicilio" type="text" class="form-control mayus_min" id="domicilio"
                        value="{{ $tutores->domicilio }}">
                </div>



                <div class="form-group row">
                    <div style="text-align: center">
                        <a href="{{ route('orientacion.index') }} " type="buutton" class="btn btn-danger"
                            style="margin-top: 20px">Cancelar</a>

                        <button type="submit" class="btn btn-primary" style="margin-top: 20px">Guardar</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
