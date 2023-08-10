<?php

namespace App\Http\Controllers;

use App\Imports\ImportAlumnos;
use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class AlumnosController extends Controller
{

    /*
    public function __construct()
    {
        $this->middleware(['auth', 'can:solo.admin'])->only('index');
    }
    ¨*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $palabra = '';
        $alumnos = Alumno::orderBy('carrera_id')
            ->orderBy('grupo', 'asc')
            ->paginate(20);

        return view('alumnos.alumnos', compact('alumnos','palabra'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $carreras = Carrera::all();

        return view('alumnos.nuevo', compact('carreras'));
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

        $request->validate([
            'ncontrol' => ['required'],
            'nombre' => ['required'],
            'ap_paterno' => ['required'],
            'ap_materno' => ['required'],
            'nacimiento' => ['required'],
            'domicilio' => ['required'],
            'telefono' => ['required'],
            'correo' => ['required'],

        ]);

        $alumno = Alumno::find($request->ncontrol);
        if ($alumno != null) {
            return redirect()->route('alumnos.index')->with('creado', 'no');
        }
        Alumno::create([
            'id' => $request->ncontrol,
            'nombre' => $request->nombre,
            'ap_paterno' => $request->ap_paterno,
            'ap_materno' => $request->ap_materno,
            'sexo' => $request->sexo,
            'fecha_nacimiento' => $request->nacimiento,
            'domicilio' => $request->domicilio,
            'grupo' => $request->grupo,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'estado' => 1,
            'carrera_id' => $request->carrera

        ]);
        $user = User::find(Auth::user()->id);

        return redirect()->route('alumnos.index')->with('creado', 'si');
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
        $alumnos = Alumno::findOrFail($id);
        // return $tutores;

        $carreras = Carrera::orderBy('id', 'desc')->get();
        return view('alumnos.editar', compact('alumnos', 'carreras'));
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
        $alumnos = Alumno::find($id);
        $alumnos->id = $request->input('ncontrol');
        $alumnos->nombre = $request->input('nombre');
        $alumnos->ap_paterno = $request->input('ap_paterno');
        $alumnos->ap_materno = $request->input('ap_materno');
        $alumnos->fecha_nacimiento = $request->input('nacimiento');
        $alumnos->domicilio = $request->input('domicilio');
        $alumnos->telefono = $request->input('telefono');
        $alumnos->correo = $request->input('correo');
        $alumnos->grupo = $request->grupo;
        $alumnos->sexo = $request->sexo;
        $alumnos->estado = $request->estado;
        $alumnos->carrera_id = $request->carrera;

        $alumnos->save();
        return redirect()->route('alumnos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Alumno::find($id)->delete();
        return redirect()->route('alumnos.index')->with('eliminar', 'ok');
        //
    }

    public function importAlumnos(Request $request)
    {
        //return $request->file('file');
        $file = $request->file('file');
        Excel::import(new ImportAlumnos, $file);
        return back();
    }

    public function searchAlumno(Request $request)
    {
        $palabra = $request->busqueda;
        $alumnos = Alumno::where('nombre', 'LIKE', '%' . $palabra . '%')
            ->orderBy('carrera_id')
            ->orderBy('grupo', 'asc')
            ->paginate(20);

        return view('alumnos.alumnos', compact('alumnos','palabra'));
    }
}
