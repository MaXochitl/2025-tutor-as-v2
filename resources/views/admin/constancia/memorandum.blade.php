<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Memorandum</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif">
    @php
        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_ALL, 'es_ES');
        $diassemana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'];
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $hoy = $diassemana[date('w')] . ' ' . date('d') . ' de ' . $meses[date('n') - 1] . ' del ' . date('Y');
        
        $inicio = $meses[date('n', strtotime($periodo->inicio)) - 1] . '  ' . date('Y', strtotime($periodo->inicio));
        $fin = $meses[date('n', strtotime($periodo->fin)) - 1] . '  ' . date('Y', strtotime($periodo->fin));
        $contador = 1;
    @endphp

    @foreach ($tutores as $item)
        <div style="text-align: center; padding-top: 30px; height: 800px; font-size: 16px;">
            <div style="text-align: left;">
                <img style=" padding-left: 40px" src="./tutores/encabezado.jpg" height="60px" width="600px" alt="">
                <div style="width: 550px; margin-left: 70px">

                    <div style="text-align: right; margin-top: 20px">
                        @if ($contador < 9)
                            Memorándum Nº OE /0{{ $contador++ }} /{{ date('Y') }}
                        @else
                            Memorándum Nº OE /{{ $contador++ }} /{{ date('Y') }}
                        @endif
                        <br>
                        <b>ASUNTO: El que se indica</b>
                        <br>
                        Tantoyuca, Ver., {{ $hoy }}
                    </div>

                    <div style="margin-top: 20px">
                        <b>

                            @php
                                $name = $item->nombre . ' ' . $item->ap_paterno . ' ' . $item->ap_materno;
                                echo $name;
                            @endphp
                            <br>
                            {{ $datos[1]->destinatario }}
                            <br>
                            PRESENTE
                        </b>
                    </div>

                    <div style="text-align: justify; margin-top: 30px">
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Por medio del presente se le otorga la
                        asignación como tutor del
                        @foreach ($item->asignaciones->where('periodo_id', $periodo->id) as $items)
                            {{ $items->semestre . '°' }}
                        @endforeach
                        semestre grupo
                        @foreach ($item->asignaciones->where('periodo_id', $periodo->id) as $items)
                            {{ $items->grupo }}
                        @endforeach
                        de la carrera
                        de
                        @php
                            
                            echo $item->carrera->nombre_carrera;
                        @endphp para el periodo {{ $inicio }} - {{ $fin }} . En seguimiento a
                        su solicitud recibida en el área de orientación educativa para participar en el programa
                        institucional de tutorías, Comprometiéndose a cumplir con los requisitos que refiere la
                        convocatoria en la que estipula tener el compromiso en el seguimiento de los alumnos de forma
                        personalizada en tiempos oportunos, desempeñarse responsablemente con los reportes mensuales,
                        finales, así como información extraordinaria que se requiera, contando con las evidencias
                        fotográficas generadas del seguimiento correspondiente para presentarlas al área en caso de ser
                        nesesario, realizar las canalizaciones oportunas para el seguimiento pertinente en el área de
                        orientación educativa después de haber
                        atendido personalmente a casos especiales.
                    </div>

                    <div style="margin-top: 30px; text-align: left">
                        Sin otro particular, aprovecho la ocasión para enviarle un cordial saludo.
                    </div>

                    <div style="margin-top: 30px; text-align: center">
                        <b>ATENTAMENTE</b>
                    </div>
                    <div style="margin-top: 50px; font-size: 15px">
                        <table style="margin: auto; text-align: center">
                            <tr style="height: 100px;">
                                <td colspan="2">
                                    <div style="margin-top: 70px">
                                    </div>
                                </td>
                                <td></td>

                            </tr>

                            <tr>
                                <td>{{ $datos[1]->atentamente_1 }}</td>
                                <td>{{ $datos[1]->atentamente_2 }}</td>
                                <td>{{ $datos[1]->atentamente_3 }}</td>
                            </tr>

                            <tr>
                                <td>{{ $datos[1]->cargo }}</td>
                                <td>{{ $datos[1]->cargo_2 }}</td>
                                <td>{{ $datos[1]->cargo_3 }}</td>
                            </tr>

                        </table>
                    </div>


                </div>
            </div>

        </div>
        <div style="margin-top: 10px; font-size: 15px;background: rgb(211, 211, 211)">
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
    @endforeach

</body>
