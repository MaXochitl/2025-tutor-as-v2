<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evaluacion_respuesta;
use App\Models\Periodo_eval;
use Illuminate\Http\Request;

class PeriodoEvalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $periodo_eval = Periodo_eval::orderby('id', 'desc')->get();
        $activos = $periodo_eval->where('estado', 1)->count();

        return view('admin.evaluacion.periodo-eval.periodos', compact('periodo_eval'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.evaluacion.periodo-eval.nuevo');
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
        $activos = Periodo_eval::where('estado', 1)->count();

        if ($activos == 0) {
            $request->validate([
                'inicio' => ['required', 'date'],
                'fin' => ['required']

            ]);

            Periodo_eval::create([
                'inicio' => $request->inicio,
                'fin' => $request->fin,
                'estado' => 1
            ]);
            return redirect()->route('periodo-eval.index');
        }
        return redirect()->route('periodo-eval.index')->with('activos', 'si');
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


        $periodo_eval = Periodo_eval::find($id);
        return view('admin.evaluacion.periodo-eval.editar', compact('periodo_eval'));
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

        $activos = Periodo_eval::where('estado', 1)->count();

        //return $activos.' '. $request->estado;

        if ($activos > 0 && $request->estado) {
            return redirect()->route('periodo-eval.index')->with('activos', 'si');
        } else {
            $periodo_eval = Periodo_eval::find($id);
            $periodo_eval->inicio = $request->inicio;
            $periodo_eval->fin = $request->fin;
            $periodo_eval->estado = $request->estado;
            $periodo_eval->save();
            return redirect()->route('periodo-eval.index');
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
        //$periodo=Periodo_eval::max('id');
        $datos = Evaluacion_respuesta::where('periodo_eval_id', $id)->count();
        if ($datos == 0) {
            $periodo_eval = Periodo_eval::find($id);
            $periodo_eval->delete();
            return redirect()->route('periodo-eval.index');
        } else {
            return redirect()->route('periodo-eval.index')->with('eliminar', 'no');
        }
    }
}
