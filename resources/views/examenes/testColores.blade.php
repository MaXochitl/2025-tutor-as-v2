@extends('master.masterAlumnos')


@section('contenido')
    <div class="container" style="padding: 10px">

        <div class="row text-center col-md-8 shadow-lg p-3 mb-5"
            style="margin: auto;border-radius: 17px; background: rgb(0, 26, 130); color: white">
            <h1>TEST DE COLORES</h1>
            <h5>Nombre: {{ $alumno->nombre . ' ' . $alumno->ap_paterno . ' ' . $alumno->ap_materno }} </h5>
            <h5>Numero de control: {{ $alumno->id }} </h5>
        </div>

        <div class="row col-md-10 shadow-lg p-3 mb-5 bg-body " style="margin: auto;border-radius: 17px">
            <div class="row text-center" style="margin: 5px">


                <h3> Ordena arrastrando los colores de acuerdo a tu preferencia</h2>
                    <div class="sortable">

                        @foreach ($colores as $item)
                            <div class="btn tamanio" data-id="{{ $item->alumno_id }}"
                                data-index="{{ $item->color_id }}" data-position="{{ $item->posicion }} "
                                style=" margin-right:10px; margin-left: 10px; background: {{ $item->color->codigo }}">
                            </div>
                        @endforeach

                    </div>
                    <div class="line">
                    </div>
                    <div class="row">
                        <div class="col emojis-h">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="bi bi-emoji-heart-eyes-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zM4.756 4.566c.763-1.424 4.02-.12.952 3.434-4.496-1.596-2.35-4.298-.952-3.434zm6.559 5.448a.5.5 0 0 1 .548.736A4.498 4.498 0 0 1 7.965 13a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .548-.736h.005l.017.005.067.015.252.055c.215.046.515.108.857.169.693.124 1.522.242 2.152.242.63 0 1.46-.118 2.152-.242a26.58 26.58 0 0 0 1.109-.224l.067-.015.017-.004.005-.002zm-.07-5.448c1.397-.864 3.543 1.838-.953 3.434-3.067-3.554.19-4.858.952-3.434z" />
                            </svg>
                            Favorito
                        </div>
                        <div class="col emojis-d">Menos Favorito

                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="bi bi-emoji-neutral-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm-3 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z" />
                            </svg>
                        </div>
                    </div>


                    <div>
                        <a type="button" class="btn btn-primary"
                            href="{{ route('menu-examen.show', $alumno->id) }}">Continuar</a>
                    </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.sortable').sortable({
                cursor: 'move',
                update: function(event, ui) {
                    $(this).children().each(function(index) {
                        if ($(this).attr('data-position') != (index + 1)) {
                            $(this).attr('data-position', (index + 1)).addClass('updated');
                        }
                    });
                    guardandoPosiciones();
                }
            });
        });

        function guardandoPosiciones() {
            var positions = [];


            $('.updated').each(function() {
                positions.push([$(this).attr('data-id'), $(this).attr('data-index'), $(this).attr(
                    'data-position')]);
                $(this).removeClass('updated');
            });

            $.ajax({

                type: 'POST',
                url: "{{ route('test_colores.store') }} ",

                data: {
                    update: 1,
                    positions: positions,
                    somefield: "Some field value",
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                }
            });
        }
    </script>


@endsection
