<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asignacion_tutor;
use App\Models\Periodo;
use App\Models\Tutor;
use Illuminate\Http\Request;

class AsignacionesController extends Controller
{
    public function index()
    {
        $periodos = Periodo::OrderBy('id', 'desc')->get();
        $periodo = Periodo::max('id');
        $asignaciones = Tutor::where('carrera_id', '>', '0')->orderBy('carrera_id', 'desc')->get();

        $this->validar($periodo);

        $asig = Asignacion_tutor::join('tutores', 'tutores.id', 'asignacion_tutor.tutor_id')
            ->orderBy('tutores.carrera_id', 'asc')
            ->where('periodo_id', $periodo)
            ->count();

        // Datos para las vistas
        $semestres = range(1, 17);
        $grupos = range('A', 'N');
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        if ($periodos == null) {
            return view('admin.tutorias.asignaciones_tutor', compact('asignaciones', 'periodos', 'periodo', 'meses'));
        }
        return view('admin.tutorias.asignaciones_tutor', compact('asignaciones', 'periodos', 'periodo', 'asig', 'semestres', 'grupos', 'meses'));
    }

    public function create()
    {
        $periodos = Periodo::OrderBy('id', 'desc')->get();
        $periodo = $periodos[0]->id;

        $as = Asignacion_tutor::join('tutores', 'tutores.id', 'asignacion_tutor.tutor_id')
            ->orderBy('tutores.carrera_id', 'asc')
            ->where('periodo_id', $periodo)
            ->get();

        if ($as->count() == 0) {
            $tutores = Tutor::all()->where('carrera_id', '>', '0');
            foreach ($tutores as $value) {
                Asignacion_tutor::create([
                    'tutor_id' => $value->id,
                    'periodo_id' => $periodo,
                    'semestre' => 1,
                    'grupo' => 'A'
                ]);
            }
        }

        return redirect()->route('asignaciones.index');
    }

    public function store(Request $request)
    {
        $periodos = Periodo::OrderBy('id', 'desc')->get();
        $periodo = $request->periodo;
        $asignaciones = Tutor::where('carrera_id', '>', '0')->orderBy('carrera_id', 'desc')->get();

        $asig = Asignacion_tutor::join('tutores', 'tutores.id', 'asignacion_tutor.tutor_id')
            ->orderBy('tutores.carrera_id', 'asc')
            ->where('periodo_id', $periodo)
            ->count();

        $semestres = range(1, 17);
        $grupos = range('A', 'N');
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        if ($periodos == null) {
            return view('admin.tutorias.asignaciones_tutor', compact('asignaciones', 'periodos', 'periodo', 'meses'));
        }
        return view('admin.tutorias.asignaciones_tutor', compact('asignaciones', 'periodos', 'periodo', 'asig', 'semestres', 'grupos', 'meses'));
    }

    public function validar($periodo)
    {
        $tutores = Tutor::where('carrera_id', '>', 0)->get();
        if (count($tutores) != 0) {
            foreach ($tutores as $value) {
                $asignacion = Asignacion_tutor::where('tutor_id', $value->id)
                    ->where('periodo_id', $periodo)
                    ->count();
                if ($asignacion == 0) {
                    Asignacion_tutor::create([
                        'tutor_id' => $value->id,
                        'periodo_id' => $periodo,
                        'semestre' => 0,
                        'grupo' => 'sin asignar'
                    ]);
                }
            }
        }
    }

