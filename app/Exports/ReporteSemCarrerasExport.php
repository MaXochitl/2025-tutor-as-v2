<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReporteSemCarrerasExport implements FromArray, WithDrawings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //
    }

    private $data;
    protected $totalMatricula;
    protected $totalTutores;
    protected $totalAlumnos;

    // Constructor para aceptar datos y encabezados dinámicos
    public function __construct(array $data, $totalMatricula, $totalTutores, $totalAlumnos)
    {
        $this->data = $data;
        $this->totalMatricula = $totalMatricula;
        $this->totalTutores = $totalTutores;
        $this->totalAlumnos = $totalAlumnos;
    }

    // Datos a exportar
    public function array(): array
    {
        // Agregar filas vacías para ajustar los datos a partir de A11
        $emptyRows = array_fill(0, 10, ['']);
        return array_merge($emptyRows, $this->data);
    }

    // Estilos
    public function styles(Worksheet $sheet)
    {
        $fecha = date("d/m/Y");

        // Estilo de bordes para todo el encabezado
        $sheet->getStyle('A5:J10')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A5:J10')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('FFFFFF');

        // Encabezado principal
        $sheet->mergeCells('A5:J5'); // Unión de celdas
        $sheet->setCellValue('A5', 'REPORTE SEMESTRAL DEL COORDINADOR DE TUTORÍA DEL DEPARTAMENTO ACADÉMICO');
        $sheet->getStyle('A5')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('00007C');
        $sheet->getStyle('A5')->getFont()->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A5:J10')->getFont()->setBold(true);

        $sheet->mergeCells('A6:H6');
        $sheet->setCellValue('A6', 'Nombre del Coordinador Institucional de Tutoría: Lic. Emma Valeria Ramírez Guzmán');

        $sheet->mergeCells('I6:J7');
        $sheet->setCellValue('I6', "Fecha: $fecha");
        $sheet->getStyle('I6')->getAlignment()->setHorizontal('center');

        $sheet->mergeCells('D8:E9');
        $sheet->setCellValue('D8', "Estudiantes atendidos\nen el semestre");
        $sheet->getStyle('D8:E9')->getAlignment()->setHorizontal('center');

        // Habilitar ajuste de texto para que se muestre completo
        $sheet->getStyle('D8:E9')->getAlignment()->setWrapText(true);

        // Fila de encabezados
        $sheet->getStyle('A8:J8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('D10:E10')->getAlignment()->setHorizontal('center');

        $sheet->setCellValue('A8', 'Programa educativo');
        $sheet->getStyle('A8:B10')->getAlignment()->setWrapText(true);

        $sheet->setCellValue('C8', 'Cantidad de tutores');
        $sheet->getStyle('C8:C10')->getAlignment()->setWrapText(true);

        $sheet->setCellValue('D10', 'Tutoría grupal');
        $sheet->getStyle('D10:E9')->getAlignment()->setWrapText(true);

        $sheet->setCellValue('E10', 'Tutoría individual');
        $sheet->getStyle('E10:E9')->getAlignment()->setWrapText(true);

        $sheet->setCellValue('F8', "Estudiantes Canalizados");
        $sheet->getStyle('F8:G10')->getAlignment()->setWrapText(true);

        $sheet->setCellValue('H8', 'Área canalizada');
        $sheet->getStyle('H8:I10')->getAlignment()->setWrapText(true);

        $sheet->setCellValue('J8', 'Matrícula');

        //Celdas del encabezado unidas
        $sheet->mergeCells('A1:A4');
        $sheet->mergeCells('A8:B10');
        $sheet->mergeCells('C8:C10');
        $sheet->mergeCells('F8:G10');
        $sheet->mergeCells('H8:I10');
        $sheet->mergeCells('J8:J10');

        //Matricula (parte del encabezado) 
        $sheet->mergeCells('A7:H7'); // Fusionar celdas
        $sheet->setCellValue('A7', "Matrícula del Instituto Tecnológico actual: " . $this->totalMatricula);

        // Ajustar el tamaño de las celdas
        $sheet->getColumnDimension('A')->setWidth(4);
        $sheet->getColumnDimension('B')->setWidth(42);
        $sheet->getColumnDimension('C')->setWidth(10);
        $sheet->getColumnDimension('D')->setWidth(14);
        $sheet->getColumnDimension('E')->setWidth(16);
        $sheet->getColumnDimension('F')->setWidth(6);
        $sheet->getColumnDimension('G')->setWidth(6);
        $sheet->getColumnDimension('H')->setWidth(6);

        // Llenado de columnas dinamicamente
        $lastRow = 10 + count($this->data);
        $sheet->getStyle("A11:J$lastRow")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Suponiendo que $lastRow es la última fila con datos
        for ($row = 11; $row <= $lastRow; $row++) {
            // Unir las celdas F y H en la fila $row
            $sheet->mergeCells("F$row:G$row");
            $sheet->mergeCells("H$row:I$row");
            $sheet->getStyle("A$row")->getAlignment()->setHorizontal('center');
            $sheet->getStyle("C$row")->getAlignment()->setHorizontal('center');
            $sheet->getStyle("D$row")->getAlignment()->setHorizontal('center');
            $sheet->getStyle("E$row")->getAlignment()->setHorizontal('center');
            $sheet->getStyle("F$row")->getAlignment()->setHorizontal('center');
            $sheet->getStyle("H$row")->getAlignment()->setHorizontal('center');
            $sheet->getStyle("J$row")->getAlignment()->setHorizontal('center');
        }

        // Fila final dinamica
        $nextRow = $lastRow + 1;
        $sheet->setCellValue("A$nextRow", "Resultados");
        $sheet->setCellValue("C$nextRow", '' . $this->totalTutores);
        $sheet->setCellValue("D$nextRow", '' . $this->totalAlumnos);
        $sheet->setCellValue("J$nextRow", '' . $this->totalMatricula);

        // Estilo separado para la fila dinamica final
        $sheet->getStyle("A$nextRow:J$nextRow")->getFont()->setBold(true);
        $sheet->getStyle("A$nextRow:J$nextRow")->getAlignment()->setHorizontal('center');
        $sheet->getStyle("A$nextRow:J$nextRow")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle("A$nextRow:J$nextRow")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('00007C');
        $sheet->getStyle("A$nextRow:J$nextRow")->getFont()->getColor()->setRGB('FFFFFF');
        $sheet->mergeCells("A$nextRow:B$nextRow");
        $sheet->mergeCells("F$nextRow:G$nextRow");
        $sheet->mergeCells("H$nextRow:I$nextRow");

        // Apartados de firmas
        $signatureRow1 = $nextRow + 4; // Primera fila de firmas, dejando una fila vacía después de la dinámica
        $signatureRow2 = $signatureRow1 + 1; // Segunda fila de firmas

        // Líneas para las firmas
        $sheet->setCellValue("B$signatureRow1", "__________________________________________");
        $sheet->mergeCells("E$signatureRow1:I$signatureRow1");
        $sheet->setCellValue("E$signatureRow1", "__________________________________________");

        $sheet->getStyle("B$signatureRow1")->getAlignment()->setHorizontal('center');
        $sheet->getStyle("E$signatureRow1:I$signatureRow1")->getAlignment()->setHorizontal('center');

        // Títulos de las firmas con saltos de línea
        $sheet->setCellValue("B$signatureRow2", "Nombre y firma del jefe de\ndepartamento académico");
        $sheet->mergeCells("E$signatureRow2:I$signatureRow2");
        $sheet->setCellValue("E$signatureRow2", "Nombre y firma del Coordinador de Tutoría\ndel Departamento Académico");

        // Estilo para los títulos de las firmas
        $sheet->getStyle("B$signatureRow2")->getFont()->setBold(true);
        $sheet->getStyle("E$signatureRow2:I$signatureRow2")->getFont()->setBold(true);
        $sheet->getStyle("B$signatureRow2")->getAlignment()->setHorizontal('center');
        $sheet->getStyle("E$signatureRow2:I$signatureRow2")->getAlignment()->setHorizontal('center');

        $sheet->getStyle("B$signatureRow2")->getAlignment()->setWrapText(true);
        $sheet->getStyle("E$signatureRow2:I$signatureRow2")->getAlignment()->setWrapText(true);

        //Identificación del documento
        $messageRow = $signatureRow2 + 4; 

        $sheet->setCellValue("B$messageRow", "R00-0824");
        $sheet->setCellValue("J$messageRow", "F-OE-07");

        $sheet->getStyle("B$messageRow")->getFont()->setItalic(true);
        $sheet->getStyle("I$messageRow")->getFont()->setItalic(true);
        $sheet->getStyle("B$messageRow")->getAlignment()->setHorizontal('left');
        $sheet->getStyle("I$messageRow")->getAlignment()->setHorizontal('right');

        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Ajusta el tamaño de la fila para la imagen
                $sheet->getRowDimension(1)->setRowHeight(70);

            },
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo del informe');
        $drawing->setPath(public_path('tutores/logo_reporteSC.png')); // Ruta a la imagen
        $drawing->setHeight(69); // Altura de la imagen
        $drawing->setCoordinates('A1'); // Coordenadas donde se insertará
        return $drawing;
    }

}

