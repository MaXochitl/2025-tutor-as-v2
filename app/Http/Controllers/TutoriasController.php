<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Periodo;
use App\Models\Periodo_tutorado;

use App\Models\Periodo_tutorado_semaforo;
use App\Models\Semaforo;
use App\Models\Tutor;
use App\Models\User;
use App\Models\Atencion;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Asignacion_tutor;
use App\Models\Aviso;
use App\Models\Periodo_eval;
use App\Models\Periodo_semaforo;
use App\Models\Periodo_view;
use App\Models\Altera_entrega ;
use App\Providers\RouteServiceProvider;

class TutoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $periodo_eval = DB::table('periodos')->orderBy('id', 'desc')->get();
        $periodo = $periodo_eval[0];
        $id_tutor = Auth::user()->tutor->id;
        return view('tutor-alumno.add-alumno', compact('periodo', 'id_tutor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        // Este método quedó obsoleto.
        // Su lógica fue reemplazada por inserAlumno() porque maneja mejor
        // la validación, el tipo de alumno, la actualización de grupo
        // y el registro de indicaciones.

        return abort(410, 'El método store() está obsoleto. Usa inserAlumno().');
    }

    public function inserAlumno(Request $request, $tipo)
    {
        //return $tipo;
        $periodo = Periodo::max('id');
        $id_tutor = Auth::user()->tutor->id;

        // Validar según el tipo
        if ($tipo == 1) {
            $request->validate([
                'numero_control' => ['required'],
                'grupo' => ['required'], // obligatorio solo para tipo 1
            ]);
        } else {//canalizacion
            $request->validate([
                'numero_control' => ['required'],
            ]);
        }

        $existe = Alumno::whereRaw('BINARY id = ?', [$request->numero_control])->first();//tomar en cuenta mayus o minus

        if ($existe == null) {
            return redirect()->route('reportes_tutor.show', $id_tutor)->with('existe_alumno', 'no');
        }

        
        $alumno = Periodo_tutorado::where('alumno_id', $request->numero_control)
            ->where('periodo_id', $periodo)
            ->where('tutor_id', $id_tutor)
            ->where('tipo', $tipo)
            ->count();


        if ($alumno == 0) {
            $alumno_add = Periodo_tutorado::create([
                'periodo_id' => $periodo,
                'tutor_id' => $id_tutor,
                'alumno_id' => $request->numero_control,
                'semestre' => $request->semestre,
                'tipo' => $tipo,
                'status' => 1,
                'semaforo_id' => 4

            ]);

            // depues de agregar un alumno tutorado, aprovechar para actualizar el grupo en tabla 'alumno':
        if ($tipo == 1) { // Solo actualizar grupo si es tipo 1
            $alumno_actualizado = Alumno::find($request->numero_control);
            $alumno_actualizado->grupo = $request->grupo;
            $alumno_actualizado->save();
        }
            $this->addIndications($alumno_add->id);
            return redirect()->route('reportes_tutor.show', $id_tutor);
        }

        return redirect()->route('reportes_tutor.show', $id_tutor)->with('hay_alumnos', 'si');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //--------------------------------------------------------esta es la vista de los alumos de cada tutor del admin
        $palabra = '';
        $periodo_view = Periodo_view::find(1);
        $periodo = Periodo::find($periodo_view->periodo_id);
        //$periodo = $periodo_view->Periodo; // Periodo::orderby('id', 'desc')->get();
        $alumnos_tutor = [];

        $alumnos_tutor = Periodo_tutorado::where('tutor_id', $id)
            ->where('periodo_id', $periodo->id)
            ->where('tipo', 1)
            ->orderby('semaforo_id', 'desc')
            ->paginate(15);

        // Obtener alumnos del tipo docente para los tabs de Tutor y Docente
        $docente_alumno = Periodo_tutorado::where('periodo_id', $periodo->id)
            ->where('tipo', 2)
            ->orderby('semaforo_id', 'desc')
            ->get();

        //return $alumnos_tutor;
        $semaforo = Semaforo::where('id', '<', 5)->get();

        $asignado = Asignacion_tutor::where('periodo_id', $periodo->id)
            ->where('tutor_id', $id)
            ->get();

        if (count($alumnos_tutor) == 0) {
            $tutor = Tutor::find($id);
            $id_carrera = $tutor->carrera->id;
            return view('tutor-alumno.tutor-alumnos', compact('alumnos_tutor', 'id_carrera', 'periodo', 'palabra', 'docente_alumno', 'semaforo'));
        } else {
            $hombres = $this->cuentaSexo($id, 'M', $periodo->id);
            $mujeres = $this->cuentaSexo($id, 'F', $periodo->id);
            $temporal = $this->cuentaBajas($id, 2, $periodo->id);
            $baja = $this->cuentaBajas($id, 3, $periodo->id);
            $verde = $this->cuentaColores($id, 1, $periodo->id);
            $naranja = $this->cuentaColores($id, 2, $periodo->id);
            $rojo = $this->cuentaColores($id, 3, $periodo->id);
            $avisos = Aviso::all();
            $asigno = 1;
            if (count($asignado) == 0) {
                $asigno = 0;
            }

            // Construir arreglo de tutorados para el tab de Tutor
            $tutorado = [];
            if (count($alumnos_tutor) > 0) {
                foreach ($alumnos_tutor as $value) {
                    $tutorado[] = strtolower($value->alumno_id);
                }
            }

            // Obtener alumno_entrega para mostrar fechas
            $altera_entrega = Altera_entrega::find(1);

            return view('tutor-alumno.tutor-alumnos', compact(
                'alumnos_tutor',
                'semaforo',
                'hombres',
                'mujeres',
                'baja',
                'temporal',
                'avisos',
                'verde',
                'naranja',
                'rojo',
                'periodo',
                'asignado',
                'asigno',
                'palabra',
                'docente_alumno',
                'tutorado',
                'altera_entrega'
            ));
        }
    }


        public function showDocente($id)
    {

        $palabra = '';
        $periodo_view = Periodo_view::find(1);
        $periodo = Periodo::find($periodo_view->periodo_id);
        $alumnos_tutor = [];

        $alumnos_tutor = Periodo_tutorado::where('tutor_id', $id)
            ->where('periodo_id', $periodo->id)
            ->where('tipo', 2)
            ->orderby('semaforo_id', 'desc')
            ->paginate(15);

        $semaforo = Semaforo::where('id', '<', 5)->get();

        if (count($alumnos_tutor) == 0) {
            $tutor = Tutor::find($id);
            $id_carrera = $tutor->carrera->id;
            return view('docente-alumno.docente-alumnos', compact('alumnos_tutor', 'id_carrera', 'periodo', 'palabra'));
        } else {
            return view('docente-alumno.docente-alumnos', compact('alumnos_tutor', 'semaforo', 'periodo', 'palabra'));
        }
    }


    public function searchAlumnoTutorado(Request $request, $id)
    {
        $palabra = $request->search_tutor;
        $periodo_view = Periodo_view::find(1);
        $periodo = Periodo::find($periodo_view->periodo_id);

        // Obtener alumnos tutorados que coincidan con la búsqueda
        $alumnos_tutor = Periodo_tutorado::where('tutor_id', $id)
            ->where('periodo_id', $periodo->id)
            ->where('tipo', 1)
            ->whereHas('alumno', function ($query) use ($palabra) {
                $query->where('nombre', 'like', '%' . $palabra . '%')
                    ->orWhere('id', 'like', '%' . $palabra . '%')
                    ->orWhere('ap_paterno', 'like', '%' . $palabra . '%')
                    ->orWhere('ap_materno', 'like', '%' . $palabra . '%');
            })
            ->orderby('semaforo_id', 'desc')
            ->paginate(15);

        // Si no hay resultados en la búsqueda, devolver la vista normal sin filtro
        if (count($alumnos_tutor) == 0) {
            return redirect()->route('alumnos-tutor.show', $id);
        }

        // Obtener alumnos del tipo docente para los tabs de Tutor y Docente
        $docente_alumno = Periodo_tutorado::where('periodo_id', $periodo->id)
            ->where('tipo', 2)
            ->orderby('semaforo_id', 'desc')
            ->get();

        $semaforo = Semaforo::where('id', '<', 5)->get();

        $asignado = Asignacion_tutor::where('periodo_id', $periodo->id)
            ->where('tutor_id', $id)
            ->get();

        $hombres = $this->cuentaSexo($id, 'M', $periodo->id);
        $mujeres = $this->cuentaSexo($id, 'F', $periodo->id);
        $temporal = $this->cuentaBajas($id, 2, $periodo->id);
        $baja = $this->cuentaBajas($id, 3, $periodo->id);
        $verde = $this->cuentaColores($id, 1, $periodo->id);
        $naranja = $this->cuentaColores($id, 2, $periodo->id);
        $rojo = $this->cuentaColores($id, 3, $periodo->id);
        $avisos = Aviso::all();
        $asigno = 1;
        
        if (count($asignado) == 0) {
            $asigno = 0;
        }

        // Construir arreglo de tutorados para el tab de Tutor
        $tutorado = [];
        if (count($alumnos_tutor) > 0) {
            foreach ($alumnos_tutor as $value) {
                $tutorado[] = strtolower($value->alumno_id);
            }
        }

        // Obtener alumno_entrega para mostrar fechas
        $altera_entrega = Altera_entrega::find(1);

        return view('tutor-alumno.tutor-alumnos', compact(
            'alumnos_tutor',
            'semaforo',
            'hombres',
            'mujeres',
            'baja',
            'temporal',
            'avisos',
            'verde',
            'naranja',
            'rojo',
            'periodo',
            'asignado',
            'asigno',
            'palabra',
            'docente_alumno',
            'tutorado',
            'altera_entrega'
        ));
    }


    public function searchAlumnoDocente(Request $request, $id)
    {
        $palabra = $request->search_tutor;
        
        $periodo_view = Periodo_view::find(1);
        $periodo = Periodo::find($periodo_view->periodo_id);
        
        // BUSCAR SOLO ALUMNOS REPORTADOS POR DOCENTE (tipo = 2)
        $alumnos_tutor = Periodo_tutorado::where('tutor_id', $id)
            ->where('periodo_id', $periodo->id)
            ->where('tipo', 2)
            ->whereHas('alumno', function ($query) use ($palabra) {
                $query->where('nombre', 'like', "%$palabra%")
                    ->orWhere('id', 'like', "%$palabra%")
                    ->orWhere('ap_paterno', 'like', "%$palabra%")
                    ->orWhere('ap_materno', 'like', "%$palabra%");
            })
            ->orderby('semaforo_id', 'desc')
            ->paginate(15);

        // Si no hay resultados en la búsqueda, devolver la vista normal sin filtro
        if (count($alumnos_tutor) == 0) {
            return redirect()->route('alumnos-docente.show', $id);
        }

        $semaforo = Semaforo::where('id', '<', 5)->get();

        return view('docente-alumno.docente-alumnos', compact(
            'alumnos_tutor',
            'semaforo',
            'periodo',
            'palabra'
        ));
    }


    public function cuentaSexo($id, $sex, $periodo)
    {
        $suma = Periodo_tutorado::where('tutor_id', $id)
            ->where('periodo_id', $periodo)
            ->where('tipo', 1)
            ->join('alumnos', 'alumnos.id', '=', 'periodo_tutorado.alumno_id')
            ->where('alumnos.sexo', $sex)
            ->count();
        return $suma;
    }

    public function cuentaBajas($id, $staus, $periodo)
    {
        $suma = Periodo_tutorado::where('tutor_id', $id)
            ->where('periodo_id', $periodo)
            ->where('tipo', 1)
            ->where('status', $staus)
            ->count();

        return $suma;
    }

    public function cuentaColores($id, $color, $periodo)
    {
        $suma = Periodo_tutorado::where('tutor_id', $id)
            ->where('tipo', 1)
            ->where('periodo_id', $periodo)
            ->join('alumnos', 'alumnos.id', '=', 'periodo_tutorado.alumno_id')
            ->where('semaforo_id', $color)
            ->count();

        return $suma;
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
        return $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {}


    public function seguimiento(Request $request, $id, $mesSelect)
    {
        $tutorias = Periodo_tutorado::find($id);

        $now = new DateTime();
        date_default_timezone_set('America/Mexico_City');
        $fecha = date('Y-m-d', time()); //$fecha = date('Y-m-d H:i:s ', time()); //= $now->format('Y-m-d H:i:s'); //obtiene fecha actual
        //echo date('d/m/Y H:i:s', strtotime($alumnos->entrega_1));

        switch ($mesSelect) {
            case '1':
                $tutorias->mes_1 = $request->seguimiento;
                $tutorias->entrega_1 = $fecha;

                break;
            case '2':
                $tutorias->mes_2 = $request->seguimiento;
                $tutorias->entrega_2 = $fecha;

                break;
            case '3':
                $tutorias->mes_3 = $request->seguimiento;
                $tutorias->entrega_3 = $fecha;

                break;
            case '4':
                $tutorias->mes_4 = $request->seguimiento;
                $tutorias->entrega_4 = $fecha;

                break;
            case '5':
                $tutorias->reporte_final = $request->seguimiento;
                break;

            default:
                # code...
                break;
        }
        $tutorias->semaforo_id = $request->color;
        $tutorias->save();

        $this->saveHistLights($id, $mesSelect, $request->color);

        $id_tutor = Auth::user()->tutor->id;
        return redirect()->route('reportes_tutor.show', $id_tutor);
    }


    public function seguimientoOE(Request $request, $id, $mesSelect)
    {
        $tutorias = Periodo_tutorado::find($id);

        switch ($mesSelect) {
            case '1':
                $tutorias->oe_1 = $request->seguimiento;
                break;
            case '2':
                $tutorias->oe_2 = $request->seguimiento;
                break;
            case '3':
                $tutorias->oe_3 = $request->seguimiento;
                break;
            case '4':
                $tutorias->oe_4 = $request->seguimiento;
                break;
            default:
                # code...
                break;
        }

        $tutorias->save();

    // detectar la URL anterior (desde donde se envio el formulario)
    $previous = url()->previous();

    // si la peticion viene desde la vista de reportes_tutor MODULO DEL TUTOR (mis tutorados canalizados)
    if (str_contains($previous, 'reportes_tutor')) {
        // Redirigir a la misma vista (reportes_tutor.show)
        $user = Auth::user();
        return redirect()->route('reportes_tutor.show', $user->tutor_id)
            ->with('success', 'Seguimiento actualizado correctamente');
            echo('tutor');
    }
        // si no redirigir a alumnos-tutor.show MODULO DE OE
        return redirect()->route('alumnos-tutor.show', $tutorias->tutor_id);
    }


    public function saveHistLights($periodo_tutor, $semestre, $color)
    {
        $semaforo_update = Periodo_semaforo::where('periodo_id', $periodo_tutor)
            ->where('semestre', $semestre)
            ->first();

        if ($semaforo_update) {
            $semaforo_update->semaforo_id = $color; // Reemplaza con el nuevo valor
            $semaforo_update->save();
            echo "Registro actualizado correctamente.";
        } else {
            echo "No se encontró el registro con los valores proporcionados.";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $id_tutor = Auth::user()->tutor->id;
    
    // Obtener el registro antes de eliminarlo
    $periodo_tutorado = Periodo_tutorado::select('id', 'alumno_id', 'periodo_id')
        ->find($id);
    
    if (!$periodo_tutorado) {
        return redirect()->route('reportes_tutor.show', $id_tutor)
            ->with('error', 'Registro no encontrado');
    }
    
    // Verificar si existe una atención y eliminarla
    $atencion = Atencion::where('alumno_id', $periodo_tutorado->alumno_id)
        ->where('periodo_id', $periodo_tutorado->periodo_id)
        ->first();
    
    if ($atencion) {
        $atencion->delete();
    }
    
    // Eliminar el registro de periodo_tutorado
    $periodo_tutorado->delete();
    
    return redirect()->route('reportes_tutor.show', $id_tutor)
        ->with('eliminar', 'ok');
    }

    public function baja($id, $staus, $color)
    {
        $tutorias = Periodo_tutorado::find($id);
        $alumno = Alumno::find($tutorias->alumno_id);
        $alumno->estado = $staus;
        $alumno->save();
        $tutorias->status = $staus;
        $tutorias->semaforo_id = $color;
        $tutorias->save();
        return redirect()->route('alumnos-tutor.show', $tutorias->tutor_id);
    }

    public function addIndications($periodo_id)
    {
        $registros = [];

        for ($i = 0; $i < 5; $i++) {
            $registros[] = [
                'periodo_id' => $periodo_id,
                'semaforo_id' => 4,
                'semestre' => $i + 1
            ];
        }

        Periodo_semaforo::insert($registros);
    }


    public function deleteHistLight($periodo_tutor)
    {

        $registrosAEliminar = Periodo_semaforo::where('periodo_id', $periodo_tutor)->get();

        if ($registrosAEliminar->count() > 0) {
            // Eliminar los registros encontrados
            foreach ($registrosAEliminar as $registro) {
                $registro->delete();
            }

            // Mensaje de éxito
            echo "Registros eliminados correctamente.";
        } else {
            // No se encontraron registros para eliminar
            echo "No se encontraron registros con el periodo_id proporcionado.";
        }
    }
    public function getPeriodoView()
    {
        $periodo_view = Periodo_view::find(1);
        $periodo = Periodo::find($periodo_view->periodo_id);
        $response[0] = $periodo->inicio;
        $response[1] = $periodo->fin;
        return $response;
    }
}
