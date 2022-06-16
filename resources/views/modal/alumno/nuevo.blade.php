@php
use App\Models\Carrera;
$carreras = Carrera::all();
@endphp
<div class="modal fade" id="alumno-modal" tabindex="-1" aria-labelledby="alumno-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alumno-modal">
                    Nuevo Alumno
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @if (count($errors) > 0)
                    @include('secciones.errores')
                @endif

                <form method="POST" action="{{ route('alumnos.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="ncontrol" class="form-label">Numero Control</label>
                        <input name="ncontrol" type="text" class="form-control " id="ncontrol" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input name="nombre" type="text" class="form-control" id="nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="ap_paterno" class="form-label">Apellido Paterno</label>
                        <input name="ap_paterno" type="text" class="form-control " id="ap_paterno" required>
                    </div>

                    <div class="form-group">
                        <label for="ap_materno" class="form-label">Apellido Materno</label>
                        <input name="ap_materno" type="text" class="form-control " id="ap_materno" required>
                    </div>

                    <div class="form-group">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select name="sexo" class="form-select" aria-label="Default select example">
                            <option value="F">Femenino</option>
                            <option value="M">Masculino</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="carrera" class="form-label">Carrera</label>
                        <select name="carrera" class="form-select" aria-label="Default select example">
                            @foreach ($carreras as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre_carrera }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
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


                    <div class="form-group ">
                        <label for="nacimiento" class="form-label">Fecha Nacimiento</label>
                        <input name="nacimiento" type="date" class="form-control" id="inicio" required>
                    </div>

                    <div class="form-group ">
                        <label for="domicilio" class="form-label">Domicilio</label>
                        <input name="domicilio" type="text" class="form-control " id="domicilio">
                    </div>


                    <div class="form-group ">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input id="telefono" name="telefono" class="form-control" id="telefono" required>
                    </div>

                    <div class="form-group ">
                        <label for="correo" class="form-label">Correo</label>
                        <input name="correo" type="email" class="form-control " id="mail" required>
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
</div>
