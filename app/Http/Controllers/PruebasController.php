<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AsignacionesController;
use App\Models\Alumno;
use App\Models\Asignacion_tutor;
use App\Models\Aviso;
use App\Models\Carrera;
use App\Models\Evaluacion_respuesta;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Periodo_semaforo;
use App\Models\Periodo_tutor;
use App\Models\Periodo_tutorado;
use App\Models\Periodo_view;
use App\Models\Posicion;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\Tutor;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PruebasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $path=public_path() . '\tutores\tecnologico.jpg';

        return $path;

        $periodo = 3;

        $tutores = DB::select('CALL ResumenRegistros(?)', [$periodo]);
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
        return $tutores;
    }

    public function addIndications($periodo_id) {}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role_auditor = Role::create(['name' => 'auditor']);
        $permiso_admin_auditor = Permission::create(['name' => 'auditor.admin']);
        Permission::create(['name' => 'auditor'])->syncRoles([$role_auditor]);
        //$permiso=Permission::whereIn('name', ['admin.tutor'])->get();
        //$role = Role::find(3);
        $role_auditor->givePermissionTo($permiso_admin_auditor);
        //        return $role;

        //$permiso->syncRoles([$role]);
        return 'success';
        //        $permisos = Permission::whereIn('name', ['tutorias.home', 'show.date'])->get();


        $roles = Role::all();
        $permissions = Permission::all();
        $permisos = Permission::whereIn('name', ['tutorias.home', 'show.date'])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($num_control) {}

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
