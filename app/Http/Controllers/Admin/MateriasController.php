<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Materia;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Database\QueryException;
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

        $carrera_id = null; // valor por defecto

        if ($tutor && $tutor->carrera_id != null) {
            $carrera_id = $tutor->carrera_id;
            $materias = Materia::where('carrera_id', $carrera_id)
                ->orderby('carrera_id', 'asc')
                ->orderby('semestre', 'asc')
                ->paginate(10);
        } else {
            // para el admin 
            $materias = Materia::orderby('carrera_id', 'asc')
                ->orderby('semestre', 'asc')
                ->paginate(10);
        }

        return view('admin.materias.materias', compact('materias', 'palabra', 'carrera_id'));
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
            'materia' => ['required'],
            'clave' => ['required'],
            'carrera' => ['required'],
            'semestre' => ['required'],
        ]);

        // Verificar si ya existe una materia con la misma clave en la misma carrera
        $existe = Materia::where('clave', $request->clave)
                    ->where('carrera_id', $request->carrera)
                    ->exists();

        if ($existe) {
            return back()->with('error', 'La clave ya existe, intenta con otra.');
        }

        Materia::create([
            'nombre' => $request->materia,
            'semestre' => $request->semestre,
            'carrera_id' => $request->carrera,
            'clave' => $request->clave
        ]);

        return redirect()->route('materia.index')->with('success', 'Materia registrada correctamente.');
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
        // validar campos requeridos
        $request->validate([
            'materia' => ['required'],
            'clave' => ['required'],
        ]);

        // buscar si ya existe otra materia con la misma clave en la misma carrera
        $existe = Materia::where('clave', $request->clave)
            ->where('carrera_id', $request->carrera)
            ->where('id', '!=', $id) // excluir el registro actual
            ->exists();

        if ($existe) {
            return back()->with('error', 'La clave ya existe, intenta con otra.');
        }

        // actualizar registro de una
        $materia = Materia::findOrFail($id);
        $materia->update([
            'nombre' => $request->materia,
            'semestre' => $request->semestre,
            'carrera_id' => $request->carrera,
            'clave' => $request->clave,
        ]);

        return redirect()->route('materia.index')->with('success', 'Materia actualizada correctamente.');
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
                ->paginate(10);
        }
        return view('admin.materias.materias', compact('materias', 'palabra'));
    }
}
