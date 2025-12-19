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
        $hoy = date('d') . ' de ' . $meses[date('n') - 1] . ' de ' . date('Y');
        $inicio = $meses[date('n', strtotime($periodo->inicio)) - 1] . ' ' . date('Y', strtotime($periodo->inicio));
        $fin = $meses[date('n', strtotime($periodo->fin)) - 1] . ' ' . date('Y', strtotime($periodo->fin));

        // Crear doc Word
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->getSettings()->setThemeFontLang(new \PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::ES_ES));
        
        $contador = 0;

        foreach ($tutores as $item) {
            $section = $phpWord->addSection([
            'marginTop' => 1700,//listo
            'marginBottom' => 1440,
            'marginLeft'   => 1700,//listo
            'marginRight'  => 1700,//listo
            'paperSize' => 'Letter'//tamaño carta
            ]);

            $textRun = $section->addTextRun([
                'alignment'   => \PhpOffice\PhpWord\SimpleType\Jc::END,
                'lineHeight'  => 1,
                'spaceAfter' => 0,
                'spaceBefore'=> 0
            ]);

            $textRun->addText(
                'Instituto Tecnológico Superior de Tantoyuca',
                ['size' => 11, 'name' => 'Gotham-Medium', 'bold' => true]
            );
            $textRun->addTextBreak();

            $numeroMemo = $contador > 0 ? "-{$contador}" : '';
            $textRun->addText(
                "OFICIO No. O.E/010{$numeroMemo}/" . date('Y'),
                ['size' => 11, 'name' => 'Gotham-Medium']
            );
            $textRun->addTextBreak();

            $textRun->addText(
                "“Experiencia en la Formación de",
                ['size' => 11, 'name' => 'Gotham-Medium', 'bold' => true]
            );
            $textRun->addTextBreak();
            $textRun->addText(
                "Profesionistas”.",
                ['size' => 11, 'name' => 'Gotham-Medium', 'bold' => true]
            );
            $textRun->addTextBreak();

            $textRun->addText(
                'Asunto: ',
                [
                    'size' => 11,
                    'name' => 'Gotham Medium',
                    'bold' => true
                ]
            );

            $textRun->addText(
                'El que se indica',
                [
                    'size' => 11,
                    'name' => 'Gotham Medium',
                    'bold' => false
                ]
            );
            $textRun->addTextBreak();

            $textRun->addText(
                "Tantoyuca, Ver. a {$hoy}",
                ['size' => 11, 'name' => 'Gotham-Medium']
            );

            $section->addTextBreak();

            // Destinatario
            $textRun = $section->addTextRun([
                'alignment'   => \PhpOffice\PhpWord\SimpleType\Jc::START,
                'lineHeight' => 1,
                'spaceBefore'=> 300,
                'spaceAfter' => 0
            ]);

            $name = $item->nombre . ' ' . $item->ap_paterno . ' ' . $item->ap_materno;
            $nombreMayus = mb_strtoupper($name, 'UTF-8');

            $textRun->addText(
                $nombreMayus,
                ['size' => 12, 'name' => 'Aptos', 'bold' => true]
            );
            $textRun->addTextBreak();

            $textRun->addText(
                $datos[1]->destinatario,
                ['size' => 12, 'name' => 'Aptos', 'bold' => true]
            );
            $textRun->addTextBreak();

            $textRun->addText(
                'PRESENTE',
                ['size' => 12, 'name' => 'Aptos', 'bold' => true]
            );
            $textRun->addTextBreak();

            // Procesar asignaciones
            $asignacionesPeriodo = $item->asignaciones
                ->where('periodo_id', $periodo->id)
                ->sortBy(function ($a) {
                    return sprintf('%02d%s', $a->semestre, strtoupper($a->grupo));
                })
                ->values();

            $count = $asignacionesPeriodo->count();

            // Array para almacenar las partes del texto con su formato
            $partesTexto = [];

            if ($count > 1) {//tiene mas de una asignacion el tutor
                // Agrupar por semestre
                $agrupadosPorSemestre = $asignacionesPeriodo->groupBy('semestre');
                
                $partes = [];
                foreach ($agrupadosPorSemestre as $semestre => $asignaciones) {
                    $grupos = $asignaciones->map(fn($a) => strtoupper($a->grupo))->toArray();
                    
                    $parteSemestre = [];
                    $parteSemestre[] = ['texto' => $this->semestreATexto($semestre), 'negrita' => true];
                    
                    if (count($grupos) > 1) {
                        // Múltiples grupos del mismo semestre: "QUINTO semestre grupo B y C"
                        $ultimoGrupo = array_pop($grupos);
                        $parteSemestre[] = ['texto' => ' semestre grupo ' . implode(', ', $grupos) . ' y ' . $ultimoGrupo, 'negrita' => false];
                    } else {
                        // Un solo grupo: "QUINTO semestre grupo B"
                        $parteSemestre[] = ['texto' => ' semestre grupo ' . $grupos[0], 'negrita' => false];
                    }
                    
                    $partes[] = $parteSemestre;
                }
                
                // Unir todas las partes con los conectores adecuados
                if (count($partes) > 1) {
                    foreach ($partes as $index => $parte) {
                        if ($index > 0) {
                            if ($index == count($partes) - 1) {
                                // Última parte: agregar " y del "
                                $partesTexto[] = ['texto' => ' y del ', 'negrita' => false];
                            } else {
                                // Partes intermedias: agregar ", del "
                                $partesTexto[] = ['texto' => ', del ', 'negrita' => false];
                            }
                        }
                        // Agregar las partes del semestre y grupo
                        foreach ($parte as $subparte) {
                            $partesTexto[] = $subparte;
                        }
                    }
                } else {
                    // Solo hay un semestre con múltiples grupos
                    foreach ($partes[0] as $subparte) {
                        $partesTexto[] = $subparte;
                    }
                }
            } else {//tiene una sola asignacion el tutor
                $single = $asignacionesPeriodo->first();
                if ($single && $single->semestre != 0) {
                    $partesTexto[] = ['texto' => $this->semestreATexto($single->semestre), 'negrita' => true];
                    $partesTexto[] = ['texto' => ' semestre grupo ' . strtoupper($single->grupo), 'negrita' => false];
                } 
            }

            // Cuerpo del texto
            $textRun = $section->addTextRun([
                'alignment'   => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,
                'lineHeight'  => 1.5,
                'spaceBefore'=> 240,
                'spaceAfter' => 0
            ]);

            $textRun->addText(
                'Por medio del presente y en seguimiento a su solicitud recibida en el área de orientación educativa para participar en el programa institucional de tutorías, comprometiéndose con los requisitos que refiere la convocatoria en la que estipula brindar el seguimiento de los alumnos de forma grupal y personalizada, desempeñarse responsablemente con las canalizaciones, reportes mensuales y finales para proporcionar el seguimiento pertinente así como información extraordinaria que el área de orientación educativa requiera, se le otorga el nombramiento como tutor del ',
                ['size' => 12, 'name' => 'Aptos']
            );

            // Agregar las partes del texto con su formato correspondiente
            foreach ($partesTexto as $parte) {
                $textRun->addText(
                    $parte['texto'],
                    ['size' => 12, 'name' => 'Aptos', 'bold' => $parte['negrita']]
                );
            }

            $nombreCarrera = mb_strtolower($item->carrera->nombre_carrera, 'UTF-8');
            $nombreCarrera = mb_convert_case($nombreCarrera, MB_CASE_TITLE, 'UTF-8');

            $textRun->addText(
                ' de la carrera de ' . $nombreCarrera .
                " para el periodo escolar {$inicio}-{$fin}.",
                ['size' => 12, 'name' => 'Aptos']
            );
            //Fin Cuerpo del texto

            $section->addTextBreak(1);

            // Despedida
            $section->addText(
                'Sin otro particular, aprovecho la ocasión para enviarle un cordial saludo.',
                ['size' => 12, 'name' => 'Aptos'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::START]
            );

            $section->addTextBreak(1);

            $section->addText(
                'Atentamente',
                ['size' => 12, 'name' => 'Aptos', 'bold' => false],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );

            $section->addTextBreak(2);

            // Tabla de firmas
            $table = $section->addTable([
                'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,
                'width' => 100 * 50
            ]);
            
            $table->addRow();
            $table->addCell(3600)->addText(
                $datos[1]->atentamente_1,
                ['size' => 12, 'name' => 'Aptos'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );
            $table->addCell(3800)->addText(
                $datos[1]->atentamente_2,
                ['size' => 12, 'name' => 'Aptos'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );

            $table->addRow();
            $table->addCell(3600)->addText(
                $datos[1]->cargo,
                ['size' => 12, 'name' => 'Aptos'],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );
            $table->addCell(3800)->addText(
                $datos[1]->cargo_2,
                ['size' => 12, 'name' => 'Aptos'],
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

    private function semestreATexto(int $s): string
    {
        return match ($s) {
            1  => 'PRIMER',
            2  => 'SEGUNDO',
            3  => 'TERCER',
            4  => 'CUARTO',
            5  => 'QUINTO',
            6  => 'SEXTO',
            7  => 'SÉPTIMO',
            8  => 'OCTAVO',
            9  => 'NOVENO',
            10 => 'DÉCIMO',
            11 => 'UNDÉCIMO',
            12 => 'DUODÉCIMO',
            13 => 'DECIMOTERCER',
            14 => 'DECIMOCUARTO',
            15 => 'DECIMOQUINTO',
            16 => 'DECIMOSEXTO',
            17 => 'DECIMOSÉPTIMO',
            default => (string) $s,
        };
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
