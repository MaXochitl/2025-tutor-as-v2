<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $busqueda = $request->busqueda;
        $users = User::where('name', 'LIKE', '%' . $busqueda . '%')->paginate(2);
        $roles = Role::all();
        //return $users;
        return view('admin.users.users', compact('users', 'roles'));
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

        $tutor = Tutor::find($request->matricula);

        if ($tutor != null) {
            return back()->with('create', 'no');
        } else {

            $tutor = Tutor::create([
                'id' => $request->matricula,
                'nombre' => $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'telefono' => $request->telefono,
                'sexo' => $request->sexo,
                'domicilio' => $request->domicilio,
                'foto' => '/tutores/tutor-20220226-220319.png'
            ]);
            $user = User::create([
                'name' => $request->nombre,
                'email' => $request->correo,
                'password' => Hash::make($request->password),
                'tutor_id' => $request->matricula //$tutor_b[0]->id
            ])->assignRole('auditor');
            return back()->with('create','ok');
        }
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
