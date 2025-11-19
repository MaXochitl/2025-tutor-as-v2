<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Periodo_view;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ReporteSemCarrerasExport;
use Maatwebsite\Excel\Facades\Excel;

class ReporteSemCarrerasController extends Controller
{
    public function importInformeSC()
    {
        // Obtener el periodo activo
        $periodoView = Periodo_view::first();
        
        if (!$periodoView) {
            return back()->with('error', 'No hay periodo configurado en la vista');
        }
        
        $periodo_id = $periodoView->periodo_id;

        // Obtener todas las carreras
        $carreras = Carrera::all();
        
        $data = [];
        $totalTutores = 0;
        $totalTutoriaGrupal = 0;
        $totalTutoriaIndividual = 0;
        $totalEstudiantesCanalizados = 0;

        foreach ($carreras as $carrera) {
            // Ejecutar el stored procedure para obtener datos por carrera
            $resultados = DB::select('CALL ReporteGeneral(?, ?)', [$periodo_id, $carrera->id]);
            
            if (!empty($resultados)) {
                $resultado = $resultados[0];
                
                $cantidadTutores = $resultado->cantidad_tutores ?? 0;
                $tutoriaGrupal = $resultado->tutoria_grupal ?? 0;
                $tutoriaIndividual = $resultado->tutoria_individual ?? 0;
                $estudiantesCanalizados = $resultado->estudiantes_canalizados ?? 0;
                $areasCanalizadas = $resultado->areas_canalizadas ?? 'Ninguna';
                
                // Matrícula por carrera
                $matriculaCarrera = $tutoriaGrupal + $cantidadTutores;
                
                // Acumular totales
                $totalTutores += $cantidadTutores;
                $totalTutoriaGrupal += $tutoriaGrupal;
                $totalTutoriaIndividual += $tutoriaIndividual;
                $totalEstudiantesCanalizados += $estudiantesCanalizados;
                
                $data[] = [
                    $carrera->id,                    // Columna A - ID
                    $carrera->nombre_carrera,        // Columna B - Nombre (merged con A)
                    $cantidadTutores,                // Columna C - Cantidad tutores
                    $tutoriaGrupal,                  // Columna D - Tutoría grupal
                    $tutoriaIndividual,              // Columna E - Tutoría individual
                    $estudiantesCanalizados,         // Columna F - Estudiantes canalizados (merged F-G)
                    '',                              // Columna G - (vacía, parte del merge F-G)
                    $areasCanalizadas,               // Columna H - Áreas canalizadas (merged H-I)
                    '',                              // Columna I - (vacía, parte del merge H-I)
                    $matriculaCarrera,               // Columna J - Matrícula (grupal + tutores)
                ];
            }
        }

        // La matrícula total es tutoría grupal + cantidad de tutores
        $totalMatricula = $totalTutoriaGrupal + $totalTutores;

        // Generar excel del reporte semestral
        return Excel::download(
            new ReporteSemCarrerasExport(
                $data, 
                $totalMatricula, 
                $totalTutores, 
                $totalTutoriaGrupal,
                $totalTutoriaIndividual,
                $totalEstudiantesCanalizados
            ), 
            'Reporte_Semestral_Carreras_' . date('Y-m-d') . '.xlsx'
        );
    }
}