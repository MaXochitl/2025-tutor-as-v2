<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use DateTime;

use App\Models\Alumno;
use Illuminate\Http\Request;

use App\Models\Periodo_view;
use App\Models\Periodo;
use App\Models\Periodo_tutorado;
use App\Models\Semaforo;
use App\Models\Asignacion_tutor;
use App\Models\Aviso;
use App\Models\Tutor;

class AtencionController extends Controller
{
    public function createPDF(Request $request, $id)
{
    // Configuración de fecha y hora para México
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_ES.UTF-8');

    // Fecha actual en formato requerido
    $fechaPDF = now()->format('d/m/Y');

    // Obtener el periodo actual
    $periodo_view = Periodo::orderBy('id', 'desc')->first();

    if (!$periodo_view) {
        return redirect()->back()->with('error', 'No se encontró información del periodo actual.');
    }

    $periodo = Periodo::find($periodo_view->id);
    if (!$periodo) {
        return redirect()->back()->with('error', 'No se encontró el periodo asociado.');
    }

    // Convertir fechas de inicio y fin del periodo
    $inicio = strtotime($periodo->inicio);
    $fin = strtotime($periodo->fin);
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    $inicio_p = $meses[date('n', $inicio) - 1] . ' ' . date('Y', $inicio);
    $fin_p = $meses[date('n', $fin) - 1] . ' ' . date('Y', $fin);

    // Obtener información de alumnos asociados al tutor
    $alumnos_tutor = Periodo_tutorado::where('tutor_id', $id)
    ->where('periodo_id', $periodo->id)
    ->where('tipo', 1)
    ->orderby('semaforo_id', 'desc')
    ->get();

    if ($alumnos_tutor->isEmpty()) {
        return redirect()->back()->with('warning', 'No se encontraron alumnos asociados para este tutor.');
    }

    // Agrupar alumnos por semestre y grupo
    $alumnosPorGrupo = $alumnos_tutor->groupBy(function($alumno) {
        return $alumno->semestre . '-' . $alumno->alumno->grupo;
    });

    // Obtener asignaciones del tutor en el periodo
    $asignado = Asignacion_tutor::where('periodo_id', $periodo->id)
        ->where('tutor_id', $id)
        ->get();

    // Validar existencia del tutor
    $tutor = Tutor::find($id);
    if (!$tutor) {
        return redirect()->back()->with('error', 'No se encontró el tutor especificado.');
    }

    // Si solo hay un grupo, generar PDF único
    if ($alumnosPorGrupo->count() === 1) {
        $grupoKey = $alumnosPorGrupo->keys()->first();
        $partes = explode('-', $grupoKey);
        $semestre = $partes[0];
        $grupo = $partes[1];
        
        $data = [
            'fechaPDF' => $fechaPDF,
            'tutor' => $tutor,
            'periodo' => $periodo,
            'alumnos_tutor' => $alumnos_tutor,
            'asignado' => $asignado,
            'inicio_p' => $inicio_p,
            'fin_p' => $fin_p,
            'jefeDepartamento' => $request->input('jefe_departamento'),
            'semestre_actual' => $semestre, // AGREGADO
            'grupo_actual' => $grupo // AGREGADO
        ];

        $pdf = PDF::loadView('admin.tutorias.ActividadesPDF.atencion', $data);
        return $pdf->stream('Reporte.pdf');
    }

    // Si hay múltiples grupos, generar ZIP con múltiples PDFs
    $zip = new \ZipArchive();
    $zipFileName = 'Reportes-' . $tutor->nombre . '_' . date('YmdHis') . '.zip';
    $zipPath = storage_path('app/public/' . $zipFileName);

    if ($zip->open($zipPath, \ZipArchive::CREATE) !== TRUE) {
        return redirect()->back()->with('error', 'No se pudo crear el archivo ZIP.');
    }

    // Generar un PDF por cada grupo
    foreach ($alumnosPorGrupo as $grupoKey => $alumnosGrupo) {
        $partes = explode('-', $grupoKey);
        $semestre = $partes[0];
        $grupo = $partes[1];

        $data = [
            'fechaPDF' => $fechaPDF,
            'tutor' => $tutor,
            'periodo' => $periodo,
            'alumnos_tutor' => $alumnosGrupo, // Solo alumnos de este grupo
            'asignado' => $asignado,
            'inicio_p' => $inicio_p,
            'fin_p' => $fin_p,
            'jefeDepartamento' => $request->input('jefe_departamento'),
            'semestre_actual' => $semestre, 
            'grupo_actual' => $grupo
        ];

        $pdf = PDF::loadView('admin.tutorias.ActividadesPDF.atencion', $data);
        $pdfContent = $pdf->output();
        
        $nombreArchivo = "Reporte-Semestral{$semestre}_Grupo{$grupo}.pdf";
        $zip->addFromString($nombreArchivo, $pdfContent);
    }

    $zip->close();

    // Descargar el ZIP
    return response()->download($zipPath)->deleteFileAfterSend(true);
}

}