<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
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
        return [
            1 => ['font' => ['bold' => true, 'size' => 14]], // Título principal
            2 => ['font' => ['bold' => true, 'size' => 14]], // Subtítulo
            3 => ['font' => ['bold' => true]],               // Encabezados de tabla
        ];
    }
}
