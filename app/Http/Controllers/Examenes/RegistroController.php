<?php

namespace App\Http\Controllers\Examenes;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\Periodo_eval;
use App\Models\Pregunta;
use App\Models\Resultado;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $carreras = Carrera::all();
        return view('examenes.registro', compact('carreras'));
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
        $request->validate([
            'ncontrol' => ['required'],
            'nombre' => ['required'],
            'ap_paterno' => ['required'],
            'ap_materno' => ['required'],
            'nacimiento' => ['required'],
            'domicilio' => ['required'],
            'telefono' => ['required'],
            'correo' => ['required'],

        ]);

        $alumno = Alumno::find($request->ncontrol);

        $numero_control = $request->ncontrol;

        if ($alumno == null) {

            $periodo_evaluacion = Periodo_eval::where('estado', 1)->get();
            $alumno = Alumno::create([
                'id' => $request->ncontrol,
                'nombre' => $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'sexo' => $request->sexo,
                'fecha_nacimiento' => $request->nacimiento,
                'domicilio' => $request->domicilio,
                'grupo' => $request->grupo,
                'telefono' => $request->telefono,
                'correo' => $request->correo,
                'estado' => 1,
                'carrera_id' => $request->carrera

            ]);

            $alumno = Alumno::find($request->ncontrol);

            $resultado = Resultado::create([
                'alumno_id' => $alumno->id,
                'periodo_eval_id' => $periodo_evaluacion[0]->id
            ]);
            return redirect()->route('menu-examen.show', $alumno->id);
        } else {
            return redirect()->route('registro.index')->with('registro', 'no')->with('nombre', $alumno->nombre . ' ' . $alumno->ap_paterno . ' ' . $alumno->ap_materno);
        }
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