    public function destroy($id)
    {
        if (request()->ajax()) {
            try {
                $asignacion = Asignacion_tutor::find($id);
                
                if (!$asignacion) {
                    return response()->json([
                        'success' => false,
                        'message' => 'No se encontró la asignación seleccionada.'
                    ], 404);
                }

                $tutor_id = $asignacion->tutor_id;
                $periodo_id = $asignacion->periodo_id;
                
                $asignacion->delete();

                // Verificar si quedan asignaciones para este tutor
                $asignacionesRestantes = Asignacion_tutor::where('tutor_id', $tutor_id)
                    ->where('periodo_id', $periodo_id)
                    ->where(function($query) {
                        $query->where('semestre', '!=', 0)
                              ->orWhere('grupo', '!=', 'sin asignar');
                    })
                    ->get();

                // Si no quedan asignaciones, crear el registro "sin asignar"
                if ($asignacionesRestantes->isEmpty()) {
                    Asignacion_tutor::create([
                        'tutor_id' => $tutor_id,
                        'periodo_id' => $periodo_id,
                        'semestre' => 0,
                        'grupo' => 'sin asignar'
                    ]);
                }

                // Obtener HTML actualizado de las asignaciones
                $htmlAsignaciones = $this->generarHtmlAsignaciones($tutor_id, $periodo_id);

                return response()->json([
                    'success' => true,
                    'message' => 'El grupo fue eliminado correctamente.',
                    'html' => $htmlAsignaciones
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudo eliminar el grupo. Intenta nuevamente.'
                ], 500);
            }
        }

        /* Fallback para peticiones no AJAX (eliminar este codigo al terminar las pruebas de tests con AJAX)
        $asignacion = Asignacion_tutor::find($id);
        
        if (!$asignacion) {
            return redirect()->back()->with('error', 'No se encontró la asignación seleccionada.');
        }

        try {
            $asignacion->delete();
            return redirect()->back()->with('success', 'El grupo fue eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo eliminar el grupo. Intenta nuevamente.');
        }
        */
    }

    public function agregarGrupo(Request $request)
    {
        if ($request->ajax()) {
            try {
                $tutor_id = $request->tutor_id;
                $periodo_id = $request->periodo_id;
                $semestre = $request->semestre;
                $grupo = $request->grupo;

                // validar campos requeridos
                $request->validate([
                    'tutor_id' => 'required|exists:tutores,id',
                    'periodo_id' => 'required|exists:periodos,id',
                    'semestre' => 'required',
                    'grupo' => 'required'
                ]);

                // verificar duplicados en la misma carrera
                $tutor = Tutor::find($tutor_id);
                $carrera_id = $tutor->carrera_id;
                $tutoresMismaCarrera = Tutor::where('carrera_id', $carrera_id)->pluck('id');

                $existe = Asignacion_tutor::whereIn('tutor_id', $tutoresMismaCarrera)
                    ->where('periodo_id', $periodo_id)
                    ->where('semestre', $semestre)
                    ->where('grupo', $grupo)
                    ->with('tutor')
                    ->first();

                if ($existe) {
                    $nombreTutor = $existe->tutor
                        ? $existe->tutor->nombre . ' ' . $existe->tutor->ap_paterno . ' ' . $existe->tutor->ap_materno
                        : 'Desconocido';

                    return response()->json([
                        'success' => false,
                        'message' => "$semestre$grupo ya está asignado al tutor $nombreTutor dentro de la misma carrera."
                    ], 422);
                }

                // buscar registro "sin asignar"
                $sinAsignar = Asignacion_tutor::where('tutor_id', $tutor_id)
                    ->where('periodo_id', $periodo_id)
                    ->where('semestre', 0)
                    ->where('grupo', 'sin asignar')
                    ->first();

                if ($sinAsignar) {
                    $sinAsignar->update([
                        'semestre' => $semestre,
                        'grupo' => $grupo,
                    ]);
                } else {
                    Asignacion_tutor::create([
                        'tutor_id' => $tutor_id,
                        'periodo_id' => $periodo_id,
                        'semestre' => $semestre,
                        'grupo' => $grupo
                    ]);
                }

                $nombreTutor = $tutor->nombre . ' ' . $tutor->ap_paterno;
                
                // generar HTML actualizado
                $htmlAsignaciones = $this->generarHtmlAsignaciones($tutor_id, $periodo_id);

                return response()->json([
                    'success' => true,
                    'message' => "$semestre$grupo asignado a $nombreTutor.",
                    'html' => $htmlAsignaciones
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al agregar el grupo: ' . $e->getMessage()
                ], 500);
            }
        }

        // Fallback para peticiones no AJAX (eliminar el codigo al terminar las pruebas de tests con AJAX)
        /*
        $tutor_id = $request->tutor_id;
        $periodo_id = $request->periodo_id;
        $semestre = $request->semestre;
        $grupo = $request->grupo;

        $tutor = Tutor::find($tutor_id);
        $carrera_id = $tutor->carrera_id;
        $tutoresMismaCarrera = Tutor::where('carrera_id', $carrera_id)->pluck('id');

        $existe = Asignacion_tutor::whereIn('tutor_id', $tutoresMismaCarrera)
            ->where('periodo_id', $periodo_id)
            ->where('semestre', $semestre)
            ->where('grupo', $grupo)
            ->with('tutor')
            ->first();

        if ($existe) {
            $nombreTutor = $existe->tutor
                ? $existe->tutor->nombre . ' ' . $existe->tutor->ap_paterno . ' ' . $existe->tutor->ap_materno
                : 'Desconocido';

            return redirect()->back()->with(
                'error',
                "$semestre$grupo ya está asignado al tutor $nombreTutor dentro de la misma carrera."
            );
        }

        $sinAsignar = Asignacion_tutor::where('tutor_id', $tutor_id)
            ->where('periodo_id', $periodo_id)
            ->where('semestre', 0)
            ->where('grupo', 'sin asignar')
            ->first();

        if ($sinAsignar) {
            $sinAsignar->update([
                'semestre' => $semestre,
                'grupo' => $grupo,
            ]);
        } else {
            Asignacion_tutor::create([
                'tutor_id' => $tutor_id,
                'periodo_id' => $periodo_id,
                'semestre' => $semestre,
                'grupo' => $grupo
            ]);
        }

        $nombreTutor = $tutor->nombre . ' ' . $tutor->ap_paterno;

        return redirect()->route('asignaciones.index')
            ->with('success', "$semestre$grupo asignado a $nombreTutor.");
        */
    }

