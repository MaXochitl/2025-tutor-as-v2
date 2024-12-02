<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Constancias</title>
</head>

<body>

    <div style="text-align: center; padding-left: 0; padding-top: 0px; height: 1000px; font-size: 15px">

        <div style="margin-top: 10px">
            <table style="margin: auto; text-align: center">
                <thead>
                    <tr>
                        <th class="fix-fila" colspan="6">
                            REPORTE SEMESTRAL DEL COORDINADOR DE TUTORIA DEL DEPARTAMENTO ACADÉMICO
                        </th>
                    </tr>
                    <tr class="asign-color">
                        <td colspan="6">Instituto Tecnológico Superior de Tantoyuca</td>
                    </tr>
                    <tr class="asign-color">
                        <td colspan="5">Nombre del Coordinador de Tutoria del Departamento Académico:
                            Li. Emma Valeria Ramirez Guzmán</td>
                        <td class="borde">Fecha: 01/01/2024</td>
                    </tr>
                    <tr class="asign-color">
                        <td colspan="5">Programa educativo: {{ $carrera->nombre_carrera }}</td>
                        <td class="generar-borde">Hora: 10:40</td>
                    </tr>
                    <tr class="asign-color">
                        <td class="borde"> </td>
                        <td class="borde"> </td>
                        <td class="fila" colspan="2">Estudiantes atendidos en el semestre</td>
                        <td class="borde"></td>
                        <td class="generar-borde"></td>
                    </tr>
                    <tr class="asign-color">
                        <td class="borde">Lista de tutores</td>
                        <td class="borde">Grupo</td>
                        <td class="borde">Tutoría grupal</td>
                        <td class="borde">Tutoría individual</td>
                        <td class="borde">Estudiantes canalizados en el semestre</td>
                        <td class="borde">Area canalizada</td>

                    </tr>
                    <tr class="asign-color">
                        <!--si sale alguna mala funcion en la formacion de las celdas cambiar a generar-borde en class-->
                        <td class="borde"> </td>
                        <td class="borde"> </td>
                        <td class="borde"> </td>
                        <td class="borde"> </td>
                        <td class="borde"> </td>
                        <td class="borde"> </td>

                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($tutores); $i++)
                        <tr>
                            <td>
                                {{ $tutores[$i]['nombre_tutor'] . ' ' . $tutores[$i]['ap_paterno'] . ' ' . $tutores[$i]['ap_materno'] }}
                            </td>
                            <td>{{ $tutores[$i]['semestre'] . ' ' . $tutores[$i]['grupo'] }}</td>
                            <td>{{ $tutores[$i]['total_registros'] }}</td>
                            <td>Hola</td>
                            <td>{{ $tutores[$i]['falls'] }}</td>
                            <td>Orientacion Educativa</td>
                        </tr>
                    @endfor

                </tbody>
            </table>
        </div>
    </div>

</body>


<style>
    table {
        border: 1px solid black;
        border-collapse: collapse;

    }

    .asign-color {
        background-color: rgba(237, 235, 224);
        color: black;
    }

    td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 5px;
        text-align: left;

    }

    .fix-fila {
        padding: 8px;
        text-align: center;
        background-color: black;
        color: white;
        font-style: normal;
    }

    .fila {
        text-align: center;
    }

    .borde {
        padding: 5px;
        border-top: none;
        border-right: 1px solid black;
        border-bottom: none;
        border-left: none;
        text-align: center;

    }

    /*prueba no borrar*/
    .generar-borde {
        padding: 5px;
        border-top: 1px solid black;
        border-right: none;
        border-bottom: none;
        border-left: none;
        text-align: center;
    }
</style>

</html>
