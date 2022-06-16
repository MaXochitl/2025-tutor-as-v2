<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pregunta;
use App\Models\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;

class HabilidadesMentalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $preguntas=Pregunta::all()->where('evaluacion_id',3);
        $respuestas=Respuesta::all();
        return view('admin.evaluacion.habilidades.preguntas',compact('preguntas','respuestas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.evaluacion.habilidades.nuevo');
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
        
        $request->validate([
            'pregunta' => ['required'],
            'respuesta1' => ['required'],
            'valor1' => ['required'],
            'respuesta2' => ['required'],
            'valor2' => ['required'],
            'respuesta3' => ['required'],
            'valor3' => ['required'],
            'respuesta4' => ['required'],
            'valor4' => ['required'],
            'respuesta5' => ['required'],
            'valor5' => ['required']

        ]);
        $pregunta = Pregunta::create([
            'evaluacion_id' => 2,
            'pregunta' => $request->pregunta

        ]);

        $respuesta1 = Respuesta::create([
            'pregunta_id' => $pregunta->id,
            'respuesta' => $request->respuesta1,
            'valor' => $request->valor1
        ]);

        $respuesta2 = Respuesta::create([
            'pregunta_id' => $pregunta->id,
            'respuesta' => $request->respuesta2,
            'valor' => $request->valor3
        ]);
        $respuesta3 = Respuesta::create([
            'pregunta_id' => $pregunta->id,
            'respuesta' => $request->respuesta3,
            'valor' => $request->valor3
        ]);

        $respuesta4 = Respuesta::create([
            'pregunta_id' => $pregunta->id,
            'respuesta' => $request->respuesta4,
            'valor' => $request->valor4
        ]);
        $respuesta5 = Respuesta::create([
            'pregunta_id' => $pregunta->id,
            'respuesta' => $request->respuesta5,
            'valor' => $request->valor5
        ]);
        return redirect()->route('habilidades.index');
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
        $pregunta = Pregunta::find($id);
        $pregunta->delete();
        return redirect()->route('habilidades.index');
    }
}
