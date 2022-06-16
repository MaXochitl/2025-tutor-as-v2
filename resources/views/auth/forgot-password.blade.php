@extends('master.master')

@section('structure-content')

    <body class="img-fond-home">

        <div class="p-3">
            <div class="row col-md-4"
                style="margin: auto;background: white; border-radius: 7px; padding: 20px;">
                <div class="mb-4 text-sm text-gray-600">
                    ¿Olvidaste tu contraseña? No hay problema. Restablece tu contraseña usando tu correo, se enviara un
                    elnace a
                    tu correo para restablecer tu contraseña.
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-label class="form-label" for="email" :value="'Correo'" />

                        <x-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                            required autofocus />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button class="btn btn-primary">
                            Restablecer contraseña
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </body>

@endsection
