@extends('master.master')

@section('structure-content')

    <body class="img-fond-home">

        <div class="p-3">
            @if (session('creado') == 'no')
                <div class="alert alert-danger">
                    Tu matricula ya se encuentra registrado!
                </div>
            @endif

            <!-- Validation Errors -->
            <div class="row col-md-4"
                style="margin: auto;background: white; border-radius: 7px; padding: 20px;color: blue">

                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- matricula -->
                    <div>
                        <label for="matricula" class="form-label">Matricula</label>

                        <input class="form-control" id="matricula" type="text" name="matricula" required autofocus />
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name">Nombre</label>

                        <input class="form-control" id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required />
                    </div>

                    <!-- ap_paterno -->
                    <div>
                        <x-label for="ap_paterno" value="Apellido paterno" />

                        <input class="form-control " id="ap_paterno" class="block mt-1 w-full" type="text" name="ap_paterno"
                            required />
                    </div>


                    <!-- ap_materno -->
                    <div>
                        <x-label for="ap_materno" value="Apellido materno" />

                        <input class="form-control " id="ap_materno" type="text" name="ap_materno" required />
                    </div>


                    <!--telefono-->
                    <div>
                        <label for="telefono" class="form-label">Telefono</label>
                        <input id="telefono" name="telefono" class="form-control"  required>
                    </div>

                    <!--Sexo-->
                    <div>
                        <x-label for="sexo" value="Sexo" />
                        <select name="sexo" class="form-select" aria-label="Default select example">
                            <option value="F">Femenino</option>
                            <option value="M">Masculino</option>
                        </select>
                    </div>

                    <div>
                        <x-label for="carrera" value="Selecciona Carrera" />
                        <select name="carrera" class="form-select" aria-label="Default select example">
                            @foreach ($carreras as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre_carrera }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- domicilio -->
                    <div>
                        <x-label for="domicilio" value="Domicilio" />

                        <x-input id="domicilio" class="form-control mayus_min" type="text" name="domicilio" required />
                    </div>

                    <!--Foto-->
                    <div>
                        <x-label for="file" value="Selecciona foto" />
                        <x-input id="file" class="form-control" type="file" name="foto" required />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-label for="email" value="Correo" />

                        <x-input id="email" class="form-control min" type="email" name="email" :value="old('email')"
                            required />
                    </div>


                    <!-- Password -->
                    <div>
                        <x-label for="password" :value="__('Password')" />

                        <x-input id="password" class="form-control" type="password" name="password" required
                            autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-input id="password_confirmation" class="form-control" type="password"
                            name="password_confirmation" required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            Ya estas registrado?
                        </a>

                        <button class="ml-4 btn btn-primary">
                            Registrarme
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>

@endsection
