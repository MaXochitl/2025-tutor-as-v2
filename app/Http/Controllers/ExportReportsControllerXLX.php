<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Models\Carrera;
use App\Models\Periodo_semaforo;
use App\Models\Periodo_tutorado;
use App\Models\Periodo_view;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportReportsControllerXLX extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Datos para el cuerpo del reporte
        $data = [
            ['Ing. Carmen Karely Pro Torres', '2° A', 13, 10, 10, 'Orientación Educativa'],
            ['Ing. Marcelino Cruz del Ángel', '4° A', 9, 2, 2, 'Orientación Educativa'],
            ['M.G.E.R. Sofía Elizabeth García Martínez', '6° A', 13, 4, 4, 'Orientación Educativa'],
            ['Dr. José Jaime González Elizondo', '8° A', 11, 1, 1, 'Orientación Educativa'],
        ];

        // Cabeceras dinámicas
        $headings = [
            ['INSTITUTO TECNOLÓGICO SUPERIOR DE TANTOYUCA'],
            ['REPORTE SEMESTRAL DEL COORDINADOR DE TUTORÍA DEL DEPARTAMENTO ACADÉMICO'],
            ['Programa Educativo: Ing. Ambiental', 'Fecha: ' . date('d/m/Y'), 'Hora: ' . date('H:i')], // Dinámico
            ['Lista de tutores', 'Grupo', 'Tutoría Grupal', 'Tutoría Individual', 'Estudiantes canalizados en el semestre', 'Área canalizada'],
        ];

        // Descargar el archivo Excel
        return Excel::download(new ReportExport($data, $headings), 'reporte_semestral.xlsx');
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
    $periodoView = Periodo_view::first();
    
    if (!$periodoView) {
        return back()->with('error', 'No hay periodo configurado en la vista');
    }
    
    $periodo_id = $periodoView->periodo_id;
    $carrera = Carrera::find($id);
    
    if (!$carrera) {
        return back()->with('error', 'Carrera no encontrada');
    }

    $tutores = DB::select('CALL ReportesCarrera(?, ?)', [$periodo_id, $id]);
    
    if (empty($tutores)) {
        return back()->with('warning', 'No hay tutores con grupos asignados para generar el reporte en este periodo');
    }

    $tutores = array_map(function ($tutor) {
        return (array)$tutor;
    }, $tutores);

    date_default_timezone_set('America/Mexico_City');
    
    $headings = [
        [' '],
        [' '],
        [' '],
        [' '],
        ['INSTITUTO TECNOLÓGICO SUPERIOR DE TANTOYUCA'],
        ['REPORTE SEMESTRAL DEL COORDINADOR DE TUTORÍA DEL DEPARTAMENTO ACADÉMICO'],
        ['Programa Educativo:', '', $carrera->nombre_carrera, '', '', '', ''],
        ['Fecha: ', date('d/m/Y'), 'Hora: ' . date('h:i A')],
        ['ID Tutor', 'Nombre del Tutor', 'Grupo', 'Tutoría Grupal', 'Tutoría Individual', 'Estudiantes Canalizados', 'Áreas Canalizadas'],
    ];

    return Excel::download(
        new ReportExport($tutores, $headings), 
        'reporte_semestral_' . $carrera->nombre_carrera . '_' . date('Y-m-d') . '.xlsx'
    );
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
