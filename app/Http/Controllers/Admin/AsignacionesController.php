<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asignacion_tutor;
use App\Models\Periodo;
use App\Models\Tutor;
use Illuminate\Http\Request;

class AsignacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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


        if ($periodos == null) {
            return view('admin.tutorias.asignaciones_tutor', compact('asignaciones', 'periodos', 'periodo'));
        }
        return view('admin.tutorias.asignaciones_tutor', compact('asignaciones', 'periodos', 'periodo', 'asig'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periodos = Periodo::OrderBy('id', 'desc')->get();
        $periodo = $periodos[0]->id;

        $as = Asignacion_tutor::join('tutores', 'tutores.id', 'asignacion_tutor.tutor_id')
            ->orderBy('tutores.carrera_id', 'asc')
            ->where('periodo_id', $periodo)
            ->get();

        $asignaciones = Tutor::where('carrera_id', '>', '0')->get();

        if ($as->count() == 0) {
            $tutores = Tutor::all()->where('carrera_id', '>', '0');
            foreach ($tutores as  $value) {
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $periodos = Periodo::OrderBy('id', 'desc')->get();

        $periodo = $request->periodo;

        $asignaciones = Tutor::where('carrera_id', '>', '0')->orderBy('carrera_id', 'desc')->get();

        $asig = Asignacion_tutor::join('tutores', 'tutores.id', 'asignacion_tutor.tutor_id')
            ->orderBy('tutores.carrera_id', 'asc')
            ->where('periodo_id', $periodo)
            ->count();

        //return $asignaciones;
        if ($periodos == null) {

            return view('admin.tutorias.asignaciones_tutor', compact('asignaciones', 'periodos', 'periodo'));
        }
        return view('admin.tutorias.asignaciones_tutor', compact('asignaciones', 'periodos', 'periodo', 'asig'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $asignacion = Asignacion_tutor::find($id);
        $asignacion->semestre = $request->semestre;
        $asignacion->grupo = $request->grupo;
        $asignacion->save();


        return redirect()->route('asignaciones.index');
    }

    public function validar($periodo)
    {
        $tutores = Tutor::where('carrera_id', '>', 0)->get();
        if (count($tutores) != 0) {
            foreach ($tutores as  $value) {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asignacion = Asignacion_tutor::find($id); // buscar la asignacion por ID
        
        if (!$asignacion) {// Validar si existe
            return redirect()->back()->with('error', 'No se encontró la asignación seleccionada.');
        }

        try {
            $asignacion->delete();// Eliminar el registro

            return redirect()->back()->with('success', 'El grupo fue eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo eliminar el grupo. Intenta nuevamente.');
        }
    }

    public function agregarGrupo(Request $request)
    {

        $tutor_id = $request->tutor_id;
        $periodo_id = $request->periodo_id;
        $semestre = $request->semestre;
        $grupo = $request->grupo;

        // (1) VERIFICAR SI EL GRUPO Y SEMESTRE YA ESTÁN ASIGNADOS
        // Comprobar si ya existe una asignación para el mismo periodo, semestre y grupo
        // Si existe, no se permite crear otra y se muestra un error indicando que tutor ya tiene ese grupo
        $existe = Asignacion_tutor::where('periodo_id', $periodo_id)
            ->where('semestre', $semestre)
            ->where('grupo', $grupo)
            ->with('tutor') 
            ->first();

        if ($existe) { // obtener el nombre del tutor asignado (si existe la relación)
            $nombreTutor = $existe->tutor
                ? $existe->tutor->nombre . ' ' . $existe->tutor->ap_paterno . ' ' . $existe->tutor->ap_materno
                : 'Desconocido';

            return redirect()->back()->with('error', "El semestre $semestre grupo $grupo ya está asignado al tutor $nombreTutor.");
        }

        // (2) ACTUALIZAR UN REGISTRO 'SIN ASIGNAR'
        // Buscar si existe un registro para este tutor y periodo con semestre = 0 y grupo = 'sin asignar'
        // Si existe, se actualiza ese registro en lugar de crear uno nuevo
        $sinAsignar = Asignacion_tutor::where('tutor_id', $tutor_id)
            ->where('periodo_id', $periodo_id)
            ->where('semestre', 0)
            ->where('grupo', 'sin asignar')
            ->first();

        if ($sinAsignar) { // si existe, actualizrlo en lugar de crear uno nuevo
            $sinAsignar->update([
                'semestre' => $semestre,
                'grupo' => $grupo,
            ]);

            $tutor = $sinAsignar->tutor;
            $nombreTutor = $tutor
                ? $tutor->nombre . ' ' . $tutor->ap_paterno
                : 'Desconocido';

            return redirect()
                ->route('asignaciones.index')
                ->with('success', "$semestre$grupo asignado a $nombreTutor");//para pruebas: ->with('success', "$semestre$grupo asignado a $nombreTutor (registro actualizado).");
        }

        // (3) CREAR NUEVA ASIGNACION
        // Si no existe un registro duplicado ni un registro "sin asignar" para actualizar, se crea una nueva asignacion
        $asignacion = Asignacion_tutor::create([
            'tutor_id' => $tutor_id,
            'periodo_id' => $periodo_id,
            'semestre' => $semestre,
            'grupo' => $grupo
        ]);

        $tutor = $asignacion->tutor;
        $nombreTutor = $tutor
            ? $tutor->nombre . ' ' . $tutor->ap_paterno
            : 'Desconocido';

        return redirect()
            ->route('asignaciones.index')
            ->with('success', "$semestre$grupo asignado a $nombreTutor.");
    }
    
}
