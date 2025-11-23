<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Periodo_view;
use App\Models\Periodo;
use App\Models\Periodo_tutorado;
use App\Models\Semaforo;

class DocenteController extends Controller
{
    /**
     * Metodo para mostrar las canalizaciones de cierto docente
     * del ultimo periodo. SOLO ADMI.
     */
    public function showDocente($id)
    {

        $palabra = '';
        $periodo_view = Periodo_view::find(1);
        $periodo = Periodo::find($periodo_view->periodo_id);
        $alumnos_tutor = [];

        $alumnos_tutor = Periodo_tutorado::where('tutor_id', $id)
            ->where('periodo_id', $periodo->id)
            ->where('tipo', 2)
            ->orderby('semaforo_id', 'desc')
            ->paginate(15);

        $semaforo = Semaforo::where('id', '<', 5)->get();

        if (count($alumnos_tutor) == 0) {
            $tutor = Tutor::find($id);
            $id_carrera = $tutor->carrera->id;
            return view('docente-alumno.docente-alumnos', compact('alumnos_tutor', 'id_carrera', 'periodo', 'palabra'));
        } else {
            return view('docente-alumno.docente-alumnos', compact('alumnos_tutor', 'semaforo', 'periodo', 'palabra'));
        }
    }


    /**
     * Metodo para buscar por id o nombre del alumno
     * Mejorarlo en proximas actualizaciones para cuando
     * no encuentre coincidencias. SOLO ADMI.
     */
    public function searchAlumnoDocente(Request $request, $id)
    {
        $palabra = $request->search_tutor;
        
        $periodo_view = Periodo_view::find(1);
        $periodo = Periodo::find($periodo_view->periodo_id);
        
        // BUSCAR SOLO ALUMNOS REPORTADOS POR DOCENTE (tipo = 2)
        $alumnos_tutor = Periodo_tutorado::where('tutor_id', $id)
            ->where('periodo_id', $periodo->id)
            ->where('tipo', 2)
            ->whereHas('alumno', function ($query) use ($palabra) {
                $query->where('nombre', 'like', "%$palabra%")
                    ->orWhere('id', 'like', "%$palabra%")
                    ->orWhere('ap_paterno', 'like', "%$palabra%")
                    ->orWhere('ap_materno', 'like', "%$palabra%");
            })
            ->orderby('semaforo_id', 'desc')
            ->paginate(15);

        // Si no hay coincidencias, devolver la vista normal sin filtro. Mejorar aqui.
        if (count($alumnos_tutor) == 0) {
            return redirect()->route('alumnos-docente.show', $id);
        }

        $semaforo = Semaforo::where('id', '<', 5)->get();

        return view('docente-alumno.docente-alumnos', compact(
            'alumnos_tutor',
            'semaforo',
            'periodo',
            'palabra'
        ));
    }

}