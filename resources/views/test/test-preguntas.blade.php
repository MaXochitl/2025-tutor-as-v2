@foreach ($respuestas as $item)
    {{ $item->pregunta }}
    {{ $item->respuesta }}
    <br>
@endforeach

<br>
<br>

@for ($i = 0; $i < count($respuestas); $i += 3)
    {{ $respuestas[$i]->pregunta->pregunta }} <br>
    
    @foreach ($respuestas->where('pregunta_id', $respuestas[$i]->pregunta->id) as $item)
        {{$item->respuesta}}
    @endforeach
    <br>
@endfor
