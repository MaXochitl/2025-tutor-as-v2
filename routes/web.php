<?php

use App\Http\Controllers\admin\AlteraEntregaController;
use App\Http\Controllers\Admin\AlumnosExamenController;
use App\Http\Controllers\Admin\AsignacionesController;
use App\Http\Controllers\Admin\CarreraController;
use App\Http\Controllers\Admin\EvaluacionController;
use App\Http\Controllers\Admin\HabilidadesMentalesController;
use App\Http\Controllers\Admin\HistorialController;
use App\Http\Controllers\Admin\MateriasController;
use App\Http\Controllers\Admin\MemorandumController;
use App\Http\Controllers\Admin\OrientacionController;
use App\Http\Controllers\Admin\PdfController;
use App\Http\Controllers\Admin\PeriodoEvalController;
use App\Http\Controllers\Admin\PeriodoTutoradoController;
use App\Http\Controllers\Admin\PreguntasController;
use App\Http\Controllers\Examenes\TestColoresController;
use App\Http\Controllers\Admin\TutoresController;
use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\AvisosController;
use App\Http\Controllers\ControlMateriasController;
use App\Http\Controllers\Examenes\ExamenesController;
use App\Http\Controllers\Examenes\ExamenHabilidadesController;
use App\Http\Controllers\Examenes\OrderController;
use App\Http\Controllers\Examenes\PsicometricoController;
use App\Http\Controllers\Examenes\RegistroController;
use App\Http\Controllers\Examenes\TestEconomicoController;
use App\Http\Controllers\PruebasController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\TutoriasController;
use App\Models\Altera_entrega;
use App\Models\File_format;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;

App::setLocale('es');

require __DIR__ . '/auth.php';

//solo admin
Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('orientacion.index');
})->middleware(['auth']);

Route::put('/seguimientoOE-alumno/{id}/{mes}', [
    TutoriasController::class, 'seguimientoOE'
])->name('seguimientoOE-alumno.seguimientoOE');

Route::resource('preguntas', PreguntasController::class)->middleware(['auth', 'can:solo.admin'])->names('preguntas');
Route::resource('habilidades', HabilidadesMentalesController::class)->middleware(['auth', 'can:solo.admin'])->names('habilidades');
Route::resource('colores', TestColoresController::class)->middleware(['auth', 'can:solo.admin'])->names('colores');


Route::resource('carrera', CarreraController::class)->middleware(['auth', 'can:solo.admin'])->names('carrera');
Route::resource('orientacion', OrientacionController::class)->middleware(['auth'])->names('orientacion');
Route::resource('materia', MateriasController::class)->middleware(['auth'])->names('materia');
Route::resource('periodo-tutorado', PeriodoTutoradoController::class)->middleware(['auth', 'can:solo.admin'])->names('periodo-tutorado');
Route::resource('historial', HistorialController::class)->middleware(['auth', 'can:solo.admin'])->names('historial');
Route::resource('aviso', AvisosController::class)->middleware(['auth', 'can:solo.admin'])->names('aviso');
Route::resource('pdf', PdfController::class)->middleware(['auth'])->names('pdf');
Route::resource('evaluacion', EvaluacionController::class)->middleware(['auth', 'can:solo.admin'])->names('evaluacion');
Route::resource('periodo-eval', PeriodoEvalController::class)->middleware(['auth', 'can:solo.admin'])->names('periodo-eval');
Route::resource('datospdf', ArchivoController::class)->middleware(['auth', 'can:solo.admin'])->names('datospdf');
Route::resource('asignaciones', AsignacionesController::class)->middleware(['auth', 'can:solo.admin'])->names('asignaciones');
Route::resource('memorandum', MemorandumController::class)->names('memorandum');
Route::resource('alumnos_examenes', AlumnosExamenController::class)->middleware(['auth', 'can:solo.admin'])->names('alumnos_examenes');

//__________________________________________________________________
Route::resource('entrega', AlteraEntregaController::class)->names('entrega');
//__________________________________________________________________

Route::post('importExcel', [AlumnosExamenController::class, 'importExcel'])->middleware(['auth'])->name('importExcel');
Route::post('importAlumnos', [AlumnosController::class, 'importAlumnos'])->middleware(['auth'])->name('importAlumnos');


//solo tutor
Route::put('/seguimiento-alumno/{id}/{mes}', [
    TutoriasController::class, 'seguimiento'
])->middleware(['auth'])->name('seguimiento-alumno.seguimiento');

Route::put('/addMateria/{id}/{status}', [
    ControlMateriasController::class, 'addMateria'
])->middleware(['auth'])->name('addMateria.addMateria');

Route::delete('/removMateria/{id}/{reporte}', [
    ControlMateriasController::class, 'removMateria'
])->middleware(['auth'])->name('removMateria.removMateria');


Route::resource('reporte', ControlMateriasController::class)->middleware(['auth'])->names('reporte');



//ambos acceden a la ruta
Route::resource('alumnos-tutor', TutoriasController::class)->middleware(['auth'])->names('alumnos-tutor');

Route::put('/addAlumno/{tipo}', [
    TutoriasController::class, 'inserAlumno'
])->middleware(['auth'])->name('addAlumno');

Route::get('bajaAlumno/{id}/{status}/{color}', [TutoriasController::class, 'baja'])->middleware(['auth'])->name('baja');

Route::resource('alumnos', AlumnosController::class)->middleware(['auth'])->names('alumnos');

Route::resource('tutor', TutoresController::class)->middleware(['auth'])->names('tutor');
Route::get('resetPass/{id}', [TutoresController::class, 'resetPass'])->name('resetPass');

//alumno
Route::get('test_socioeconomico/{alumno}', [TestEconomicoController::class, 'testEconomico'])->name('test_socioeconomico.testEconomico');
Route::post('guardar_examen/{num_control}', [TestEconomicoController::class, 'guardarRespuestas'])->name('guardar_examen.guardarRespuestas');
Route::get('examen_habilidades/{alumno}', [ExamenHabilidadesController::class, 'examenHabilidades'])->name('examen_habilidades.examenHabilidades');
Route::post('guardar_examen2/{num_control}', [ExamenHabilidadesController::class, 'guardarExamenHabilidades'])->name('guardar_examen2.guardarExamenHabilidades');
Route::get('examen_psicometrico/{alumno}', [PsicometricoController::class, 'testPsicometrico'])->name('examen_psicometrico.testPsicometrico');
Route::post('guardar_psicometrico/{num_control}', [PsicometricoController::class, 'guardarPsicometrico'])->name('guardar_psicometrico.guardarPsicometrico');
Route::resource('menu-examen', ExamenesController::class)->names('menu-examen');
//permite hacer el registro para los alumnos de nuevo ingreso
Route::resource('registro', RegistroController::class)->names('registro');
Route::resource('examen', TestEconomicoController::class)->names('examen');
Route::resource('test_colores', OrderController::class)->names('test_colores');






//test
Route::resource('test', PruebasController::class)->names('tests');


Route::get('probar', function () {
    return view('docente_tutor.reportes_t_d');
});

Route::resource('reportes_tutor', ReportesController::class)->names('reportes_tutor');
//Auth::routes(['register' => false]);