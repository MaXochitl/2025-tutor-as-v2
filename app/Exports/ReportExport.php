<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromArray, WithHeadings, WithStyles
{
    public function collection()
    {
        //
    }

    private $data;
    private $headings;

    public function __construct(array $data, array $headings)
    {
        $this->data = $data;
        $this->headings = $headings;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function styles(Worksheet $sheet)
    {
        // LOGO
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath(public_path('/tutores/tecnologico.jpg'));
        $drawing->setHeight(50);
        $drawing->setWidth(900);
        $drawing->setCoordinates('A1');
        $drawing->setWorksheet($sheet);

        // Pie de pagina
        $sheet->getHeaderFooter()
            ->setOddFooter("\n\n&L&K000000 R00/0824 &R&K000000 F-OE-06");

        $sheet->mergeCells('A1:I1');
        $sheet->mergeCells('A2:I2');
        $sheet->mergeCells('A3:B3');
        $sheet->mergeCells('C3:G3');

        $sheet->mergeCells('A7:H7');
        $sheet->mergeCells('C8:H8');
        $sheet->mergeCells('A8:B8');
        $sheet->mergeCells('J8:K8');
        $sheet->mergeCells('A9:B10');
        $sheet->getStyle('A9:B10')->getAlignment()->setVertical('center');
        $sheet->getStyle('A9:B10')->getAlignment()->setHorizontal('center');

        $sheet->mergeCells('C9:C10');  // Semestre y grupo
        $sheet->getStyle('C9:C10')->getAlignment()->setVertical('center');
        $sheet->getStyle('C9:C10')->getAlignment()->setHorizontal('center');

        $sheet->mergeCells('D9:E9');   // Estudiantes inscritos
        $sheet->getStyle('D9:E9')->getAlignment()->setVertical('center');
        $sheet->getStyle('D9:E9')->getAlignment()->setHorizontal('center');

        $sheet->mergeCells('F9:H10');  // Actividades realizadas
        $sheet->getStyle('F9:H10')->getAlignment()->setVertical('center');
        $sheet->getStyle('F9:H10')->getAlignment()->setHorizontal('center');
        
        $sheet->mergeCells('I9:K10');  // Área canalizada
        $sheet->getStyle('I9:K10')->getAlignment()->setVertical('center');
        $sheet->getStyle('I9:K10')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('A9:F10')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A9:F10')->getFont()->setBold(true);

        $sheet->getRowDimension(9)->setRowHeight(30);
        $sheet->getRowDimension(10)->setRowHeight(30);

        $sheet->getStyle('A9:K9')->applyFromArray([
            'font' => ['bold' => true]
        ]);

        $sheet->getStyle('A10:K10')->applyFromArray([
            'font' => ['bold' => true]
        ]);

        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(30);

        // FILA 6
        $sheet->mergeCells('A6:K6');
        $sheet->getStyle('A6:H6')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical'   => 'center',
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '1B396A'],
            ],
        ]);

        $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:F1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A2:F2')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A5:H5')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A3:F3')->getFont()->setItalic(true);

        $dataStartRow = 11;
        $dataEndRow = 10 + count($this->data);

        for ($i = $dataStartRow; $i <= $dataEndRow; $i++) {
            $sheet->mergeCells("F{$i}:H{$i}");
            $sheet->mergeCells("I{$i}:K{$i}");
        }

        $sheet->getStyle("A{$dataStartRow}:K{$dataEndRow}")
            ->getAlignment()->setHorizontal('center');
        $sheet->getStyle("A{$dataStartRow}:K{$dataEndRow}")
            ->getAlignment()->setVertical('center');

        $resultadosRow = $dataEndRow + 1;

        $sheet->mergeCells("F{$resultadosRow}:H{$resultadosRow}");
        $sheet->mergeCells("I{$resultadosRow}:K{$resultadosRow}");
        $sheet->mergeCells("A{$resultadosRow}:B{$resultadosRow}");

        $sheet->setCellValue("A{$resultadosRow}", 'Resultados:');

        $sheet->getStyle("A{$resultadosRow}:K{$resultadosRow}")->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical'   => 'center',
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '1B396A'],
            ],
        ]);
        
        $sheet->setCellValue("D{$resultadosRow}", "=SUM(D{$dataStartRow}:D{$dataEndRow})");
        $sheet->setCellValue("E{$resultadosRow}", "=SUM(E{$dataStartRow}:E{$dataEndRow})");
        $sheet->setCellValue("F{$resultadosRow}", "=SUM(F{$dataStartRow}:H{$dataEndRow})");

        // Firmas
        $lastRow = count($this->data) + 25;

        $sheet->setCellValue('A' . ($lastRow + 1), 'Lic. Emma Valeria Ramírez Guzmán');
        $sheet->setCellValue('K' . ($lastRow + 1), 'MC. Sonia Cruz Rivero');

        $sheet->setCellValue('A' . ($lastRow + 2), 'Encargada de la oficina de Orientacion');
        $sheet->setCellValue('K' . ($lastRow + 2), 'Jefa del Dpto. Desarrollo Académico');

        $sheet->getStyle('A' . ($lastRow + 2))->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('K' . ($lastRow + 2))->getFont()->setBold(true)->setSize(12);

        $sheet->getStyle('A' . ($lastRow + 1))->getFont()->setItalic(false)->setSize(10);
        $sheet->getStyle('K' . ($lastRow + 1))->getFont()->setItalic(false)->setSize(10);

        $sheet->getStyle('A' . ($lastRow + 1))->getAlignment()->setHorizontal('left');
        $sheet->getStyle('K' . ($lastRow + 1))->getAlignment()->setHorizontal('right');
        $sheet->getStyle('A' . ($lastRow + 2))->getAlignment()->setHorizontal('left');
        $sheet->getStyle('K' . ($lastRow + 2))->getAlignment()->setHorizontal('right');

        $fullStartRow = 6;
        $fullEndRow = $resultadosRow;

        $sheet->getStyle("A{$fullStartRow}:K{$fullEndRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['rgb' => '000000']
                ]
            ]
        ]);
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo del Instituto');
        $drawing->setPath(public_path() . '/tutores/encabezado.png');
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');
        return $drawing;
    }
}
