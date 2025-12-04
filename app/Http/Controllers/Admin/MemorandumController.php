<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade as PDF;

use App\Http\Controllers\Controller;
use App\Models\Asignacion_tutor;
use App\Models\File_format;
use App\Models\Periodo;
use App\Models\Periodo_tutorado;
use App\Models\Tutor;
use Illuminate\Http\Request;

class MemorandumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tutorias = Periodo::max('id');
        $periodo = Periodo::find($tutorias);
        $tutores = Tutor::where('carrera_id', '>', 0)->get();

        $datos = File_format::all();

        return view('admin.constancia.memorandum', compact('tutores', 'periodo', 'datos'));
    }

    /**
     * Show the form for cr eating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $tutorias = Periodo::max('id');
        $periodo = Periodo::find($tutorias);

        $tutores = Tutor::where('carrera_id', '>', 0)->get();
        $datos = File_format::all();

        // Filtrar tutores: solo incluir los que tengan asignaciones válidas
        $tutores = $tutores->filter(function ($tutor) use ($periodo) {

            $asignaciones = $tutor->asignaciones->where('periodo_id', $periodo->id);

            $asignacionesValidas = $asignaciones->filter(function ($asignacion) {
                return !($asignacion->semestre == 0 && $asignacion->grupo == 'sin asignar');
            });

            return $asignacionesValidas->count() > 0;
        }); //Fin del filtrado 

        // Generar PDF con los tutores filtrados
        $pdf = PDF::loadView('admin.constancia.memorandum', compact(
            'tutores',
            'periodo',
            'datos'
        ));

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
