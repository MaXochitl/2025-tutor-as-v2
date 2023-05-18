<nav class="navbar navbar-light navbar-expand-lg">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        </button>

        @can('admin.tutor', Model::class)
            <a class="navbar-brand" href="{{ route('orientacion.index') }}">Tutorias</a>
        @endcan
        @can('solo.admin')
            <a class="navbar-brand" href="{{ route('evaluacion.index') }} ">Nuevo Ingreso</a>
            <a class="navbar-brand" href="{{ route('usersAdmin.index') }} ">Usuarios</a>

        @endcan

        @can('solo.tutor')
            <a class="navbar-brand" href="{{ route('alumnos.index') }}">Alumnos</a>
            <a class="navbar-brand" href="{{ route('materia.index') }}">Materias</a>
        @endcan

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        </div>
        <div>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    @include('secciones.menu_usuario')
                </ul>
            </div>
        </div>
    </div>
</nav>
