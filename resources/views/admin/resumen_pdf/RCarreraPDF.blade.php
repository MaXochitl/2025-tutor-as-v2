<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formato</title>
</head>

<body>
    <table id="reporte-table">
        <tr>
            <th class="fix-fila" colspan="7">
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
            <td colspan="5">Programa educativo: Ing. Ambiental</td>
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

        <script>
            const numFilas = 5; // Cambiado a 8 filas

            const table = document.getElementById('reporte-table');

            for (let i = 0; i < numFilas; i++) { // Comienza en 0 y recorre 8 veces
                const newRow = document.createElement('tr');

                for (let j = 0; j < 6; j++) { // 7 columnas
                    const newCell = document.createElement('td');
                    if (j === 0) {
                        newCell.textContent = '...'; // Primera columna autoincrementable
                    } else {
                        newCell.textContent = '...'; // Otras columnas con contenido genérico
                    }
                    newCell.classList.add('fila');
                    newRow.appendChild(newCell);
                }

                table.appendChild(newRow);
            }
        </script>

        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 10;
                font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;

            }

            table {
                border: 1px solid black;
                border-collapse: collapse;
                width: 60%;
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
