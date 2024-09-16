<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
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


        $periodo_view = Periodo_view::find(1);
        $x = $periodo_view->Periodo;
        return $x;
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
