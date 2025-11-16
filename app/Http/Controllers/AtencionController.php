<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use DateTime;

use App\Models\Atencion;
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
    // Muestra todas las atenciones filtradas por el periodo actual
    public function index()
    {
    // Obtener el periodo actual
    $periodo_actual = Periodo::orderBy('id', 'desc')->first();
    
    if (!$periodo_actual) {
        return view('atencion.index', ['atenciones' => collect([]), 'periodo' => null]);
    }
    
    // Filtrar atenciones por el periodo actual
    $atenciones = Atencion::with('alumno')
        ->where('periodo_id', $periodo_actual->id)
        ->get();
    
    return view('atencion.index', compact('atenciones', 'periodo_actual'));
    }

    // Guarda una nueva atención
    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'alumno_id' => 'required|exists:alumnos,id',
        'periodo_id' => 'required|exists:periodos,id',
        'atencion' => 'required|string',
        'canalizado' => 'required|string',
        'area_canalizada' => 'nullable|string',
    ]);

    // ✅ USAR updateOrCreate: Si existe lo actualiza, si no existe lo crea
    $atencion = Atencion::updateOrCreate(
        [
            // Condiciones para buscar el registro (clave única compuesta)
            'alumno_id' => $request->input('alumno_id'),
            'periodo_id' => $request->input('periodo_id')
        ],
        [
            // Datos a actualizar o crear
            'atencion' => $request->input('atencion'),
            'canalizado' => $request->input('canalizado'),
            'area_canalizada' => $request->input('area_canalizada'),
        ]
    );

    // Verificar si fue creado o actualizado
    if ($atencion->wasRecentlyCreated) {
        return redirect()->back()->with('success', 'Atención agregada correctamente');
    } else {
        return redirect()->back()->with('success', 'Atención actualizada correctamente');
    }
}
    /////////////////////


    public function mostrarVista()
    {
        $alumnos_tutor = AlumnoTutor::with('atencion')->get(); // Asegúrate de cargar relaciones.

        return view('docente_tutor.orientacion', compact('alumnos_tutor'));
    }

    public function show($id, Request $request)
    {
    // Obtener el periodo_id desde la petición
    $periodoId = $request->query('periodo_id');

    if (!$periodoId) {
        return response()->json(['error' => 'No se proporcionó el periodo_id'], 400);
    }

    // Buscar al alumno
    $alumno = Alumno::find($id);

    if (!$alumno) {
        return response()->json(['error' => 'No se encontraron datos para el ID proporcionado.'], 404);
    }

    // Buscar la atención del alumno en el periodo específico
    $atencion = Atencion::where('alumno_id', $id)
        ->where('periodo_id', $periodoId)
        ->first();

    return response()->json([
        'exists' => $atencion !== null,
        'id' => $alumno->id,
        'atencion' => optional($atencion)->atencion,
        'canalizado' => optional($atencion)->canalizado,
        'area_canalizada' => optional($atencion)->area_canalizada,
    ]);
}

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
    ->with(['alumno', 'alumno.atencion' => function($query) use ($periodo) {
        $query->where('periodo_id', $periodo->id);
    }])
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
            'semestre_actual' => $semestre, // AGREGADO
            'grupo_actual' => $grupo // AGREGADO
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

    public function destroy($id, Request $request)
    {
    try {
        // Obtener el periodo_id desde la petición
        $periodoId = $request->query('periodo_id');
        
        if (!$periodoId) {
            $periodo_actual = Periodo::orderBy('id', 'desc')->first();
            $periodoId = $periodo_actual ? $periodo_actual->id : null;
        }
        
        if (!$periodoId) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró un periodo válido'
            ], 400);
        }
        
        // Eliminar la atención por alumno_id y periodo_id
        $atencion = Atencion::where('alumno_id', $id)
            ->where('periodo_id', $periodoId)
            ->first();
        
        if (!$atencion) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró la atención para este periodo'
            ], 404);
        }
        
        $atencion->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Atención eliminada correctamente'
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al eliminar la atención: ' . $e->getMessage()
        ], 500);
    }
    }

    public function getAtencion($id, Request $request)
    {
    // Obtener el periodo_id desde la petición o usar el periodo actual
    $periodoId = $request->query('periodo_id');
    
    if (!$periodoId) {
        $periodo_actual = Periodo::orderBy('id', 'desc')->first();
        $periodoId = $periodo_actual ? $periodo_actual->id : null;
    }
    
    if (!$periodoId) {
        return response()->json([
            'error' => 'No se encontró un periodo válido'
        ], 400);
    }
    
    // Buscar la atención del alumno en el periodo específico
    $atencion = Atencion::where('alumno_id', $id)
        ->where('periodo_id', $periodoId)
        ->latest()
        ->first();

    if (!$atencion) {
        return response()->json([
            'alumno_id' => $id,
            'periodo_id' => $periodoId,
            'atencion' => '',
            'canalizado' => '',
            'area_canalizada' => ''
        ]);
    }

    return response()->json($atencion);
    }
}
