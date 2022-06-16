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
        $hoy = $diassemana[date('w')] . ' ' . date('d') . ' de ' . $meses[date('n') - 1] . ' del ' . date('Y');
        $inicio = $meses[date('n', strtotime($periodo->inicio)) - 1] . '  ' . date('Y', strtotime($periodo->inicio));
        $fin = $meses[date('n', strtotime($periodo->fin)) - 1] . '  ' . date('Y', strtotime($periodo->fin));
        
    @endphp
    @foreach ($tutores as $item)
        <div style="text-align: center; padding-left: 60px; padding-top: 30px; height: 1000px; font-size: 15px">
            <div style="text-align: left">
            </div>
            <div style="width: 600px; font-family: Arial, Helvetica, sans-serif; font-size: 16px">
                <div style="text-align: left; margin-top: 30px">
                    <b>A QUIEN CORRESPONDA</b> <br>
                    {{ $datos[0]->destinatario }}


                </div>
                <div style="text-align: justify; margin-top: 40px">
                    &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; El suscrito, Coordinador del programa
                    institucional
                    de tutorías del Instituto Tecnológico Superior de Tantoyuca, Veracruz. <br>

                    <br>
                    <div style="text-align: center; margin-top: 60px">
                        <p style="font-size: 20px"> <b>H A C E &nbsp;&nbsp; C O N S T A R</b> </p>
                    </div>

                </div>
                <div style="text-align: justify; margin-top: 50px">
                    &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Que el (la)
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
                    alumnos, de
                    @foreach ($item->asignaciones->where('periodo_id', $periodo->id) as $items)
                        {{ $items->semestre . '°' }}
                    @endforeach
                    semestre grupo
                    @foreach ($item->asignaciones->where('periodo_id', $periodo->id) as $items)
                        {{ $items->grupo }}
                    @endforeach
                    , cumpliendo el 100% de las actividades del
                    programa, con un
                    índice de
                    deserción del 0%.
                </div>

                <div style="margin-top: 30px; text-align: left">
                    Sin otro particular, aprovecho la ocasión para enviarle un cordial saludo.
                </div>
                <div style="margin-top: 70px">
                    {{ $hoy }} <br>

                </div>
                <div style="margin-top: 90px">
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
        </div>
    @endforeach

</body>

</html>
