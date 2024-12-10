<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromArray, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //
    }

    private $data;
    private $headings;

    // Constructor para aceptar datos y encabezados dinámicos
    public function __construct(array $data, array $headings)
    {
        $this->data = $data;
        $this->headings = $headings;
    }

    // Datos a exportar
    public function array(): array
    {
        return $this->data;
    }

    // Cabeceras dinámicas
    public function headings(): array
    {
        return $this->headings;
    }

    // Estilos
    public function styles(Worksheet $sheet)
    {
               // Combinar celdas
               $sheet->mergeCells('A1:I1'); // Combina las celdas A1 hasta F1
               $sheet->mergeCells('A2:I2'); // Combina las celdas A2 hasta F2
               $sheet->mergeCells('A3:B3'); // Combina A3 a C3 para Programa Educativo
               $sheet->mergeCells('C3:G3'); // Combina A3 a C3 para Programa Educativo


               // Centrar texto
               $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal('center');
              // $sheet->getStyle('A2:F2')->getAlignment()->setHorizontal('center');
               //$sheet->getStyle('A3:F3')->getAlignment()->setHorizontal('center');

               // Estilo de texto
               $sheet->getStyle('A1:F1')->getFont()->setBold(true)->setSize(14); // Primera fila: negrita y tamaño 14
               $sheet->getStyle('A2:F2')->getFont()->setBold(true)->setSize(12); // Segunda fila: negrita y tamaño 12
               $sheet->getStyle('A3:F3')->getFont()->setItalic(true); // Tercera fila: cursiva

               return [];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo del Instituto');
        $drawing->setPath(public_path() . '\tutores\encabezado.png'); // Ruta a la imagen
        $drawing->setHeight(90); // Altura de la imagen
        $drawing->setCoordinates('A1'); // Celda donde se colocará
        return $drawing;
    }
}
