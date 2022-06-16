<?php

namespace App\Http\Controllers\Examenes;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Evaluacion_respuesta;
use App\Models\Periodo_eval;
use App\Models\Pregunta;
use App\Models\Resultado;
use Illuminate\Http\Request;

class PsicometricoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function testPsicometrico(Alumno $alumno)
    {

        $razonamiento = Evaluacion_respuesta::where('alumno_id', $alumno->id)
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 1)
            ->count();
        if ($razonamiento != 0) {
            return redirect()->route('menu-examen.show', $alumno->id);
        }
        $preguntas = Pregunta::where('evaluacion_id', 1)->get();


        return view('examenes.psicometrico', compact('preguntas', 'alumno'));
        //return view('examenes.habilidades', compact('preguntas', 'alumno'));
    }

    public function guardarPsicometrico(Request $request, $num_control)
    {
        $preguntas = Pregunta::where('evaluacion_id', 1)->get();
        $periodo_evaluacion = Periodo_eval::where('estado', 1)->get();

        foreach ($preguntas as $value) {
            Evaluacion_respuesta::create([
                'alumno_id' => $num_control,
                'pregunta_id' => $value->id,
                'respuesta_id' => $request->get($value->id),
                'periodo_eval_id' => $periodo_evaluacion[0]->id
            ]);
        }

        $resultado = Resultado::where('alumno_id', $num_control)->where('periodo_eval_id', $periodo_evaluacion[0]->id)->get(); //;

        $seccion1 = Evaluacion_respuesta::where('alumno_id', $num_control)
            ->join('respuestas', 'respuestas.id', '=', 'evaluacion_respuesta.respuesta_id')
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 1)
            ->where('preguntas.seccion', 1)
            ->sum('respuestas.valor');

        $seccion2 = Evaluacion_respuesta::where('alumno_id', $num_control)
            ->join('respuestas', 'respuestas.id', '=', 'evaluacion_respuesta.respuesta_id')
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 1)
            ->where('preguntas.seccion', 2)
            ->sum('respuestas.valor');

        $seccion3 = Evaluacion_respuesta::where('alumno_id', $num_control)
            ->join('respuestas', 'respuestas.id', '=', 'evaluacion_respuesta.respuesta_id')
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 1)
            ->where('preguntas.seccion', 3)
            ->sum('respuestas.valor');

        $seccion4 = Evaluacion_respuesta::where('alumno_id', $num_control)
            ->join('respuestas', 'respuestas.id', '=', 'evaluacion_respuesta.respuesta_id')
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 1)
            ->where('preguntas.seccion', 4)
            ->sum('respuestas.valor');

        $seccion5 = Evaluacion_respuesta::where('alumno_id', $num_control)
            ->join('respuestas', 'respuestas.id', '=', 'evaluacion_respuesta.respuesta_id')
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 1)
            ->where('preguntas.seccion', 5)
            ->sum('respuestas.valor');

        $seccion6 = Evaluacion_respuesta::where('alumno_id', $num_control)
            ->join('respuestas', 'respuestas.id', '=', 'evaluacion_respuesta.respuesta_id')
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 1)
            ->where('preguntas.seccion', 6)
            ->sum('respuestas.valor');

        $resultado[0]->psicometrico_I = $seccion1;
        $resultado[0]->psicometrico_II = $seccion2;
        $resultado[0]->psicometrico_III = $seccion3;
        $resultado[0]->psicometrico_IV = $seccion4;
        $resultado[0]->psicometrico_V = $seccion5;
        $resultado[0]->psicometrico_VI = $seccion6;

        $resultado[0]->save();

        return redirect()->route('menu-examen.show', $num_control);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
