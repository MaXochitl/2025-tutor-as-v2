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

        // Agregar una imagen al encabezado
        //$sheet->getHeaderFooter()->setOddHeader('&C&HEncabezado con imagen');

        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath(public_path('/tutores/tecnologico.jpg')); // Ruta a tu imagen
        $drawing->setHeight(50); // Altura de la imagen
        $drawing->setCoordinates('A2'); // Celda donde se coloca
        $drawing->setWorksheet($sheet);
        //Ajuste del pie de pagina
        $sheet->getHeaderFooter()
            ->setOddFooter('&L&K000000 R00/0824 &R&K000000 F-OE-06');


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
        $sheet->getStyle('A5:G5')->getFont()->setBold(true)->setSize(14); // Primera fila: negrita y tamaño 14
        $sheet->getStyle('A3:F3')->getFont()->setItalic(true); // Tercera fila: cursiva
        $sheet->getStyle('A9:I9')->getFont()->setBold(true);


        // Agregar nombres en la misma fila (esquinas opuestas)
        $lastRow = count($this->data) + 8; // Calcular la última fila de datos (ajustar según cabeceras)

        $sheet->setCellValue('A' . ($lastRow + 1), 'Lic. Emma Valeria Ramírez Guzmán'); // Esquina izquierda
        $sheet->setCellValue('I' . ($lastRow + 1), 'MC. Sonia Cruz Rivero'); // Esquina derecha

        $sheet->setCellValue('A' . ($lastRow + 2), 'Encargada de la oficina de Orientacion'); // Esquina izquierda
        $sheet->setCellValue('I' . ($lastRow + 2), 'Jefa del Dpto. Desarrollo Académico'); // Esquina derecha


        // Aplicar estilos a los nombres
        $sheet->getStyle('A' . ($lastRow + 2))
            ->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('I' . ($lastRow + 2))
            ->getFont()->setBold(true)->setSize(12);

        // Aplicar estilos a los cargos
        $sheet->getStyle('A' . ($lastRow + 1))
            ->getFont()->setItalic(false)->setSize(10);
        $sheet->getStyle('I' . ($lastRow + 1))
            ->getFont()->setItalic(false)->setSize(10);

        // Alinear texto
        $sheet->getStyle('A' . ($lastRow + 1))->getAlignment()->setHorizontal('left');
        $sheet->getStyle('I' . ($lastRow + 1))->getAlignment()->setHorizontal('right');
        $sheet->getStyle('A' . ($lastRow + 2))->getAlignment()->setHorizontal('left');
        $sheet->getStyle('I' . ($lastRow + 2))->getAlignment()->setHorizontal('right');

        return [];
    }



    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo del Instituto');

        // Usar barra normal '/' o DIRECTORY_SEPARATOR para que funcione correctamente
        $drawing->setPath(public_path() . '/tutores/encabezado.png'); // Ruta a la imagen con barra normal

        // Alternativamente, usando DIRECTORY_SEPARATOR
        // $drawing->setPath(public_path() . DIRECTORY_SEPARATOR . 'tutores' . DIRECTORY_SEPARATOR . 'encabezado.png');

        $drawing->setHeight(90); // Altura de la imagen
        $drawing->setCoordinates('A1'); // Celda donde se colocará
        return $drawing;
    }
}
