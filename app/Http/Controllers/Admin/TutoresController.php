<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asignacion_tutor;
use App\Models\Tutor;
use App\Models\Carrera;
use App\Models\User;
use App\Models\Periodo_View;
use App\Models\Periodo;
use App\Models\Periodo_Tutorado;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TutoresController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:solo.admin')->only('index');
    }

    public function index()
    {
        $tutores = Tutor::orderBy('carrera_id')->get();
        return view('admin.tutorias.lista_tutores', compact('tutores'));
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
        $carrera = $id;
        $palabra = '';

        // Obtener todos los tutores de la carrera
        $tutores = Tutor::where('carrera_id', $id)->get();

        // Obtener el ultimo periodo
        $periodoView = Periodo_view::find(1);
        $periodo = Periodo::find($periodoView->periodo_id);

        // Clasificar tutores (verificar quienes seran tutores y quienes docentes)
        $tutoresDePeriodo = collect();
        $docentes = collect();

        foreach ($tutores as $tutor) {
            if ($this->esTutorActivo($tutor, $periodo)) {//si existe un periodo_tutorado vinculado al tutor (guardar)
                $tutoresDePeriodo->push($tutor);
            }elseif ($this->esTutorAsignado($tutor, $periodo)) {//si existe un Asignacion_tutor vinculado al tutor (guardar)
                $tutoresDePeriodo->push($tutor);
            }
        }

        $docentes = $tutores->diff($tutoresDePeriodo);//tutores restantes son docentes (guardar)

        return view('admin.tutorias.home', compact(
            'tutoresDePeriodo',
            'docentes',
            'carrera',
            'palabra'
        ));
    }

    /**
     * Verifica si un tutor tiene alumnos tutorados en el período actual
     * Se considera tutor si el docente se asigno alumnos
     */
    private function esTutorActivo($tutor, $periodo)
    {
        return Periodo_tutorado::where('tutor_id', $tutor->id)
            ->where('periodo_id', $periodo->id)
            ->where('tipo', 1)
            ->exists();
    }

    /**
     * Verifica si un tutor está asignado en el período actual
     * Se considera tutor si OE le asigno al docente uno o +grupos
     */
    private function esTutorAsignado($tutor, $periodo)
    {
        return Asignacion_tutor::where('tutor_id', $tutor->id)
            ->where('periodo_id', $periodo->id)
            ->where('semestre', '!=', '0')           // semestre NO debe ser "0"
            ->where('grupo', '!=', 'sin asignar')    // grupo NO debe ser "sin asignar"
            ->exists();
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find(Auth::user()->id);
        $id = $user->tutor_id;

        $tutores = Tutor::find($id);
        $carreras = Carrera::orderBy('id', 'desc')->get();
        return view('admin.tutorias.editar', compact('tutores', 'carreras'));
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
        $user = User::find(Auth::user()->id);
        $id = $user->tutor_id;

        $tutores = Tutor::find($id);
        //$tutores->id = $request->input('matricula');
        $tutores->nombre = $request->input('nombre');
        $tutores->ap_paterno = $request->input('ap_paterno');
        $tutores->ap_materno = $request->input('ap_materno');
        $tutores->telefono = $request->input('telefono');
        $tutores->domicilio = $request->input('domicilio');

        $now = new DateTime();
        $fecha = $now->format('Ymd-His'); //obtiene fecha actual
        $nombre = "";
        $imagen = $request->file('foto'); //obtencion de la imagen

        if ($request->has("carrera")) {
            $tutores->carrera_id = $request->input('carrera');
        }

        if ($request->pass !== null) {
            $user->password = Hash::make($request->pass);
        }

        if ($imagen) {
            $extension = $imagen->getClientOriginalExtension(); //obtiene la extencion
            $nombre = "/tutores/tutor" . "-" . $fecha . "." . $extension; //genera nombre del archivo
            $imagen->move('tutores', $nombre);
            $borrar = public_path() . $tutores->foto;
            if (@getimagesize($borrar)) {
                unlink($borrar);
            }
            $tutores->foto = $nombre;
        }


        $tutores->save();
        $user->save();
        return back()->with('editado', 'ok');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Tutor::find($id)->delete();
        return back()->with('eliminar', 'ok');
    }
    public function resetPass($id)
    {
        $tutor = Tutor::find($id);
        $user = User::find($tutor->user->id);
        $user->password = Hash::make('tutor123');
        $user->save();
        return back()->with('reset', 'ok');
    }

    //editarlo
    public function searchTutor(Request $request, $carrera)
    {
        $palabra = $request->search_tutor;

        // Obtener tutores que coincidan con el texto buscado
        $tutores = Tutor::where('carrera_id', $carrera)
            ->where(function ($q) use ($palabra) {
                $q->where('nombre', 'LIKE', "%$palabra%")
                ->orWhere('ap_paterno', 'LIKE', "%$palabra%")
                ->orWhere('ap_materno', 'LIKE', "%$palabra%");
            })
            ->get();

        // Obtener periodo actual
        $periodoView = Periodo_view::find(1);
        $periodo = Periodo::find($periodoView->periodo_id);

        // Clasificar resultados
        $tutoresDePeriodo = collect();
        $docentes = collect();

        foreach ($tutores as $tutor) {
            if ($this->esTutorActivo($tutor, $periodo) || $this->esTutorAsignado($tutor, $periodo)) {
                $tutoresDePeriodo->push($tutor);
            } else {
                $docentes->push($tutor);
            }
        }

        return view('admin.tutorias.home', compact(
            'tutoresDePeriodo',
            'docentes',
            'carrera',
            'palabra'
        ));
    }

}
