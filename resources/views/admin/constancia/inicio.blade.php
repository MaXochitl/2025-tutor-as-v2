<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Constancias</title>
</head>

<body>
    @foreach ($tutores as $item)

        <div style="text-align: center; padding-left: 60px; padding-top: 30px; height: 1000px; font-size: 15px">
            <div style="text-align: left; padding-left: 0px">
                <img src="./tutores/encabezado.jpg" height="60px" width="600px" alt="">
            </div>
            <div style="width: 600px; font-family: Arial, Helvetica, sans-serif;">
                <div style="text-align: right; margin-top: 30px">
                    Memorándum Nº OE /030/2021 <br>
                    ASUNTO: El que se indica <br>
                    Tantoyuca, Ver., 16 de marzo de 2021. <br>
                </div>
                <div style="text-align: left; margin-top: 40px">
                    <b>
                        ING.{{ $item->nombre . ' ' . $item->ap_paterno . ' ' . $item->ap_materno }}
                        <br>
                        DOCENTE <br>
                        PRESENTE <br>
                    </b>
                </div>
                <div style="text-align: justify; margin-top: 50px">
                    Por medio del presente se asigna como tutora de grupo del cuarto semestre grupo A de la carrera de
                    <b>
                        Ing.
                        En agronomía</b> para el periodo <b>Febrero - Julio 2021.</b> Para el seguimiento al programa
                    institucional
                    de
                    tutorías, Comprometiéndose con los requisitos que refiere el programa en la que estipula tener el
                    compromiso en el
                    seguimiento de los alumnos de forma personalizada en tiempos oportunos, desempeñarse
                    responsablemente
                    con los reportes mensuales, finales, así como información extraordinaria que se requiera, cumpliendo
                    con el 100% de las evidencias fotográficas generadas del seguimiento correspondiente, realizar las
                    canalizaciones
                    oportunas para el seguimiento pertinente en el área de orientación educativa después de haber
                    atendido
                    personalmente a casos especiales.
                </div>

                <div style="margin-top: 30px; text-align: left">
                    Sin otro particular, aprovecho la ocasión para enviarle un cordial saludo.
                </div>
                <div style="margin-top: 70px">
                    <b>
                        Atentamente
                    </b>
                </div>
                <div style="margin-top: 100px">
                    <table style="margin: auto; text-align: center">
                        <tr>
                            <td>
                                Psic. José Candelario García <br>
                                Orientación Educativa
                            </td>
                            <td>
                                Ing. Julio Meza Hernández <br>
                                Subdirector Académico
                            </td>
                            <td>
                                .I J. Guillermo Rivera Zumaya <br>
                                Director Académico
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    @endforeach

</body>

</html>
