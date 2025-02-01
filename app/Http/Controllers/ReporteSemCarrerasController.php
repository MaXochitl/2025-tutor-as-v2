<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Alumno;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\PHPExcel_Style_Alignment;
use Illuminate\Support\Facades\DB;
use App\Exports\ReporteSemCarrerasExport;
use Maatwebsite\Excel\Facades\Excel;

class ReporteSemCarrerasController extends Controller
{
    public function importInformeSC()
    {
        // Datos a exportar
        $data = [];
        $totalMatricula = 0; // Variable para acumular el total de matrícula

        // Obtén los datos de la base de datos y calcula la matrícula
        $datos = Carrera::withCount(['tutores', 'alumnos'])->get();

        foreach ($datos as $dato) {
            $matricula = $dato->tutores_count + $dato->alumnos_count; // Calcula matrícula
            $totalMatricula += $matricula;

            // Agrega los datos con la matrícula calculada
            $data[] = [
                $dato->id,
                $dato->nombre_carrera,
                $dato->tutores_count,
                $dato->alumnos_count,
                '',
                '',
                '',
                '',
                '', // Celdas vacías
                $matricula, // Coloca la matrícula en la columna J
            ];
        }

        // Calcula los totales de tutores, alumnos y matrícula
        $totalTutores = $datos->sum('tutores_count');
        $totalAlumnos = $datos->sum('alumnos_count');

        // Generar excel del reporte semestral
        return Excel::download(new ReporteSemCarrerasExport($data, $totalMatricula, 
        $totalTutores, $totalAlumnos), 'Reporte_Semestral.xlsx');
    }

}
