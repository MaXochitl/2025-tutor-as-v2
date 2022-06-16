<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\Evaluacion_respuesta;
use App\Models\Periodo;
use App\Models\Periodo_eval;
use App\Models\Resultado;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.evaluacion.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $periodo = 0;

        $periodo_evaluacion = Periodo_eval::orderby('id', 'desc')->get();

        $periodo = Periodo_eval::max('id');
        if ($periodo == null) {
            return redirect()->route('periodo-eval.index');
        }

        $resultados = Resultado::where('periodo_eval_id', $periodo)
            ->join('alumnos', 'alumnos.id', '=', 'resultados.alumno_id')
            ->orderBy('alumnos.carrera_id')
            ->get();

        $carreras = Carrera::all();
        $carrera_select = $carreras[0]->id;
        return view('admin.evaluacion.resultados.resultados', compact('resultados', 'periodo_evaluacion', 'carreras', 'carrera_select', 'periodo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $periodo_evaluacion = Periodo_eval::orderby('id', 'desc')->get();

        $resultados = Resultado::where('periodo_eval_id', $request->periodo)
            ->join('alumnos', 'alumnos.id', '=', 'resultados.alumno_id')
            ->orderBy('alumnos.carrera_id')
            ->where('alumnos.carrera_id', $request->carrera)
            ->get();

        $carreras = Carrera::all();
        $periodo = $request->periodo;
        $carrera_select = $request->carrera;

        return view('admin.evaluacion.resultados.resultados', compact('resultados', 'periodo_evaluacion', 'carreras', 'carrera_select', 'periodo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($periodo)
    {
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
        //


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
