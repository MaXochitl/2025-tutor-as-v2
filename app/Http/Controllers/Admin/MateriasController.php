<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Materia;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::find(Auth::user()->id);
        $id = $user->tutor_id;
        $tutor = Tutor::find($id);
        $palabra = '';

        $carrera = $tutor->carrera;

        if ($tutor->carrera_id != null) {
            $carrera = $carrera->id;
            $materias = Materia::where('carrera_id', $carrera)
                ->orderby('carrera_id', 'asc')
                ->orderby('semestre', 'asc')
                ->paginate(10);
        } else {
            $materias = Materia::orderby('carrera_id', 'asc')
                ->orderby('semestre', 'asc')
                ->paginate(10);
        }


        return view('admin.materias.materias', compact('materias', 'palabra'));
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
        return view('admin.materias.nuevo', compact('carreras'));
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
            'materia' => ['required']
        ]);
        Materia::create([
            'nombre' => $request->materia,
            'semestre' => $request->semestre,
            'carrera_id' => $request->carrera
        ]);
        return redirect()->route('materia.index');
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
        $materia = Materia::find($id);
        $materia->nombre = $request->materia;
        $materia->semestre = $request->semestre;
        $materia->carrera_id = $request->carrera;
        $materia->save();
        return redirect()->route('materia.index');
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
        Materia::destroy($id);
        return redirect()->route('materia.index')->with('eliminar', 'ok');
    }

    public function searchMateria(Request $request)
    {

        $user = User::find(Auth::user()->id);
        $id = $user->tutor_id;
        $tutor = Tutor::find($id);

        $carrera = $tutor->carrera;
        $palabra = $request->busqueda;

        if ($tutor->carrera_id != null) {
            $carrera = $carrera->id;
            $materias = Materia::where('nombre', 'LIKE', '%' . $palabra . '%')
                ->where('carrera_id', $carrera)
                ->orderby('carrera_id', 'asc')
                ->orderby('semestre', 'asc')
                ->paginate(10);
        } else {
            $materias = Materia::where('nombre', 'LIKE', '%' . $palabra . '%')
                ->orderby('carrera_id', 'asc')
                ->orderby('semestre', 'asc')
                ->paginate(5);
        }
        return view('admin.materias.materias', compact('materias', 'palabra'));
    }
}
