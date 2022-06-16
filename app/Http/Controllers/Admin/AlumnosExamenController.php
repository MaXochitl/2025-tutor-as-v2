<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AlumnosExport;
use App\Http\Controllers\Controller;
use App\Imports\AlumnosImport;
use App\Models\Alumnos_examenes;
use App\Models\Carrera;
use App\Models\Periodo;
use App\Models\Periodo_eval;
use App\Models\Resultado;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AlumnosExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //extraer el utimo periodo
        $periodo = Periodo_eval::max('id');
        if ($periodo == null) {
            return redirect()->route('periodo-eval.index');
        }
        $periodo_actual = Periodo_eval::find($periodo);

        $resultados = Resultado::where('periodo_eval_id', $periodo)
            ->join('alumnos', 'alumnos.id', '=', 'resultados.alumno_id')
            ->orderBy('alumnos.carrera_id')
            ->get();

        $alumnos = Alumnos_examenes::where('periodo_eval_id', $periodo)->get();

        foreach ($alumnos as $alumno) {
            foreach ($resultados as $item1) {
                $id1 = strtoupper($item1->alumno_id);
                $id2 = strtoupper($alumno->num_control);
                if ($id1 == $id2) {
                    $alumno->status = 1;
                    $alumno->save();
                }
            }
        }

        $lista_alumnos = Alumnos_examenes::where('periodo_eval_id', $periodo)
            ->orderBy('carrera_id', 'asc')
            ->orderBy('status', 'asc')
            ->get();
        $carreras = Carrera::all();

        return view('admin.alumnos_ni.alumnos', compact('lista_alumnos', 'carreras', 'periodo_actual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Excel::download(new AlumnosExport, 'lista_alumnos.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $periodo = Periodo_eval::max('id');

        $lista_alumnos = Alumnos_examenes::create([
            'periodo_eval_id' => $periodo,
            'num_control' => $request->num_control,
            'carrera_id' => $request->carrera,
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'status' => 0

        ]);

        return redirect()->route('alumnos_examenes.index');
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
        $lista_alumnos = Alumnos_examenes::find($id);
        $lista_alumnos->num_control = $request->num_control;
        $lista_alumnos->carrera_id = $request->carrera;
        $lista_alumnos->nombre = $request->nombre;
        $lista_alumnos->telefono = $request->telefono;
        $lista_alumnos->correo = $request->correo;
        $lista_alumnos->save();

        return redirect()->route('alumnos_examenes.index');
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
        Alumnos_examenes::find($id)->delete();
        return redirect()->route('alumnos_examenes.index')->with('eliminar', 'ok');
    }
    public function importExcel(Request $request)
    {
        //return 'hola';
        $file = $request->file('file');
        Excel::import(new AlumnosImport, $file);
        return back();
    }
}
