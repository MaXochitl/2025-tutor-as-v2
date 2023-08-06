<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Control_materia;
use App\Models\Periodo;
use App\Models\Periodo_tutorado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Table\Table;

class HistorialController extends Controller
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
        $periodos = Periodo::all();
        $control_materias = Control_materia::all();
        $historial = Periodo_tutorado::orderby('tutor_id', 'asc')
            ->join('alumnos', 'alumnos.id', '=', 'periodo_tutorado.alumno_id')
            ->orderBy('tutor_id', 'asc')
            ->orderBy('alumnos.carrera_id', 'asc')
            ->orderBy('semaforo_id', 'desc')
            ->paginate(15);
        $periodo_actual = 0;
        $carrera_select = 0;
        return view('admin.historial.historial', compact('historial', 'carreras', 'periodos', 'control_materias', 'periodo_actual', 'carrera_select'));
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
        $carreras = Carrera::all();
        $periodos = Periodo::orderby('id', 'desc')->get();
        $control_materias = Control_materia::all();

        $historial = Periodo_tutorado::orderby('tutor_id', 'asc')
            ->join('alumnos', 'alumnos.id', '=', 'periodo_tutorado.alumno_id')
            ->orderBy('tutor_id', 'asc')
            ->orderBy('alumnos.carrera_id', 'asc')
            ->where('alumnos.carrera_id', $request->carrera)
            ->Where('periodo_id', $request->periodo)
            ->get();

        $periodo_actual = $request->periodo;
        $carrera_select = $request->carrera;

        return view('admin.historial.historial', compact('historial', 'carreras', 'periodos', 'control_materias', 'periodo_actual', 'carrera_select'));
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
        return $request;
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
