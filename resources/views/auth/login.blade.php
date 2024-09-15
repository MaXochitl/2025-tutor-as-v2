@extends('master.master')

@section('structure-content')
    @if (session('register') == 'no')
        <div class="alert alert-danger">
            El registro se encuentra deshabilidato comunicate con orientacion educativa!
        </div>
    @endif

    <div class="p-5 text-center img-fond-home" style="pading-bottom: 20%">

        <div class="row col-md-4" style="margin: auto;background: white; border-radius: 7px; padding: 20px; color: blue">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />



            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="text-center">
                <img src="./tutores/logo.png" height="100px" width="100px" width="400px" alt="">
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mt-4">
                    <label for="email">Correo</label>
                    <br>
                    <input class="form-control" id="email" type="email" name="email" :value="old('email')" required
                        autofocus>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" /> <br>

                    <input class="form-control" id="password" class="block mt-1 w-full" type="password" name="password"
                        required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            name="remember">
                        <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                    </label>
                </div>

                <div>
                    <button class="ml-3 btn btn-primary">
                        Entrar
                    </button>
                </div>
                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif

                </div>
            </form>

            @if ($activo > 0)
                <div class="alert alert-success">
                    <a class="btn btn-success" href="{{ route('examen.index') }}">Examen Nuevo Ingreso</a>
                </div>
            @endif


        </div>
    </div>
@endsection
