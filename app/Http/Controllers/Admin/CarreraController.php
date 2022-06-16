<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $carreras = Carrera::all();
        //return redirect()->route('orientacion.index', compact('carreras'));
        return view('admin.carreras.carreras', compact('carreras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.carreras.nuevo');
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
            'carrera' => ['required']
        ]);

        //cambiar nombre y guarda archivo
        $now = new DateTime();
        $fecha = $now->format('Ymd-His'); //obtiene fecha actual
        $icono = "";
        $fondo = "";
        $imagen = $request->file('icono'); //obtencion de la imagen
        $imagen2 = $request->file('fondo'); //obtencion de la imagen

        if ($imagen) {
            $extension = $imagen->getClientOriginalExtension(); //obtiene la extencion
            $icono = "/img_carrera/icon" . "-" . $fecha . "." . $extension; //genera nombre del archivo
            //Storage::disk('local')->put($nombre,File::get($imagen)); //sube archivo a la ruta archivos
            $imagen->move('img_carrera', $icono);
        }

        if ($imagen2) {
            $extension = $imagen2->getClientOriginalExtension(); //obtiene la extencion
            $fondo = "/img_carrera/back" . "-" . $fecha . "." . $extension; //genera nombre del archivo
            //Storage::disk('local')->put($nombre,File::get($imagen)); //sube archivo a la ruta archivos
            $imagen2->move('img_carrera', $fondo);
        }
        //inserta un nuevo registro de carrera a la base de datos 
        Carrera::create([
            'nombre_carrera' => $request->carrera,
            'icono' => $icono,
            'fondo' => $fondo
        ]);

        return redirect()->route('orientacion.index');
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

        $request->validate([
            'carrera' => ['required']
        ]);

        //cambiar nombre y guarda archivo
        $now = new DateTime();
        $fecha = $now->format('Ymd-His'); //obtiene fecha actual
        $icono = "";
        $fondo = "";
        $imagen = $request->file('icono'); //obtencion de la imagen
        $imagen2 = $request->file('fondo'); //obtencion de la imagen


        $carrera = Carrera::find($id);
        $carrera->nombre_carrera = $request->carrera;
        if ($imagen) {
            $extension = $imagen->getClientOriginalExtension(); //obtiene la extencion
            $icono = "/img_carrera/icon" . "-" . $fecha . "." . $extension; //genera nombre del archivo
            $imagen->move('img_carrera', $icono);
            $carrera->icono = $icono;
        }

        if ($imagen2) {
            $extension = $imagen2->getClientOriginalExtension(); //obtiene la extencion
            $fondo = "/img_carrera/back" . "-" . $fecha . "." . $extension; //genera nombre del archivo
            $imagen2->move('img_carrera', $fondo);
            $carrera->fondo = $fondo;
        }
        $carrera->save();

        return redirect()->route('carrera.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carrera = Carrera::find($id);

        if (count($carrera->tutores) != 0) {
            return redirect()->route('carrera.index')->with('eliminar', 'no');
        } else {
            //extrae la ruta de la imagen
            $icono = public_path() . $carrera->icono;
            $fondo = public_path() . $carrera->fondo;
            //valida si se encuentra la imagen
            if (@getimagesize($fondo)) {
                //alimina la imagen usando el archivo filesystem
                //Storage::disk('pub')->delete($carrera->fondo);
                unlink(public_path($carrera->fondo)); 
            }
            if (@getimagesize($icono)) {
                //Storage::disk('pub')->delete($carrera->icono);
                unlink(public_path($carrera->icono)); 

            }
            $carrera->delete();
            return redirect()->route('carrera.index')->with('eliminar', 'ok');
        }
    }
}
