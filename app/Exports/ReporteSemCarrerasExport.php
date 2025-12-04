<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReporteSemCarrerasExport implements FromArray, WithDrawings, WithStyles, WithEvents
{
    private $data;
    protected $totalTutores;
    protected $totalTutoriaGrupal;

    public function __construct(
        array $data, 
        $totalTutores, 
        $totalTutoriaGrupal,
    ) {
        $this->data = $data;
        $this->totalTutores = $totalTutores;
        $this->totalTutoriaGrupal = $totalTutoriaGrupal;
    }

    public function array(): array
    {
        $emptyRows = array_fill(0, 10, ['']);
        return array_merge($emptyRows, $this->data);
    }

    public function styles(Worksheet $sheet)
    {
        $fecha = date("d/m/Y");

        $sheet->getStyle('A5:J10')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A5:J10')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('FFFFFF');

        $sheet->mergeCells('A5:J5');
        $sheet->setCellValue('A5', 'REPORTE SEMESTRAL DEL COORDINADOR DE TUTORÍA DEL DEPARTAMENTO ACADÉMICO');
        $sheet->getStyle('A5')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('00007C');
        $sheet->getStyle('A5')->getFont()->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A5:J10')->getFont()->setBold(true);

        $sheet->mergeCells('A6:G6');
        $sheet->setCellValue('A6', 'Nombre del Coordinador Institucional de Tutoría: ');

        $sheet->mergeCells('H6:J7');
        $sheet->setCellValue('H6', "Fecha: $fecha");
        $sheet->getStyle('H6')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('H6')->getAlignment()->setVertical('center');

        $sheet->mergeCells('D8:E9');
        $sheet->setCellValue('D8', "Estudiantes atendidos\nen el semestre");
        $sheet->getStyle('D8:E9')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('D8:E9')->getAlignment()->setWrapText(true);

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

        $sheet->mergeCells('A1:A4');
        $sheet->mergeCells('A8:B10');
        $sheet->mergeCells('C8:C10');
        $sheet->mergeCells('F8:G10');
        $sheet->mergeCells('H8:I10');
        $sheet->mergeCells('J8:J10');

        $sheet->mergeCells('A7:G7');
        $sheet->setCellValue('A7', "Matrícula del Instituto Tecnológico actual: " . $this->totalTutoriaGrupal);

        $sheet->getColumnDimension('A')->setWidth(4);
        $sheet->getColumnDimension('B')->setWidth(42);
        $sheet->getColumnDimension('C')->setWidth(10);
        $sheet->getColumnDimension('D')->setWidth(14);
        $sheet->getColumnDimension('E')->setWidth(16);
        $sheet->getColumnDimension('F')->setWidth(6);
        $sheet->getColumnDimension('G')->setWidth(6);
        $sheet->getColumnDimension('H')->setWidth(6);

        $lastRow = 10 + count($this->data);
        $sheet->getStyle("A11:J$lastRow")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        for ($row = 11; $row <= $lastRow; $row++) {
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

        $nextRow = $lastRow + 1;
        $sheet->setCellValue("A$nextRow", "Resultados");
        $sheet->setCellValue("C$nextRow", '' . $this->totalTutores);
        $sheet->setCellValue("D$nextRow", '' . $this->totalTutoriaGrupal);
        $sheet->mergeCells("F$nextRow:G$nextRow");
        $sheet->mergeCells("F$nextRow:G$nextRow");
        $sheet->mergeCells("F$nextRow:G$nextRow");
        $sheet->setCellValue("J$nextRow", '' . $this->totalTutoriaGrupal);

        $sheet->getStyle("A$nextRow:J$nextRow")->getFont()->setBold(true);
        $sheet->getStyle("A$nextRow:J$nextRow")->getAlignment()->setHorizontal('center');
        $sheet->getStyle("A$nextRow:J$nextRow")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle("A$nextRow:J$nextRow")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('00007C');
        $sheet->getStyle("A$nextRow:J$nextRow")->getFont()->getColor()->setRGB('FFFFFF');
        $sheet->mergeCells("A$nextRow:B$nextRow");
        $sheet->mergeCells("H$nextRow:I$nextRow");

        $signatureStart = $nextRow + 4; 

        $signatureRow1 = $signatureStart;
        $signatureRow2 = $signatureStart + 2;

        $sheet->setCellValue("B$signatureRow1", "__________________________________________");
        $sheet->mergeCells("E$signatureRow1:I$signatureRow1");
        $sheet->setCellValue("E$signatureRow1", "__________________________________________");

        $sheet->getStyle("B$signatureRow1")->getAlignment()->setHorizontal('center');
        $sheet->getStyle("E$signatureRow1:I$signatureRow1")->getAlignment()->setHorizontal('center');

        $sheet->setCellValue("B$signatureRow2", "Nombre y firma del jefe de\ndepartamento académico");
        $sheet->mergeCells("E$signatureRow2:I$signatureRow2");
        $sheet->setCellValue("E$signatureRow2", "Nombre y firma del Coordinador de Tutoría\ndel Departamento");

        $sheet->getStyle("B$signatureRow2")->getFont()->setBold(true);
        $sheet->getStyle("E$signatureRow2:I$signatureRow2")->getFont()->setBold(true);
        $sheet->getStyle("B$signatureRow2")->getAlignment()->setHorizontal('center')->setWrapText(true);
        $sheet->getStyle("E$signatureRow2:I$signatureRow2")->getAlignment()->setHorizontal('center')->setWrapText(true);

        $messageRow = $signatureRow2 + 4;

        $sheet->getHeaderFooter()
            ->setOddFooter('&L&K000000 R00-0824 &R&K000000 F-OE-07');

        $sheet->getStyle("B$messageRow")->getFont()->setItalic(true);
        $sheet->getStyle("J$messageRow")->getFont()->setItalic(true);
        $sheet->getStyle("B$messageRow")->getAlignment()->setHorizontal('left');
        $sheet->getStyle("J$messageRow")->getAlignment()->setHorizontal('right');

        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->getRowDimension(1)->setRowHeight(70);
            },
        ];
    }

    public function drawings()
    {
    $drawing = new Drawing();
    $drawing->setName('Logo');
    $drawing->setDescription('Logo del informe');
    $drawing->setPath(public_path('/tutores/tecnologico.jpg'));
    $drawing->setHeight(69);
    $drawing->setWidth(950); 
    $drawing->setCoordinates('A1');

    return $drawing;
    }
}