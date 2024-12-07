<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\File_format;
use App\Models\Periodo;
use App\Models\Periodo_semaforo;
use App\Models\Periodo_tutorado;
use App\Models\Periodo_view;
use App\Models\Tutor;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tutores = Tutor::all()->where('carrera_id', '>', 0);
        $tutorias = Periodo::max('id');
        $periodo = Periodo::find($tutorias);
        $alumnos_tutorados = Periodo_tutorado::all();
        $datos = File_format::all();

        return view('admin.constancia.constancia', compact('tutores', 'periodo', 'alumnos_tutorados', 'datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = 'hola';
        $tutores = Tutor::all()->where('carrera_id', '>', 0);
        $tutorias = Periodo::max('id');

        $periodo = Periodo::find($tutorias);

        $pdf = \App::make('dompdf.wrapper');
        $alumnos_tutorados = Periodo_tutorado::all();
        $datos = File_format::all();


        $pdf = PDF::loadView('admin.constancia.constancia', compact('tutores', 'periodo', 'alumnos_tutorados', 'datos'));
        return $pdf->stream();
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
        $periodo = Periodo_view::find(1);
        $periodo = $periodo->periodo_id;

        $tutores = DB::select('CALL ResumenRegistros(?)', [$periodo]);
        $periodo_tutorado = [];
        foreach ($tutores as  $value) {
            $periodo_tutorado[] = Periodo_tutorado::where('tutor_id', $value->tutor_id)
                ->where('tipo', 1)
                ->where('periodo_id', $periodo)
                ->pluck('id')
                ->toArray();
        }

        $sum_falls = [];
        foreach ($periodo_tutorado as  $value) {
            $sum_falls[] = Periodo_semaforo::whereIn('periodo_id', $value)
                ->whereBetween('semaforo_id', [2, 3])
                ->distinct()
                ->count(['periodo_id']);
        }

        $tutores = array_map(function ($tutor) {
            return (array)$tutor; // Convierte cada objeto stdClass en un array
        }, $tutores);

        for ($i = 0; $i < count($tutores); $i++) {
            $tutores[$i]['falls'] = $sum_falls[$i];
        }

        //return $tutores;

        $pdf = \App::make('dompdf.wrapper');
        //$alumnos_tutorados = Periodo_tutorado::all();
        //$datos = File_format::all();

        $carrera = Carrera::find($id);
        $pdf = PDF::loadView('admin.resumen_pdf.RCarreraPDF', compact('tutores','carrera'));
        return $pdf->stream();



        return view('admin.resumen_pdf.RCarreraPDF');
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
