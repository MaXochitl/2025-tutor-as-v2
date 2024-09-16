<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asignacion_tutor;
use App\Models\Tutor;
use App\Models\Carrera;
use App\Models\User;
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
        //el $id es el id de la carrera al que pertenecen los tutores
        //$tutores = Tutor::all()->where('carrera_id', $id);
        $tutores = Tutor::where('carrera_id', $id)->paginate(15);

        return view('admin.tutorias.home', compact('tutores', 'carrera', 'palabra'));
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

        if ($request->has("carrrera")) {
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

    public function searchTutor(Request $request, $carrera)
    {
        $tutores = Tutor::where('carrera_id', $carrera)
            ->where('nombre', 'LIKE', '%' . $request->search_tutor . '%')
            ->paginate(15);

        $palabra = $request->search_tutor;

        return view('admin.tutorias.home', compact('tutores', 'carrera', 'palabra'));
    }
}
