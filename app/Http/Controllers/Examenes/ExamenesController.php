<?php

namespace App\Http\Controllers\Examenes;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Evaluacion_respuesta;
use App\Models\Posicion;
use Illuminate\Http\Request;


class ExamenesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('examenes.menu_examenes');
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
        //return $id;

        $alumno = Alumno::find($id);

        $psicometrico = Evaluacion_respuesta::where('alumno_id', $alumno->id)
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 1)
            ->get();


        $economico = Evaluacion_respuesta::where('alumno_id', $alumno->id)
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 2)
            ->get();
            
        $razonamiento = Evaluacion_respuesta::where('alumno_id', $alumno->id)
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 3)
            ->get();
        
            $testColores = Posicion::all()->where('alumno_id', $id)->sortBy('posicion');

        return view('examenes.menu_examenes', compact('alumno', 'psicometrico', 'razonamiento', 'economico', 'testColores'));
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
