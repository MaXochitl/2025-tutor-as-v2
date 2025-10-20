<?php

namespace App\Http\Controllers;

use App\Models\Control_materia;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Periodo_tutorado;
use App\Models\Respuesta;
use App\Models\Semaforo;
use App\Models\Tutor;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Table\Table;

class ControlMateriasController extends Controller
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
        // return $request;
    }

    public function addMateria(Request $request, $id, $status)
    {
        $periodo_tutorado = Periodo_tutorado::find($id);

        foreach ($request->materiax as $value) {
            Control_materia::create([
                'periodo_id' => $periodo_tutorado->periodo_id,
                'materia_id' => $value,
                'alumno_id' => $periodo_tutorado->alumno_id,
                'status' => $status
            ]);
        }
        return redirect()->route('reporte.show', $id);
    }

    public function removMateria($id, $materia)
    {
        Control_materia::destroy($materia);

        return redirect()->route('reporte.show', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $user = User::find(Auth::user()->id);
        $id_tutor = $user->tutor_id;
        $tutor = Tutor::find($id_tutor);

        $carrera = $tutor->carrera;

        if ($tutor->carrera_id != null) {
            $carrera = $carrera->id;
            $materias = Materia::where('carrera_id', $carrera)
                ->orderby('carrera_id', 'asc')
                ->orderby('semestre', 'asc')
                ->get();
        } else {
            $materias = Materia::orderby('carrera_id', 'asc')
                ->orderby('semestre', 'asc')
                ->get();
        }

        $periodo_tutorado = Periodo_tutorado::find($id);


        //$materias = Materia::orderby('nombre', 'asc')->get();

        $semaforo = Semaforo::where('id', '<', 5)->get();


        $materia_aprobadas = Control_materia::all()
            ->where('periodo_id', $periodo_tutorado->periodo_id)
            ->where('alumno_id', $periodo_tutorado->alumno_id)
            ->where('status', 1);

        $materia_reprobadas = Control_materia::all()
            ->where('periodo_id', $periodo_tutorado->periodo_id)
            ->where('alumno_id', $periodo_tutorado->alumno_id)
            ->where('status', 0);

        $materias_seleccionadas = array_merge(
            $materia_aprobadas->pluck('materia_id')->toArray(),
            $materia_reprobadas->pluck('materia_id')->toArray()
        );

        $now = new DateTime();
        $fecha = $now->format('Y-m-d H:i:s'); //obtiene fecha actual
        $periodo_tutorado->entrega_final = $fecha;

        return view('tutor-alumno.end-report', compact('periodo_tutorado', 'materias', 'materia_aprobadas', 'materia_reprobadas','materias_seleccionadas', 'semaforo'));
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
