@php

use App\Models\Carrera;
$carreras = Carrera::all();
@endphp

<div class="modal fade" id="alumnoedit-modal{{ $alum->id }}" tabindex="-1" aria-labelledby="alumnoedit-modal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="alumnoedit-modal">
                    Editar Alumno
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (count($errors) > 0)
                    @include('secciones.errores')
                @endif

                <form action="{{ route('alumnos.update', $alum->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group ">
                        <label for="ncontrol" class="form-label">Numero Control</label>
                        <input name="ncontrol" type="text" class="form-control" id="ncontrol"
                            value="{{ $alum->id }}">
                    </div>

                    <div class="form-group ">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input name="nombre" type="text" class="form-control" id="nombre"
                            value="{{ $alum->nombre }}">
                    </div>

                    <div class="form-group ">
                        <label for="ap_paterno" class="form-label">Apellido Paterno</label>
                        <input name="ap_paterno" type="text" class="form-control" id="ap_paterno"
                            value="{{ $alum->ap_paterno }}">
                    </div>

                    <div class="form-group ">
                        <label for="ap_materno" class="form-label">Apellido Materno</label>
                        <input name="ap_materno" type="text" class="form-control" id="ap_materno"
                            value="{{ $alum->ap_materno }}">
                    </div>


                    <div class="form-group ">
                        <label for="carrera" class="form-label">Carrera</label>
                        <select name="carrera" class="form-select" aria-label="Default select example">
                            @foreach ($carreras as $item)
                                <option @if ($alum->carrera_id == $item->id) {{ 'selected' }}@endif value="{{ $item->id }}">
                                    {{ $item->nombre_carrera }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group ">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select name="sexo" class="form-select" aria-label="Default select example">
                            <option @if ($alum->sexo == 'F') {{ 'selected' }} @endif value="F">Femenino</option>
                            <option @if ($alum->sexo == 'M') {{ 'selected' }} @endif value="M">Masculino</option>
                        </select>
                    </div>

                    <div class="form-group ">
                        <label for="nacimiento" class="form-label">Fecha Nacimiento</label>
                        <input name="nacimiento" type="date" class="form-control" id="nacimiento"
                            value="{{ $alum->fecha_nacimiento }}">
                    </div>

                    <div class="form-group ">
                        <label for="domicilio" class="form-label">Domicilio</label>
                        <input name="domicilio" type="text" class="form-control" id="domicilio"
                            value="{{ $alum->domicilio }}">
                    </div>

                    <div class="form-group ">
                        <label for="grupo" class="form-label">Grupo</label>

                        <select name="grupo" class="form-select" aria-label="Default select example">
                            <option @if ($alum->grupo == 'A') {{ 'selected' }} @endif value="A">A</option>
                            <option @if ($alum->grupo == 'B') {{ 'selected' }} @endif value="B">B</option>
                            <option @if ($alum->grupo == 'C') {{ 'selected' }} @endif value="C">C</option>
                            <option @if ($alum->grupo == 'D') {{ 'selected' }} @endif value="D">D</option>
                            <option @if ($alum->grupo == 'E') {{ 'selected' }} @endif value="E">E</option>
                            <option @if ($alum->grupo == 'F') {{ 'selected' }} @endif value="F">F</option>
                            <option @if ($alum->grupo == 'G') {{ 'selected' }} @endif value="G">G</option>
                            <option @if ($alum->grupo == 'H') {{ 'selected' }} @endif value="H">H</option>
                            <option @if ($alum->grupo == 'I') {{ 'selected' }} @endif value="I">I</option>
                            <option @if ($alum->grupo == 'J') {{ 'selected' }} @endif value="J">J</option>
                            <option @if ($alum->grupo == 'K') {{ 'selected' }} @endif value="K">K</option>
                            <option @if ($alum->grupo == 'L') {{ 'selected' }} @endif value="L">L</option>
                            <option @if ($alum->grupo == 'M') {{ 'selected' }} @endif value="M">M</option>
                            <option @if ($alum->grupo == 'N') {{ 'selected' }} @endif value="N">N</option>
                            <option @if ($alum->grupo == 'Ñ') {{ 'selected' }} @endif value="Ñ">Ñ</option>
                            <option @if ($alum->grupo == 'O') {{ 'selected' }} @endif value="O">O</option>
                        </select>
                    </div>


                    <div class="form-group ">
                        <label for="phone" class="form-label">Telefono</label>
                        <input name="telefono" type="text" class="form-control" id="phone"
                            value="{{ $alum->telefono }}">
                    </div>

                    <div class="form-group ">
                        <label for="estado" class="form-label">Estado</label>
                        <select name="estado" class="form-select" aria-label="Default select example">
                            <option @if ($alum->estado == '1') {{ 'selected' }} @endif value="1">Activo</option>
                            <option @if ($alum->estado == '2') {{ 'selected' }} @endif value="2">Baja Temporal</option>
                            <option @if ($alum->estado == '3') {{ 'selected' }} @endif value="3">Baja Definitiva</option>

                        </select>
                    </div>


                    <div class="form-group ">
                        <label for="correo" class="form-label">Correo</label>
                        <input name="correo" type="email" class="form-control" id="mail"
                            value="{{ $alum->correo }}">
                    </div>

                    <div class="form-group ">
                        <div style="text-align: center">
                            <button type="submit" class="btn btn-primary" style="margin-top: 20px">Guardar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
