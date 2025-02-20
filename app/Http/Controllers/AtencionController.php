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
    // Muestra todas las atenciones
    public function index()
    {
        $atenciones = Atencion::with('alumno')->get();
        return view('atencion.index', compact('atenciones')); // Cambiado a plural

    }

    // Guarda una nueva atención
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'atencion' => 'required|string',
            'canalizado' => 'required|string',
            'area_canalizada' => 'nullable|string',
        ]);

        // Buscar si ya existe un registro con el mismo alumno_id
        // Buscar si ya existe un registro con el mismo alumno_id
        $atencion = Atencion::where('alumno_id', $request->input('alumno_id'))->first();

        if ($atencion) {
            // Si existe, actualizar el registro
            $atencion->update([
                'atencion' => $request->input('atencion'),
                'canalizado' => $request->input('canalizado'),
                'area_canalizada' => $request->input('area_canalizada'),
            ]);

            return redirect()->back()->with('success', 'Atención actualizada correctamente');
        } else {
            // Si no existe, crear un nuevo registro
            Atencion::create([
                'alumno_id' => $request->input('alumno_id'),
                'atencion' => $request->input('atencion'),
                'canalizado' => $request->input('canalizado'),
                'area_canalizada' => $request->input('area_canalizada'),
            ]);

            return redirect()->back()->with('success', 'Atención agregada correctamente');
        }
    }
    /////////////////////


    public function mostrarVista()
    {
        $alumnos_tutor = AlumnoTutor::with('atencion')->get(); // Asegúrate de cargar relaciones.

        return view('docente_tutor.orientacion', compact('alumnos_tutor'));
    }

    public function show($id)
    {
        // Buscar al alumno y cargar las relaciones necesarias
        $alumno = Alumno::with('atencion')->find($id);

        if (!$alumno) {
            return response()->json(['error' => 'No se encontraron datos para el ID proporcionado.'], 404);
        }

        return response()->json([
            'id' => $alumno->id,
            'atencion' => optional($alumno->atencion)->atencion,
            'canalizado' => optional($alumno->atencion)->canalizado,
            'area_canalizada' => optional($alumno->atencion)->area_canalizada,
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


        //return $periodo_view;


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
            ->with(['alumno', 'alumno.atencion']) // Relación con alumno y atenciones
            ->orderby('semaforo_id', 'desc')
            ->get();

        //return $alumnos_tutor[2];
        // Validar si se encontraron alumnos
        if ($alumnos_tutor->isEmpty()) {
            return redirect()->back()->with('warning', 'No se encontraron alumnos asociados para este tutor.');
        }

        // Obtener asignaciones del tutor en el periodo
        $asignado = Asignacion_tutor::where('periodo_id', $periodo->id)
            ->where('tutor_id', $id)
            ->get();

        // Validar existencia del tutor
        $tutor = Tutor::find($id);
        if (!$tutor) {
            return redirect()->back()->with('error', 'No se encontró el tutor especificado.');
        }

        // Datos para la vista del PDF
        $data = [
            'fechaPDF' => $fechaPDF,
            'tutor' => $tutor,
            'periodo' => $periodo,
            'alumnos_tutor' => $alumnos_tutor,
            'asignado' => $asignado,
            'inicio_p' => $inicio_p,
            'fin_p' => $fin_p,
            'jefeDepartamento' => $request->input('jefe_departamento'), // Obtener jefe de departamento si aplica
        ];

        // Generar el PDF
        $pdf = PDF::loadView('admin.tutorias.ActividadesPDF.atencion', $data);

        return $pdf->stream('Reporte.pdf');
    }


    public function getAtencion($id)
    {
        $atencion = Atencion::where('alumno_id', $id)->latest()->first(); // Última atención registrada

        if (!$atencion) {
            return response()->json([
                'alumno_id' => $id,
                'atencion' => '',
                'canalizado' => '',
                'area_canalizada' => ''
            ]);
        }

        return response()->json($atencion);
    }
}
