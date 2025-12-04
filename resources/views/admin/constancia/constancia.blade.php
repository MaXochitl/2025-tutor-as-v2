<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Constancias</title>
</head>

<body>
    @php
        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_ALL, 'es_ES');
        $diassemana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'];
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
      //  $hoy = $diassemana[date('w')] . ' ' . date('d') . ' de ' . $meses[date('n') - 1] . ' del ' . date('Y');
      $hoy = date('d') . ' días del mes de ' . $meses[date('n') - 1] . ' del año ' . date('Y');
        $inicio = $meses[date('n', strtotime($periodo->inicio)) - 1] . '  ' . date('Y', strtotime($periodo->inicio));
        $fin = $meses[date('n', strtotime($periodo->fin)) - 1] . '  ' . date('Y', strtotime($periodo->fin));
        
    @endphp
    @foreach ($tutores as $item)
        <div style="text-align: center; padding-left: 60px; padding-top: 30px; height: 1000px; font-size: 15px">
            <div style="text-align: left">
                <img style="" src="./tutores/encabezado.jpg" height="60px" width="600px" alt="">
            </div>
            <div style="width: 600px; font-family: Arial, Helvetica, sans-serif; font-size: 16px">
                <div style="text-align: left; margin-top: 30px">
                    <b>A QUIEN CORRESPONDA</b> <br>
                    {{ $datos[0]->destinatario }}


                </div>
                <div style="text-align: justify; margin-top: 40px">
                    &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; El suscrito, Coordinador del programa institucional de tutorías del Instituto Tecnológico Superior de Tantoyuca, Veracruz. <br>

                    <br>
                    <div style="text-align: center; margin-top: 10px">
                        
<!-- codigo para soportar uno o multiples semestresgrupos-->
@php
    $asignacionesPeriodo = $item->asignaciones
        ->where('periodo_id', $periodo->id)
        ->sortBy(function ($a) {
            return sprintf('%02d%s', $a->semestre, strtoupper($a->grupo));
        })
        ->values();

    $count = $asignacionesPeriodo->count();

    if ($count > 1) {
        // Si hay más de un grupo, agregar “y” antes del último
        $listaSemGrup = $asignacionesPeriodo
            ->slice(0, $count - 1)
            ->map(fn($a) => $a->semestre . '°' . strtoupper($a->grupo))
            ->implode(', ')
            . ' y ' .
            $asignacionesPeriodo->last()->semestre . '°' .
            strtoupper($asignacionesPeriodo->last()->grupo);
    } else {
        // Solo un grupo
        $single = $asignacionesPeriodo->first();
        if ($single && $single->semestre != 0 && $single->grupo != 'sin asignar') {
            $listaSemGrup = $single->semestre . '°' . strtoupper($single->grupo);
        } else {
            $listaSemGrup = 'NO ASIGNADO'; // = 'No asignado'; para mostrar algo
        }
    }

    $esPlural = $count > 1;
@endphp

                        <p style="font-size: 20px"> <b>H A C E &nbsp;&nbsp; C O N S T A R</b> </p>
                    </div>

                </div>
                <div style="text-align: justify; margin-top: 10px">
                    Que el (la)
                    @php
                        $name = $item->nombre . ' ' . $item->ap_paterno . ' ' . $item->ap_materno;
                        echo $name;
                    @endphp
                    del programa académico de


                    @if ($item->carrera != null)
                        @php
                            #$name = strtolower($item->carrera->nombre_carrera);
                            #echo ucwords($name);
                            echo $item->carrera->nombre_carrera;
                        @endphp
                    @endif

                    llevó a cabo
                    el PROGRAMA INSTITUCIONAL DE TUTORÍA de forma grupal, durante el periodo

                    {{ $inicio }} – {{ $fin }} con
                    un total de 16 Hrs en el Instituto Tecnológico Superior de Tantoyuca, atendiendo a
                    {{ $alumnos_tutorados->where('tutor_id', $item->id)->where('periodo_id', $periodo->id)->where('tipo', 1)->count() }}
                    alumnos,
<!-- mostrar de forma correcta el o los semestresgrupos-->
@if ($esPlural)
    de los semestres y grupos
@else
    del semestre y grupo
@endif
@if ($listaSemGrup == 'NO ASIGNADO')
    <b>{{ $listaSemGrup }}</b><!-- resaltar en negritas el error al personal de OE-->
@else
    {{ $listaSemGrup }}<!-- mostrar normal sin resaltar-->
@endif
                    , cumpliendo el 100% de las actividades del
                    programa, con un
                    índice de
                    deserción del 0%.
                </div>

                <div style="margin-top: 10px; text-align: justify">
                    Se extiende la presente, para los fines legales que al interesado convengan, en la ciudad de Tantoyuca, Veracruz, a los 
                    {{ $hoy.'.' }}
                </div>
                <div style="margin-top: 30px">
                     <br>

                </div>
                <div style="margin-top: 10px">
                    <table style="margin: auto; text-align: center">
                        <tr style="height: 100px;">
                            <td colspan="2">
                                <b>
                                    Atentamente
                                    <div style="margin-top: 70px">
                                    </div>
                                </b>
                            </td>
                            <td>
                                <b>
                                    Vo. Bo.
                                </b>
                                <div style="margin-top: 70px">
                                </div>
                            </td>

                        </tr>

                        <tr>
                            <td>{{ $datos[0]->atentamente_1 }}</td>
                            <td>{{ $datos[0]->atentamente_2 }}</td>
                            <td>{{ $datos[0]->atentamente_3 }}</td>
                        </tr>

                        <tr>
                            <td>{{ $datos[0]->cargo }}</td>
                            <td>{{ $datos[0]->cargo_2 }}</td>
                            <td>{{ $datos[0]->cargo_3 }}</td>
                        </tr>

                    </table>
                </div>
            </div>

            <div style="width: 95%; margin-top: 150px; font-size: 15px;background: rgb(211, 211, 211)">
                <table style="margin: auto; text-align: center">
                    <tr style="height: 100px;">
                        <td style="text-align: left">
    
                            <img src="./tutores/logo.png" height="100px" width="100px" width="400px" alt="">
    
                        </td>
                        <td>
                            Desv. Lindero – Tametate S/N, Col. La Morita <br>
                            CP 92100, Tantoyuca, Veracruz <br>
                            Tel. (01 789) 8931680, 8931552 <br>
                            https://itsta.edu.mx
    
                        </td>
                        <td style="text-align: right">
                            <img src="./tutores/logo2.png" height="100px" width="100px" width="600px" alt="">
    
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        
    @endforeach

</body>

</html>
