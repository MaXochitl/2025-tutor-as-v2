<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Periodo;
use App\Models\Periodo_tutorado;

use App\Models\Periodo_tutorado_semaforo;
use App\Models\Semaforo;
use App\Models\Tutor;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Asignacion_tutor;
use App\Models\Aviso;
use App\Models\Periodo_eval;
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
        //return 'hola';
        $periodo = Periodo::max('id');
        $id_tutor = Auth::user()->tutor->id;

        $request->validate([
            'numero_control' => ['required']
        ]);

        $existe = Alumno::find($request->numero_control);

        if ($existe == null) {
            return redirect()->route('reportes_tutor.show', $id_tutor)->with('existe_alumno', 'no');
        }

        $alumno = Periodo_tutorado::where('alumno_id', $request->numero_control)
            ->where('periodo_id', $periodo)
            ->where('tutor_id', $id_tutor)
            ->count();

        if ($alumno == 0) {
            $alumno_add = Periodo_tutorado::create([
                'periodo_id' => $periodo,
                'tutor_id' => $id_tutor,
                'alumno_id' => $request->numero_control,
                'semestre' => $request->semestre,
                'status' => 1,
                'semaforo_id' => 4

            ]);
            return redirect()->route('reportes_tutor.show', $id_tutor);
        }

        return redirect()->route('reportes_tutor.show', $id_tutor)->with('hay_alumnos', 'si');
    }

    public function inserAlumno(Request $request, $tipo)
    {
        //return $tipo;
        $periodo = Periodo::max('id');
        $id_tutor = Auth::user()->tutor->id;

        $request->validate([
            'numero_control' => ['required']
        ]);


        $existe = Alumno::find($request->numero_control);

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

        $periodo = Periodo::orderby('id', 'desc')->get();
        $alumnos_tutor = [];


        if (count($periodo) > 0) {
            $alumnos_tutor = Periodo_tutorado::where('tutor_id', $id)
                ->where('periodo_id', $periodo[0]->id)
                ->where('tipo', 1)
                ->orderby('semaforo_id', 'desc')
                ->get();
        }

        $semaforo = Semaforo::where('id', '<', 5)->get();

        $asignado = Asignacion_tutor::where('periodo_id', $periodo->max('id'))
            ->where('tutor_id', $id)
            ->get();

        if (count($alumnos_tutor) == 0) {
            $tutor = Tutor::find($id);
            $id_carrera = $tutor->carrera->id;
            return view('tutor-alumno.tutor-alumnos', compact('alumnos_tutor', 'id_carrera', 'periodo'));
        } else {
            $hombres = $this->cuentaSexo($id, 'M', $periodo[0]->id);
            $mujeres = $this->cuentaSexo($id, 'F', $periodo[0]->id);
            $temporal = $this->cuentaBajas($id, 2, $periodo[0]->id);
            $baja = $this->cuentaBajas($id, 3, $periodo[0]->id);
            $verde = $this->cuentaColores($id, 1, $periodo[0]->id);
            $naranja = $this->cuentaColores($id, 2, $periodo[0]->id);
            $rojo = $this->cuentaColores($id, 3, $periodo[0]->id);
            $avisos = Aviso::all();
            $asigno = 1;
            if (count($asignado) == 0) {
                $asigno = 0;
            }
            return view('tutor-alumno.tutor-alumnos', compact('alumnos_tutor', 'semaforo', 'hombres', 'mujeres', 'baja', 'temporal', 'avisos', 'verde', 'naranja', 'rojo', 'periodo', 'asignado', 'asigno'));
        }
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
    public function update(Request $request, $id)
    {
    }


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

        return redirect()->route('alumnos-tutor.show', $tutorias->tutor_id);
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
        Periodo_tutorado::find($id)->delete();
        return redirect()->route('reportes_tutor.show', $id_tutor)->with('eliminar', 'ok');
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
}
