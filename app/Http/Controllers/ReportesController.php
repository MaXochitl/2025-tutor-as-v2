<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Alumno;
use App\Models\Periodo;
use App\Models\Periodo_tutorado;

use App\Models\Periodo_tutorado_semaforo;
use App\Models\Semaforo;
use App\Models\Tutor;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Altera_entrega;
use App\Models\Asignacion_tutor;
use App\Models\Aviso;
use App\Models\Periodo_eval;
use App\Providers\RouteServiceProvider;

class ReportesController extends Controller
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

        $user = User::find(Auth::user()->id);
        $id = $user->tutor_id;
        
        //Agregar llamado de base de datos  
        $actividades = Actividades_tutoria::all();
        //        

        $periodo = Periodo::orderby('id', 'desc')->get();
        $alumnos_tutor = [];


        if (count($periodo) > 0) {
            $alumnos_tutor = Periodo_tutorado::where('tutor_id', $id)
                ->where('periodo_id', $periodo[0]->id)
                ->where('tipo', 1)
                ->orderby('semaforo_id', 'desc')
                ->get();

            $docente_alumno = Periodo_tutorado:: //where('tutor_id', $id)
                where('periodo_id', $periodo[0]->id)
                ->where('tipo', 2)
                ->orderby('semaforo_id', 'desc')
                ->get();

            if (count($alumnos_tutor) == 0) {
                $tutorado = null;
            } else {
                foreach ($alumnos_tutor as $key => $value) {
                    $tutorado[] = strtolower($value->alumno_id);
                }
            }
            //return $tutorado;
        } else {
            return view('docente_tutor.reportes_t_d', compact('periodo'));
        }

        $semaforo = Semaforo::where('id', '<', 5)->get();

        $asignado = Asignacion_tutor::where('periodo_id', $periodo->max('id'))
            ->where('tutor_id', $id)
            ->get();

        $tutor = Tutor::find($id);
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
        $altera_entrega = Altera_entrega::find(1);

        return view('docente_tutor.reportes_t_d', compact(
            'alumnos_tutor',
            'semaforo',
            'baja',
            'temporal',
            'avisos',
            'verde',
            'naranja',
            'rojo',
            'periodo',
            'asignado',
            'asigno',
            'tutor',
            'docente_alumno',
            'tutorado',
            'altera_entrega',
            //asignarlo en return
            'actividades'
            //
        ));
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
    }
    public function cuentaBajas($id, $staus, $periodo)
    {
        $suma = Periodo_tutorado::where('tutor_id', $id)
            ->where('tipo', 1)
            ->where('periodo_id', $periodo)
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
}
