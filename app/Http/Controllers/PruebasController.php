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

        //  $periodo = Periodo_tutorado::max('id');
        /*
        Periodo_semaforo::create([
            'periodo_id' => $periodo,
            'semaforo_id' => 8,
            'semestre' => 4
        ]);
*/

        $alumnos = Periodo_tutorado::all();

        foreach ($alumnos as $value) {
            $this->addIndications($value->id);
        }

        return view('test.test', compact('alumnos'));
    }

    public function addIndications($periodo_id)
    {
        $registros = [];

        for ($i = 0; $i < 5; $i++) {
            $registros[] = [
                'periodo_id' => $periodo_id,
                'semaforo_id' => 4,
                'semestre' => $i + 1
            ];
        }

        Periodo_semaforo::insert($registros);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        //$role_auditor=Role::create(['name'=>'auditor']);
        $permiso_admin_auditor = Permission::create(['name' => 'auditor.admin']);
        //Permission::create(['name'=>'auditor'])->syncRoles([$role_auditor]);
        //$permiso=Permission::whereIn('name', ['admin.tutor'])->get();
        $role = Role::find(3);
        $role->givePermissionTo($permiso_admin_auditor);
        //        return $role;

        //$permiso->syncRoles([$role]);
        return 'success';
        //        $permisos = Permission::whereIn('name', ['tutorias.home', 'show.date'])->get();


        $roles = Role::all();
        $permissions = Permission::all();
        $permisos = Permission::whereIn('name', ['tutorias.home', 'show.date'])->get();


        //      return $permisos;
        /*
        Tutor::create([
            'matricula'=>'Admin001',
            'carrera_id'=>1,
            'nombre'=>'Admin1',
            'ap_paterno'=>'Admin1',
            'ap_materno'=>'admin1',
            'sexo'=>'M',
            'domicilio'=>'Las casitas'
        ]);
        */
        // view('test.test_tutor',compact('tutor'));
        //


        /** ________________crear una carrera*/
        /*
        Carrera::create([
            'nombre_carrera'=>'ING Industrial'
        ]);
        */

        /*____________relacion user_tutor terminado_________*/
        //return User::find(1)->tutor;
        //$user=User::find(1);
        //return $user->tutor;
        /**(relacion_tutor_carrera) */
        //return Tutor::find('Admin003')->carrera;

        /*_____________Crear nuevo aviso____________*/
        /*
        Aviso::create([
            'titulo' => 'Aviso',
            'aviso' => 'se avisa que el aviso no fue avisado',
            'destinatario' => 'all'
        ]);
        */


        //*--------------insert materia*/
        /*
        Materia::create([
            'nombre'=>'Quimica'
        ]);*/


        /**______________________creacion de periodo_____________ */
        /*
        Periodo::create([
            'inicio'=>'2021-08-15',
            'fin'=>'2022-01-15',
            'mes_1'=>'2021-09-04 11:59:00',
            'mes_2'=>'2021-10-04 11:59:00',
            'mes_3'=>'2021-11-04 11:59:00',
            'mes_4'=>'2021-12-04 11:59:00'
        ]);
        */

        /**______________________________insertar alumnos_________________________ */

        /*
        Alumno::create([
            'id' => '173S0012',
            'nombre' => 'Joshua',
            'ap_paterno' => 'Lopez',
            'ap_materno' => 'santana',
            'sexo' => 'F',
            'fecha_nacimiento' => '1990-05-27',
            'domicilio' => 'Colonia la reforma',
            'grupo' => 'A',
            'telefono' => '7891231234',
            'correo' => 'alumno@itsta.edu.mx',
            'carrera_id' => 1
        ]);
        */

        /**________________________________ */

        /**_______________________________create control_materia */
        /*
        Control_materia::create([
            'periodo_id'=>1,
            'mes'=>1,
            'materia_id'=>1,
            'alumno_id'=>'173S0019'
        ]);
        */

        /*
        $control_materias=Control_materia::all();
        return view('test.testd',compact('control_materias'));
        */

        /**__________________periodo tutorado_____________ */
        /*
        Periodo_tutor::create([
            'periodo_id'=>1,
            'tutor_id'=>'Admin001',
            'alumno_id'=>'173S0019',
            'semestre'=>1
        ]);
        */
        /*
        $periodo_tutor=Periodo_tutor::all();
        return view('test.test_p_t',compact('periodo_tutor'));
        */
        /*
        Alumno::create([
            'id' => '173S0012',
            'nombre' => 'Joshua',
            'ap_paterno' => 'Lopez',
            'ap_materno' => 'santana',
            'sexo' => 'F',
            'fecha_nacimiento' => '1990-05-27',
            'domicilio' => 'Colonia la reforma',
            'grupo' => 'A',
            'telefono' => '7891231234',
            'correo' => 'alumno@itsta.edu.mx',
            'carrera_id' => 1
        ]);

         Alumno::create([
            'id' => '173S0019',
            'nombre' => 'Robert',
            'ap_paterno' => 'Yozhua',
            'ap_materno' => 'Hd',
            'sexo' => 'm',
            'fecha_nacimiento' => '1990-05-27',
            'domicilio' => 'Tantoyuca',
            'grupo' => 'B',
            'telefono' => '7891231234',
            'correo' => 'alumnos@itsta.edu.mx',
            'carrera_id' => 1
        ]);
*/

        //$tutor = Tutor::all(); // find('173S0012');
        // $tutor=Alumno::find('173S0019');
        //return $tutor;

        /*

        DB::insert("insert into posiciones(
            alumno_id,
            color_id,
            posicion
        )values
        ('1730012',1,1),
        ('1730012',2,2),
        ('1730012',3,3),
        ('1730012',4,4),
        ('1730012',5,5),
        ('1730012',6,6),
        ('1730012',7,7),
        ('1730012',8,8);");
*/
        /*
        $positions = Posicion::all()->where('alumno_id','173S0019')->sortBy('posicion');

        return view('test.testcolores',compact('positions'));
    */
        $evalua = Evaluacion_respuesta::all();

        return view('test.test_respuestas', compact('evalua'));

        //return "grated";
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
        //$carreras = Carrera::all()->where('nombre_carrera', $request->carrera);

        //return $carreras;
        return $request;
        //return view('test.testAddMatter', compact('request'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($num_control)
    {
        //

        //$resultado = Resultado::where('alumno_id', $num_control)->where('periodo_eval_id', $periodo_evaluacion[0]->id)->get(); //;

        $seccion1 = Evaluacion_respuesta::where('alumno_id', $num_control)
            ->join('respuestas', 'respuestas.id', '=', 'evaluacion_respuesta.respuesta_id')
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 1)
            ->where('preguntas.seccion', 1)
            ->sum('respuestas.valor');

        $seccion2 = Evaluacion_respuesta::where('alumno_id', $num_control)
            ->join('respuestas', 'respuestas.id', '=', 'evaluacion_respuesta.respuesta_id')
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 1)
            ->where('preguntas.seccion', 2)
            ->sum('respuestas.valor');

        $seccion3 = Evaluacion_respuesta::where('alumno_id', $num_control)
            ->join('respuestas', 'respuestas.id', '=', 'evaluacion_respuesta.respuesta_id')
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 1)
            ->where('preguntas.seccion', 3)
            ->sum('respuestas.valor');

        $seccion4 = Evaluacion_respuesta::where('alumno_id', $num_control)
            ->join('respuestas', 'respuestas.id', '=', 'evaluacion_respuesta.respuesta_id')
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 1)
            ->where('preguntas.seccion', 4)
            ->sum('respuestas.valor');

        $seccion5 = Evaluacion_respuesta::where('alumno_id', $num_control)
            ->join('respuestas', 'respuestas.id', '=', 'evaluacion_respuesta.respuesta_id')
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 1)
            ->where('preguntas.seccion', 5)
            ->sum('respuestas.valor');

        $seccion6 = Evaluacion_respuesta::where('alumno_id', $num_control)
            ->join('respuestas', 'respuestas.id', '=', 'evaluacion_respuesta.respuesta_id')
            ->join('preguntas', 'preguntas.id', '=', 'evaluacion_respuesta.pregunta_id')
            ->where('preguntas.evaluacion_id', 1)
            ->where('preguntas.seccion', 6)
            ->sum('respuestas.valor');

        return $seccion1 . ' ' . $seccion2 . ' ' . $seccion3 . ' ' . $seccion4 . ' ' . $seccion5 . ' ' . $seccion6;
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
