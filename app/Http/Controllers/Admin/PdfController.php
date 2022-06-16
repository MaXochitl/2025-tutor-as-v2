<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\Models\File_format;
use App\Models\Periodo;
use App\Models\Periodo_tutorado;
use App\Models\Tutor;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;

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
