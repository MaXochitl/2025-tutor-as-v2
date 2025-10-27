<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F-OE-08 REPORTE SEMESTRAL DEL TUTOR</title>
    
</head>
@php
    // Ordenar alfanuméricamente: primero por semestre (número), luego por grupo (letra)
    $asignadoOrdenado = collect($asignado)->sortBy(function($a) {
        return sprintf('%02d%s', $a->semestre, strtoupper($a->grupo));
    });
@endphp
<body>
    <table>
        <th>
            <img src="./tutores/tecnologico.jpg" class="img-no-border" height="60">
        </th>
        <tr>
            <td class="title" colspan="2">
                REPORTE SEMESTRAL DEL TUTOR
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td><strong>Nombre del Tutor:</strong> {{ $tutor->nombre }} {{ $tutor->ap_paterno }} {{ $tutor->ap_materno }}</td>
            <td><strong>Periodo:</strong>  {{ $inicio_p . ' - ' . $fin_p }} </td>
        </tr>
    </table>
    <table>
        <tr>
            <td><strong>Programa Educativo: </strong> {{ $tutor->carrera->nombre_carrera }}</td>
            <td><strong>Semestre y Grupo: </strong> 
            @foreach($asignadoOrdenado as $asig)
            {{ $asig->semestre }}° {{ strtoupper($asig->grupo) }}@if(!$loop->last), @endif
            @endforeach
            <td><strong>Fecha de Entrega: </strong> {{ $fechaPDF }}</td>
        </tr>
    </table>

    <!-- Ordenar alumnos alfanumericamente por semestre (numero) y grupo (letra)-->
    @php
    $alumnosOrdenados = collect($alumnos_tutor)->sortBy(function($a) {
        $sem = $a->semestre ?? 0;
        $grp = strtoupper($a->alumno->grupo ?? '');
        return sprintf('%02d%s', $sem, $grp);
    })->values();
    @endphp

    @foreach($alumnosOrdenados as $index => $alumno)<!-- iterar sobre alumnosOrdenados-->
    @if($index % 15 == 0 && $index != 0)
        <div class="page-break"></div>
    @endif
    @if($index % 15 == 0)
        <table>
            <thead>
                <tr class="sub-header">
                    <td rowspan="2" style="width: 5%;">No.</td>
                    <td rowspan="2" style="width: 20%;">Lista de estudiantes</td>
                    <td rowspan="2" style="width: 5%;">Grupo y Semestre</td><!-- mostrar col de sem y grup-->
                    <td rowspan="2" style="width: 10%;">Firma del alumno</td>
                    <td colspan="2">Estudiantes atendidos en el semestre</td>
                    <td rowspan="2" style="width: 15%;">Estudiantes canalizados en el semestre</td>
                    <td rowspan="2" style="width: 15%;">Área canalizada</td>
                </tr>
                <tr class="sub-header">
                    <td>Tutoría Grupal</td>
                    <td>Tutoría Individual</td>
                </tr>
            </thead>
            <tbody>
    @endif
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $alumno->alumno ? $alumno->alumno->ap_paterno . ' ' . $alumno->alumno->ap_materno . ' ' . $alumno->alumno->nombre : 'Sin alumno' }}</td>
                <td>{{ $alumno->semestre . '° ' . strtoupper($alumno->alumno->grupo)}}</td> <!-- mostrar dato de sem y grup-->
                <td></td>
                <td>@if($alumno->alumno->atencion && in_array($alumno->alumno->atencion->atencion, ['Grupal', 'Grupal/Individual'])) X @endif</td>
                <td>@if($alumno->alumno->atencion && in_array($alumno->alumno->atencion->atencion, ['Individual', 'Grupal/Individual'])) X @endif</td>
                <td>{{ $alumno->alumno->atencion->canalizado ?? 'No canalizado' }}</td>
                <td>{{ $alumno->alumno->atencion->area_canalizada ?? 'Sin área' }}</td>
            </tr>
    @if(($index + 1) % 15 == 0 || $index + 1 == count($alumnos_tutor))
            </tbody>
        </table>
    @endif
@endforeach

    
    <table style="width: 100%; margin-top: 50px; text-align: center; border: none;">
        <tr>
            <td style="border: none; padding: 40px;">
                <div style="border-top: 1px solid black; margin-top: 20px;"></div>
                <strong>Firma del Coordinador Institucional de Tutorias</strong>
                <br>
                <span>Lic. Emma Valeria Ramírez Guzmán</span>
            </td>
            <td style="border: none; padding: 40px;">
                <div style="border-top: 1px solid black; margin-top: 20px;"></div>
                <strong>Firma del Jefe del Departamento:</strong>
                <br>
                <span>{{ $jefeDepartamento }}</span>
            </td>
            <td style="border: none; padding: 40px;">
                <div style="border-top: 1px solid black; margin-top: 20px;"></div>
                <strong>Firma del Coordinador de Tutorias del Programa Educativo</strong>
                <br>
                <span>{{ $tutor->nombre }} {{ $tutor->ap_paterno }} {{ $tutor->ap_materno }}</span>
            </td>
        </tr>
    </table>

    <footer>
    <p style="display: inline-block; margin: 0 20px 0 0;">R00/0824</p>
    <p style="display: inline-block; margin: 0 0 0 600px;">F-OE-08</p>
</footer>

</body>


<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }
         td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        .header-table {
            border: 1px solid black;
        }
        .header-table td {
            border: none;
            padding: 5px;
        }
        .title {
            background-color: #003366;
            color: white;
            font-size: 1.1em;
            font-weight: bold;
            text-align: center;
            padding: 5px;
        }
        .small-title {
            font-weight: bold;
            text-align: left;
            padding-left: 5px;
        }
        .double-border {
            border: 1px solid black;
        }
        .sub-header {
            font-size: 0.9em;
            font-weight: bold;
            background-color: #f2f2f2;
        }
        .img-no-border {
        display: block; /* Elimina espacios extras alrededor de la imagen */
        margin: 0; /* Asegura que no haya márgenes */
        border: none; /* Elimina cualquier borde */
        padding: 0; /* Asegura que no haya relleno */
        }

        /*td {
            border: none; 
            padding: 0;   |
            margin: 0;
        }*/

        .page-break {
            page-break-before: always;
        }
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 180%;
            padding: 10px 0;
        }


    </style>
</html>