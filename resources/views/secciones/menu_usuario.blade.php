@php
use App\Models\Registro;
@endphp

@if (Auth::check())

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ Auth::user()->name }}

        <img src="{{ Auth::user()->tutor->foto }} " alt="" height="50px" width="50px" class="img-icon" style="border-radius: 40px; padding: 0px ">
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
        <li><a class="dropdown-item" href=" {{ route('tutor.edit', Auth::user()->tutor) }} ">Perfil</a></li>

        <li><a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Cerrar Sesión</a>

        </li>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </ul>
</li>

@else

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="{{ url('/login') }}" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Iniciar Sesión
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
        <li><a class="dropdown-item" href="{{ url('/login') }}">Iniciar Sesión</a></li>
        @php
        $registro = Registro::max('id');
        $registro = Registro::find($registro);
        @endphp
        @if ($registro->status)
        <li><a class="dropdown-item" href="{{ url('/register') }}">Registrarte</a></li>
        @endif
    </ul>
</li>
@endif
