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
    $periodo_id = $periodoView->periodo_id;
    $carrera = Carrera::find($id);
    $tutores = DB::select('CALL ReportesCarrera(?, ?)', [$periodo_id, $id]);

    if (empty($tutores)) {
        return redirect()->back()->with([
            'error' => 'no_data',
            'message' => 'No hay información disponible para generar el reporte en el periodo seleccionado.'
        ]);
    }

    $data = [];
    $contador = 1;
    foreach ($tutores as $tutor) {
        $tutor = (array)$tutor;
        $data[] = [
            $contador,
            $tutor['tutor_nombre'] ?? '',                                                  
            $tutor['grupo'] ?? '',                    
            $tutor['tutorias_grupales'] ?? 0,       
            $tutor['tutorias_individuales'] ?? 0,                                       
            $tutor['estudiantes_canalizados'] ?? 0,
            '',
            '',
            $tutor['areas_canalizadas'] ?? '',                                                                   
        ];
        $contador++;
    }

    date_default_timezone_set('America/Mexico_City');
    
    // Cabeceras de la tabla.
    $headings = [
    [' '],
    [' '],
    [' '],
    [' '],
    [' '],
    ['REPORTE SEMESTRAL DEL COORDINADOR INSTITUCIONAL DE TUTORÍA'],
    ['Nombre del Coordinador Institucional de Tutorías:', '', '', '', '', '', '', '', ' Fecha:', date('d/m/Y')],
    ['Programa Educativo:', '', $carrera->nombre_carrera, '', '', '', '', '', ' Hora:', date('h:i A')],
    ['Lista de tutores','', "Semestre y\nGrupo", "Estudiantes atendidos\nen el semestre", '', "Estudiantes canalizados\nen el semestre",'','', 'Área canalizada'],
    ['', '','', "Tutoría\nGrupal", "Tutoría\nIndividual", '', ''],
    ];

    return Excel::download(
        new ReportExport($data, $headings), 
        'F-OE-06 REPORTE SEMESTRAL DEL COORDINADOR INSTITUCIONAL DE TUTORIA' . '.xlsx'
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
