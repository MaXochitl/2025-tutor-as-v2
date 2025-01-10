@php
date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL, 'es_ES');
$diassemana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'];
$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
$semestres = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17];
$grupos = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N'];
@endphp
@foreach ($periodos->where('id', $periodo) as $item)
                            @php
                            $inicio = $meses[date('n', strtotime($item->inicio)) - 1] . ' ' . date('Y', strtotime($item->inicio));
                            $fin = $meses[date('n', strtotime($item->fin)) - 1] . ' ' . date('Y', strtotime($item->fin));
@endphp
@endforeach

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F-OE-04 FORMATO DE PLAN DE TRABAJO DE TUTORIAS</title>
    <style>
        
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 10px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-size: 10px; 
        }

        table {
            border: 1px solid rgb(0, 0, 0);
            border-collapse: collapse;
            width: 100%; 
            table-layout: fixed;         }

        td,
        th {
            border: 1px solid black;
            padding: 5px; 
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 12px; 
        }

        .second-fila {
            background-color: rgba(108, 103, 96, 0.481);
            color: black;
            text-align: center;
        }

        .first-fila {
            padding: 8px;
            text-align: center;
            background-color: rgb(31, 5, 126);
            color: white;
            font-style: normal;
        }

        .double-fila td {
            text-align: left;
            padding: 5px; 
        }

        .signature-container {
            position: relative;
            width: 100%;
            height: 100px; 
            margin-top: 50px;
        }

        .signature {
            position: absolute;
            width: 200px;
        }

        .signature-left {
            top: 50px; 
            left: 20px; 
        }

        .signature-right {
            top: 50px;
            right: 120px; 
        }

        .signature p {
            margin-top: 5px; 
            text-align: center; 
            font-size: 10px; 
            width: 300px; 
        }

        .signature hr {
            border: none;
            height: 3px; 
            background-color: black; 
            margin: 0;
            width: 150%; 
        }
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 180%;
            padding: 10px 0;
        }
    </style>
</head>

<body>
    <div style="text-align:center">
        
        <img src="./tutores/tecnologico.jpg" height="60px" width="630px" alt="">
    </div>
    <table id="reporte-table">
        <thead>
            
        </thead>
        <tbody>
        <tr>
                <th class="first-fila" colspan="12"><strong>ORIENTACION EDUCATIVA</strong></th>
            </tr>
            <tr class="second-fila">
                <td colspan="12"><strong>COORDINACION INSTITUCIONAL DE TUTORIAS</strong></td>
            </tr>
            <tr class="second-fila">
                <td colspan="12"><strong>PLAN DE ACCION TUTORIAL</strong></td>
            </tr>
            
            <tr class="double-fila">
                <td colspan="6">Nombre de la Persona Tutora: <strong>{{ $tutor->nombre }} {{ $tutor->ap_paterno }} {{ $tutor->ap_materno }}</strong>
                </td>
                <td colspan="6">Periodo :<strong> {{$inicio}} - {{$fin}}</strong> </td>
            </tr>
            <tr class="double-fila">
                <td colspan="6">Tipo de Tutoria : <strong>Individual/Grupal</strong></td>
                <td colspan="6">Programa Educativo : <strong>{{$tutor->carrera->nombre_carrera}}</strong></td>
            </tr>
            <tr class="double-fila">
                <td colspan="6">Semestre y Grupo :<strong> {{$asignado[0]->semestre}}° {{ $asignado[0]->grupo }}</strong></td>
                <td colspan="6">N° de Personas tutoradas : <strong>{{$total}}</strong> 
                    <br>
                     Hombres: <strong>{{$hombres}}</strong>, Mujeres: <strong>{{$mujeres}} </strong></td>
            </tr>
            <tr class="double-fila">
                <td colspan="2"><strong>NÚMERO DE SESIONES </strong></td>
                <td colspan="2"><strong>TEMA </strong></td>
                <td colspan="2"><strong>DESCRIPCIÓN DE LA ACTIVIDAD </strong></td>
                <td colspan="2"><strong>FECHA </strong></td>
                <td colspan="2"><strong>TIEMPO </strong></td>
                <td colspan="2"><strong>RECURSOS </strong></td>
            </tr>

            <!-- Actividades -->
            @foreach($actividades as $index => $actividad)
            <tr class="double-fila">
                <td colspan="2">{{ $index + 1 }}</td> 
                <td colspan="2">{{ $actividad->tema }}</td>
                <td colspan="2">{{ $actividad->descripcion_actividad }}</td>
                <td colspan="2">{{ $actividad->fecha->format('Y/m/d') }}</td> 
                @php
                    $hora = \Carbon\Carbon::parse($actividad->tiempo);
                @endphp
                <td colspan="2">{{ $hora->format('H:i') }} hrs</td>
                <td colspan="2">{{ $actividad->recursos }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Contenedor para las firmas -->
    <div class="signature-container">
        <div class="signature signature-left">
            <hr>
            <p><strong>{{ $tutor->nombre }} {{ $tutor->ap_paterno }} {{ $tutor->ap_materno }}</strong>
            <p> Nombre de la Persona Tutora </p>
            
            </p>
        </div>

        <div class="signature signature-right">
            <hr>
            <p><strong>{{ $name }}<strong></p>
            <p>Nombre y del Coordinador de tutorías por programa eduacativo</p>
            
        </div>
    </div>

    <footer>
    <p style="display: inline-block; margin: 0 20px 0 0;">R00/0824</p>
    <p style="display: inline-block; margin: 0 0 0 600px;">F-OE-04</p>
</footer>


</body>
</html>

