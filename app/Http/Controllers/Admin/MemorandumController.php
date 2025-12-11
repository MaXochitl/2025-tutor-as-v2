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
    public function index(){}

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

        // Filtrar tutores: solo incluir los que tengan asignaciones validas
        $tutores = $tutores->filter(function ($tutor) use ($periodo) {
            $asignaciones = $tutor->asignaciones->where('periodo_id', $periodo->id);

            $asignacionesValidas = $asignaciones->filter(function ($asignacion) {
                return !($asignacion->semestre == 0 && $asignacion->grupo == 'sin asignar');
            });

            return $asignacionesValidas->count() > 0;
        });

        // fechas
        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_ALL, 'es_ES');
        $diassemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $hoy = $diassemana[date('w')] . ' ' . date('d') . ' de ' . $meses[date('n') - 1] . ' del ' . date('Y');
        
        $inicio = $meses[date('n', strtotime($periodo->inicio)) - 1] . '  ' . date('Y', strtotime($periodo->inicio));
        $fin = $meses[date('n', strtotime($periodo->fin)) - 1] . '  ' . date('Y', strtotime($periodo->fin));

        // Crear doc Word
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        
        $phpWord->getSettings()->setThemeFontLang(new \PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::ES_ES));
        
        $contador = 1;

        foreach ($tutores as $item) {
            $section = $phpWord->addSection([
                'marginTop' => 1440,
                'marginBottom' => 1440,
                'marginLeft' => 1440,
                'marginRight' => 1440
            ]);

            // Espacio para membrete (60px)
            $section->addTextBreak(2);

            // Encabezado del memorandum (alineado a la derecha)
            $numeroMemo = $contador < 10 ? "0{$contador}" : $contador;
            $section->addText(
                "Memorándum Nº OE /{$numeroMemo}/" . date('Y'),
                ['size' => 11, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END]
            );
            
            $section->addText(
                'ASUNTO: El que se indica',
                ['size' => 11, 'name' => 'Arial', 'bold' => true],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END]
            );
            
            $section->addText(
                "Tantoyuca, Ver., {$hoy}",
                ['size' => 11, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END]
            );

            $section->addTextBreak(1);

            // Destinatario
            $name = $item->nombre . ' ' . $item->ap_paterno . ' ' . $item->ap_materno;
            $nombreMayus = mb_strtoupper($name, 'UTF-8');
            $section->addText(
                $nombreMayus,
                ['size' => 11, 'name' => 'Arial', 'bold' => true],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::START]
            );
            
            $section->addText(
                $datos[1]->destinatario,
                ['size' => 11, 'name' => 'Arial', 'bold' => true],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::START]
            );
            
            $section->addText(
                'PRESENTE',
                ['size' => 11, 'name' => 'Arial', 'bold' => true],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::START]
            );

            $section->addTextBreak(1);

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
                    $asignacionesPeriodo->last()->semestre . '°' .
                    strtoupper($asignacionesPeriodo->last()->grupo);
                $esPlural = true;
            } else {
                $single = $asignacionesPeriodo->first();
                if ($single && $single->semestre != 0 && $single->grupo != 'sin asignar') {
                    $listaSemGrup = $single->semestre . '°' . strtoupper($single->grupo);
                } else {
                    $listaSemGrup = 'NO ASIGNADO';
                }
                $esPlural = false;
            }

            // Cuerpo del texto
            $textoSemestre = $esPlural ? 'de los semestres y grupos' : 'del semestre y grupo';
            
            $textRun = $section->addTextRun(['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText(
                '        Por medio del presente se le otorga la asignación como tutor ' . $textoSemestre . ' ',
                ['size' => 11, 'name' => 'Arial']
            );
            
            if ($listaSemGrup == 'NO ASIGNADO') {
                $textRun->addText($listaSemGrup, ['size' => 11, 'name' => 'Arial', 'bold' => true]);
            } else {
                $textRun->addText($listaSemGrup, ['size' => 11, 'name' => 'Arial']);
            }
            
            $textRun->addText(
                ' de la carrera de ' . $item->carrera->nombre_carrera . 
                " para el periodo {$inicio} - {$fin}. En seguimiento a su solicitud recibida en el área de orientación educativa para participar en el programa institucional de tutorías, Comprometiéndose a cumplir con los requisitos que refiere la convocatoria en la que estipula tener el compromiso en el seguimiento de los alumnos de forma personalizada en tiempos oportunos, desempeñarse responsablemente con los reportes mensuales, finales, así como información extraordinaria que se requiera, contando con las evidencias fotográficas generadas del seguimiento correspondiente para presentarlas al área en caso de ser necesario, realizar las canalizaciones oportunas para el seguimiento pertinente en el área de orientación educativa después de haber atendido personalmente a casos especiales.",
                ['size' => 11, 'name' => 'Arial']
            );

            $section->addTextBreak(1);

            // Despedida
            $section->addText(
                'Sin otro particular, aprovecho la ocasión para enviarle un cordial saludo.',
                ['size' => 11, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::START]
            );

            $section->addTextBreak(1);

            $section->addText(
                'ATENTAMENTE',
                ['size' => 11, 'name' => 'Arial', 'bold' => true],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );

            $section->addTextBreak(3);

            // Tabla de firmas
            $table = $section->addTable([
                'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,
                'width' => 100 * 50
            ]);
            
            $table->addRow();
            $table->addCell(3000)->addText(
                $datos[1]->atentamente_1,
                ['size' => 10, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );
            $table->addCell(3000)->addText(
                $datos[1]->atentamente_2,
                ['size' => 10, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );
            $table->addCell(3000)->addText(
                $datos[1]->atentamente_3,
                ['size' => 10, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );

            $table->addRow();
            $table->addCell(3000)->addText(
                $datos[1]->cargo,
                ['size' => 10, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );
            $table->addCell(3000)->addText(
                $datos[1]->cargo_2,
                ['size' => 10, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );
            $table->addCell(3000)->addText(
                $datos[1]->cargo_3,
                ['size' => 10, 'name' => 'Arial'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );

            $contador++;
        }

        // Generar y descargar el archivo Word
        $filename = 'memorandums_' . date('Y-m-d') . '.docx';
        
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        
        // Guardar temporalmente
        $temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
        $writer->save($temp_file);
        
        // Descargar
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
