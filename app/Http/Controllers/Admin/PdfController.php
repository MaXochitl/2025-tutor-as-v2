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
    public function index(){}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tutores = Tutor::where('carrera_id', '>', 0)->get();
        $tutorias = Periodo::max('id');
        $periodo = Periodo::find($tutorias);
        $alumnos_tutorados = Periodo_tutorado::all();
        $datos = File_format::all();

        // Filtrar tutores: solo tutores con al menos UNA asignación válida
        $tutores = $tutores->filter(function ($tutor) use ($periodo) {
            $asignaciones = $tutor->asignaciones->where('periodo_id', $periodo->id);

            $asignacionesValidas = $asignaciones->filter(function ($asignacion) {
                return !(
                    $asignacion->semestre == 0 &&
                    $asignacion->grupo == 'sin asignar'
                );
            });

            return $asignacionesValidas->count() > 0;
        });

        // Configurar fechas
        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_ALL, 'es_ES');
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        
        $hoy = date('d') . ' días del mes de ' . $meses[date('n') - 1] . ' del año ' . date('Y');
        $inicio = $meses[date('n', strtotime($periodo->inicio)) - 1] . '  ' . date('Y', strtotime($periodo->inicio));
        $fin = $meses[date('n', strtotime($periodo->fin)) - 1] . '  ' . date('Y', strtotime($periodo->fin));

        // Crear documento Word
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->getSettings()->setThemeFontLang(new \PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::ES_ES));

        foreach ($tutores as $item) {
            $section = $phpWord->addSection([
                'marginTop' => 1440,
                'marginBottom' => 1440,
                'marginLeft' => 1440,
                'marginRight' => 1440
            ]);

            // Espacio para membrete (60px)
            $section->addTextBreak(2);

            // Encabezado
            $section->addText(
                'A QUIEN CORRESPONDA',
                ['size' => 11, 'name' => 'Arial', 'bold' => true],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::START, 'spaceAfter' => 0]
            );
            
            $section->addText(
                $datos[0]->destinatario,
                ['size' => 11, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::START, 'spaceAfter' => 240]
            );

            // Primer parrafo
            $section->addText(
                '        El suscrito, Coordinador del programa institucional de tutorías del Instituto Tecnológico Superior de Tantoyuca, Veracruz.',
                ['size' => 11, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'spaceAfter' => 240]
            );

            // Título "HACE CONSTAR"
            $section->addTextBreak(1); // espacio abajo
            $section->addText(
                'H A C E     C O N S T A R',
                ['size' => 14, 'name' => 'Arial', 'bold' => true],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 240]
            );
            $section->addTextBreak(1); // espacio abajo

            // Procesar asignaciones
            $asignacionesPeriodo = $item->asignaciones
                ->where('periodo_id', $periodo->id)
                ->sortBy(function ($a) {
                    return sprintf('%02d%s', $a->semestre, strtoupper($a->grupo));
                })
                ->values();

            $count = $asignacionesPeriodo->count();

            if ($count > 1) {
                $listaSemGrup = $asignacionesPeriodo
                    ->slice(0, $count - 1)
                    ->map(fn($a) => $a->semestre . '°' . strtoupper($a->grupo))
                    ->implode(', ')
                    . ' y ' . 
                    $asignacionesPeriodo->last()->semestre . '°' . strtoupper($asignacionesPeriodo->last()->grupo);
                $esPlural = true;
            } else {
                $single = $asignacionesPeriodo->first();
                $listaSemGrup = $single->semestre . '°' . strtoupper($single->grupo);
                $esPlural = false;
            }

            // Nombre del tutor
            $name = $item->nombre . ' ' . $item->ap_paterno . ' ' . $item->ap_materno;
            $nombreMayus = mb_strtoupper($name, 'UTF-8');
            
            // Nombre de la carrera
            $carrera = $item->carrera != null ? $item->carrera->nombre_carrera : '';
            
            // Contar alumnos tutorados
            $totalAlumnos = $alumnos_tutorados
                ->where('tutor_id', $item->id)
                ->where('periodo_id', $periodo->id)
                ->where('tipo', 1)
                ->count();

            $textoSemestre = $esPlural ? 'de los semestres y grupos' : 'del semestre y grupo';

            // Parrafo principal
            $textRun = $section->addTextRun(['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText(
                "Que el (la) {$nombreMayus} del programa académico de {$carrera} llevó a cabo el PROGRAMA INSTITUCIONAL DE TUTORÍA de forma grupal, durante el periodo {$inicio} – {$fin} con un total de 16 Hrs en el Instituto Tecnológico Superior de Tantoyuca, atendiendo a {$totalAlumnos} alumnos, {$textoSemestre} {$listaSemGrup}, cumpliendo el 100% de las actividades del programa, con un índice de deserción del 0%.",
                ['size' => 11, 'name' => 'Arial']
            );

            $section->addTextBreak(1);

            // Parrafo de cierre
            $section->addText(
                "Se extiende la presente, para los fines legales que al interesado convengan, en la ciudad de Tantoyuca, Veracruz, a los {$hoy}.",
                ['size' => 11, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'spaceAfter' => 100]
            );

            $section->addTextBreak(2);

            $phpWord->addParagraphStyle('firmaLinea', [
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
                'spaceAfter' => 0, 
            ]);

            $textRun = $section->addTextRun('firmaLinea');

            $textRun->addText('Atentamente', [
                'size' => 11,
                'name' => 'Arial',
                'bold' => true
            ]);

            $textRun->addText(str_repeat(' ', 60));

            $textRun->addText('Vo. Bo.', [
                'size' => 11,
                'name' => 'Arial',
                'bold' => true
            ]);

            $section->addTextBreak(3); 

            // Tabla de firmas
            $tableStyle = [
                'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,
                'width' => 100 * 50,
                'borderSize' => 0,
                'borderColor' => 'FFFFFF'
            ];
            
            $cellStyle = [
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
                'valign' => 'top'
            ];

            $table = $section->addTable($tableStyle);

            // Segunda fila: nombres
            $table->addRow();
            $table->addCell(3000, $cellStyle)->addText(
                $datos[0]->atentamente_1,
                ['size' => 10, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );
            $table->addCell(3000, $cellStyle)->addText(
                $datos[0]->atentamente_2,
                ['size' => 10, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );
            $table->addCell(3000, $cellStyle)->addText(
                $datos[0]->atentamente_3,
                ['size' => 10, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );

            // Tercera fila: cargos
            $table->addRow();
            $table->addCell(3000, $cellStyle)->addText(
                $datos[0]->cargo,
                ['size' => 10, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );
            $table->addCell(3000, $cellStyle)->addText(
                $datos[0]->cargo_2,
                ['size' => 10, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );
            $table->addCell(3000, $cellStyle)->addText(
                $datos[0]->cargo_3,
                ['size' => 10, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );

            // Espacio para footer
            $section->addTextBreak(4);
        }

        // Generar y descargar el archivo Word
        $filename = 'constancias_' . date('Y-m-d') . '.docx';
        
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
        $writer->save($temp_file);
        
        return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
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

        $tutores = DB::select('CALL ResumenRegistros(?,?)', [$periodo,$id]);
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
        $fileFormat = File_format::find(1);
        $carrera = Carrera::find($id);
        $pdf = PDF::loadView('admin.resumen_pdf.RCarreraPDF', compact('tutores','carrera', 'fileFormat'));
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
