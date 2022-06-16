<?php

namespace App\Http\Controllers\Examenes;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Evaluacion_respuesta;
use App\Models\Periodo_eval;
use App\Models\Pregunta;
use App\Models\Resultado;
use Illuminate\Http\Request;

class ExamenHabilidadesController extends Controller
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

    public function examenHabilidades(Alumno $alumno)
    {
        $razonamiento = Evaluacion_respuesta::where('alumno_id', $alumno->id)
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 3)
            ->count();
        if ($razonamiento != 0) {
            return redirect()->route('menu-examen.show', $alumno->id);
        }

        $preguntas = Pregunta::where('evaluacion_id', 3)->get();
        return view('examenes.habilidades', compact('preguntas', 'alumno'));
    }


    public function guardarExamenHabilidades(Request $request, $num_control)
    {
        $preguntas = Pregunta::where('evaluacion_id', 3)->get();
        $periodo_evaluacion = Periodo_eval::where('estado', 1)->get();

        foreach ($preguntas as $value) {

            Evaluacion_respuesta::create([
                'alumno_id' => $num_control,
                'pregunta_id' => $value->id,
                'respuesta_id' => $request->get($value->id),
                'periodo_eval_id' => $periodo_evaluacion[0]->id
            ]);
        }

        $alumno = Alumno::find($num_control);

        $resultado = Resultado::where('alumno_id', $num_control)->where('periodo_eval_id', $periodo_evaluacion[0]->id)->get(); //;
        $resultado=Resultado::fund($resultado[0]->id);
        $puntos = Evaluacion_respuesta::where('alumno_id', $alumno->id)
            ->join('respuestas', 'respuestas.id', '=', 'evaluacion_respuesta.respuesta_id')
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 3)
            ->where('preguntas.seccion', 1)
            ->sum('respuestas.valor');

        $resultado->razonamiento = $puntos;
        $resultado->save();

        return redirect()->route('menu-examen.show', $alumno->id);

        // return redirect()->route('test_socioeconomico.testEconomico', $alumno);
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
