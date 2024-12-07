<div class="modal fade" id="m-new-user" tabindex="-1" aria-labelledby="user-m-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carrera-modal">
                </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">
                <h1>Crear nuevo Auditor</h1>
                @if (count($errors) > 0)
                    @include('secciones.errores')
                @endif


                <form method="POST" action="{{ route('usersAdmin.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input name="nombre" type="text" class="form-control" id="nombre" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="ap_paterno" class="form-label">Apellido Paterno</label>
                        <input name="ap_paterno" type="text" class="form-control" id="ap_paterno" required>
                    </div>


                    <div class="form-group">
                        <label for="ap_materno" class="form-label">Apellido Materno</label>
                        <input name="ap_materno" type="text" class="form-control" id="ap_materno" required>
                    </div>

                    <div class="form-group">
                        <label for="matricula" class="form-label">Matricula</label>
                        <input name="matricula" type="text" class="form-control" id="matricula" required>
                    </div>

                    <div>
                        <label for="telefono" class="form-label">Telefono</label>
                        <input id="telefono" name="telefono" class="form-control" required>
                    </div>

                    <div>
                        <x-label for="sexo" value="Sexo" />
                        <select name="sexo" class="form-select" aria-label="Default select example">
                            <option value="F">Femenino</option>
                            <option value="M">Masculino</option>
                        </select>
                    </div>

                    <div>
                        <x-label for="domicilio" value="Domicilio" />

                        <x-input id="domicilio" class="form-control mayus_min" type="text" name="domicilio"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="correo" class="form-label">Correo</label>
                        <input name="correo" type="text" class="form-control" id="correo" required>
                    </div>

                    <div class="form-group">
                        <label for="pass" class="form-label">Contraseña</label>
                        <input name="pass" type="password" class="form-control" id="pass" required>
                    </div>

                    <div class="form-group">
                        <div style="text-align: center">
                            <button type="submit" class="btn btn-primary" style="margin-top: 20px">Guardar</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
