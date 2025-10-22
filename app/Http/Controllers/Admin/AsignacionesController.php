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
        //
    }
}
