@extends('master.masterAlumnos')
@section('contenido')
    <div class="container " style="margin-top: 20px;">
        <div class="row col-md-10  text-center shadow-lg p-3 mb-5 bg-body " style="margin: auto;border-radius: 17px">

            <div class="form-group row">
                <h1>Registrate</h1>
            </div>

            @if (session('registro') == 'no')
                <div class="alert alert-danger">
                    El número de cotrol ya esta registrado! <br>
                    A Nombre de: {{ session('nombre') }}
                </div>
            @endif

            @if (count($errors) > 0)
                @include('secciones.errores')
            @endif
            <form method="POST" action="{{ route('registro.store') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4 themed-grid-col">
                        <div class="form-group">
                            <label for="ncontrol" class="form-label">Numero Control</label>
                            <input name="ncontrol" type="text" class="form-control " id="ncontrol" required>
                        </div>

                    </div>

                    <div class="col-md-4 themed-grid-col">
                        <div class="form-group">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input name="telefono" class="form-control" id="telefono" required>
                        </div>
                    </div>

                    <div class="col-md-4 themed-grid-col">
                        <div class="form-group ">
                            <label for="mail" class="form-label">Correo</label>
                            <input name="correo" type="email" class="form-control minus" id="mail" required>
                        </div>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col-md-4 themed-grid-col">
                        <div class="form-group ">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input name="nombre" type="text" class="form-control " id="nombre" required>
                        </div>
                    </div>
                    <div class="col-md-4 themed-grid-col">
                        <div class="form-group ">
                            <label for="ap_paterno" class="form-label">Apellido Paterno</label>
                            <input name="ap_paterno" type="text" class="form-control " id="ap_paterno" required>
                        </div>
                    </div>
                    <div class="col-md-4 themed-grid-col">
                        <div class="form-group ">
                            <label for="ap_materno" class="form-label">Apellido Materno</label>
                            <input name="ap_materno" type="text" class="form-control " id="ap_materno" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 themed-grid-col">
                        <div class="form-group ">
                            <label for="sexo" class="form-label">Sexo</label>
                            <select name="sexo" class="form-select" aria-label="Default select example">
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 themed-grid-col">
                        <div class="form-group ">
                            <label for="carrera" class="form-label">Carrera</label>
                            <select name="carrera" class="form-select" aria-label="Default select example">
                                @foreach ($carreras as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre_carrera }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 themed-grid-col">
                        <div class="form-group ">
                            <label for="grupo" class="form-label">Grupo</label>
                            <select name="grupo" class="form-select" aria-label="Default select example">
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
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 themed-grid-col">

                        <div class="form-group ">
                            <label for="nacimiento" class="form-label">Fecha Nacimiento</label>
                            <input name="nacimiento" type="date" class="form-control" id="inicio" required>
                        </div>

                    </div>

                    <div class="col-md-8 themed-grid-col">
                        <div class="form-group ">
                            <label for="domicilio" class="form-label">Domicilio</label>
                            <input name="domicilio" type="text" class="form-control _minus" id="domicilio" required>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <div style="text-align: center">
                        <a href="{{ route('examen.index') }}" type="buutton" class="btn btn-danger"
                            style="margin-top: 20px">Cancelar</a>
                        <button type="submit" class="btn btn-primary" style="margin-top: 20px">
                            Continuar
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                            </svg>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
