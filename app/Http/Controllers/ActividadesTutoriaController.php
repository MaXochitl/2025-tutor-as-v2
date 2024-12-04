<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Actividades_tutoria;
use App\Models\Asignacion_tutor;
use App\Models\Periodo;
use App\Models\Alumno;
use App\Models\File_format;
use App\Models\Periodo_tutorado;
use App\Models\User;



use Barryvdh\DomPDF\Facade as PDF; 

class ActividadesTutoriaController extends Controller
{
    
    
    public function create()
    {
        $id_tutor = Auth::user()->tutor->id; 
        return view('tutor-alumno.add-actividades', compact('id_tutor'));
    }

    
    public function pdfActividades()
{
    $user = User::find(Auth::user()->id);
    $tutor = Auth::user()->tutor;
    $actividades = Actividades_tutoria::all();
    $periodo = Periodo::max('id');
    $periodos = Periodo::orderby('id', 'desc')->get();
    $id = $user->tutor_id;    
    $asignado = Asignacion_tutor::where('periodo_id', $periodos->max('id'))
        ->where('tutor_id', $id)
        ->get();
    
    $alumnosTutorados = Periodo_tutorado::where('tutor_id', $id)
        ->where('periodo_id', $periodo)
        ->where('tipo', 1)  
        ->get();

    $alumnosIds = $alumnosTutorados->pluck('alumno_id');
    $alumnos = Alumno::whereIn('id', $alumnosIds)->get();    
    $hombres = $alumnos->where('sexo', 'M')->count();  
    $mujeres = $alumnos->where('sexo', 'F')->count();  
    $total = $hombres + $mujeres;
    $fileFormat = File_format::where('cargo', 'Coordinador del Programa Institucional de Tutorias')->first();
    $atentamente1 = $fileFormat->atentamente_1 ?? 'No disponible';
    

    $pdf = PDF::loadView('docente_tutor.actividadesPdf.pdf', [
        'actividades' => $actividades,
        'tutor' => $tutor,
        'asignado' => $asignado,
        'periodos' => $periodos,
        'periodo' => $periodo,
        'hombres' => $hombres,
        'mujeres' => $mujeres,
        'total' => $total,
        'atentamente1' => $atentamente1
    ]);

    return $pdf->stream('actividades_tutoria.pdf');
}


     

    
public function store(Request $request)
{
    
    $request->validate([
        'tema' => 'required|string|max:255',
        'descripcion_actividad' => 'required|string',
        'fecha' => 'required|date',
        'tiempo' => 'required|regex:/^([0-9]{1,2}):([0-9]{2})$/',  
        'recursos' => 'nullable|string',
    ]);

    
    list($horas, $minutos) = explode(':', $request->tiempo);

    
    $tiempo = sprintf("%02d:%02d:00", $horas, $minutos);

    
    $tutorId = Auth::user()->tutor->id;

    
    $actividad = Actividades_tutoria::create([
        'tema' => $request->tema,
        'descripcion_actividad' => $request->descripcion_actividad,
        'fecha' => $request->fecha,
        'tiempo' => $tiempo,  
        'recursos' => $request->recursos,
        'tutor_id' => $tutorId,
    ]);

    
    return redirect()->route('reportes_tutor.show', $actividad->id)
                     ->with('success', 'Actividad creada exitosamente.');
}



    
public function edit($id)
{
    $actividad = Actividades_tutoria::findOrFail($id);
    return view('actividades-tutoria.edit', compact('actividad'));
}


public function update(Request $request, $id)
{
    
    $actividad = Actividades_tutoria::findOrFail($id);

    
    $request->validate([
        'tema' => 'required|string|max:255',
        'descripcion_actividad' => 'required|string',
        'fecha' => 'required|date',
        'tiempo' => 'required|string',
        'recursos' => 'nullable|string',
    ]);

    
    $actividad->update($request->all());

    return redirect()->route('reportes_tutor.show', $actividad->id)
    ->with('success', 'Actividad eliminada exitosamente.');
}



    public function destroy($id)
    {
        $actividad = Actividades_tutoria::findOrFail($id); 
        $actividad->delete(); 

        return redirect()->route('reportes_tutor.show', $actividad->id)
                         ->with('success', 'Actividad eliminada exitosamente.');
    }
}