    /**
     * Genera el HTML de las asignaciones para un tutor especifico
     */
    private function generarHtmlAsignaciones($tutor_id, $periodo_id)
    {
        $asigPeriodo = Asignacion_tutor::where('tutor_id', $tutor_id)
            ->where('periodo_id', $periodo_id)
            ->get();

        if ($asigPeriodo->isEmpty()) {
            return '<span class="text-muted">Sin asignaciones</span>';
        }

        $soloSinAsignar = $asigPeriodo->count() === 1 &&
                         $asigPeriodo->first()->semestre == 0 &&
                         strtolower(trim($asigPeriodo->first()->grupo)) == 'sin asignar';

        if ($soloSinAsignar) {
            return '<span class="text-muted fst-italic">Sin asignación actual.</span>';
        }

        $html = '';
        foreach ($asigPeriodo as $a) {
            if ($a->semestre != 0 && strtolower(trim($a->grupo)) != 'sin asignar') {
                $html .= '<div class="d-flex justify-content-between align-items-center mb-1 border rounded p-1">';
                $html .= '<span>';
                $html .= '<span class="badge bg-primary">' . $a->semestre . '</span> ';
                $html .= '<span class="badge bg-secondary">' . $a->grupo . '</span>';
                $html .= '</span>';
                $html .= '<button type="button" class="btn btn-sm btn-danger btn-eliminar-grupo" data-id="' . $a->id . '">';
                $html .= '<i class="bi bi-x-lg"></i>';
                $html .= '</button>';
                $html .= '</div>';
            }
        }

        return $html ?: '<span class="text-muted fst-italic">Sin asignación actual.</span>';
    }
}