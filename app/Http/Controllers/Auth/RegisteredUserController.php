<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Registro;
use App\Models\Tutor;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use DateTime;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $registro = Registro::max('id');
        $registro = Registro::find($registro);
        if ($registro->status) {
            $carreras = Carrera::all();
            return view('auth.register', compact('carreras'));
        } else {
            return redirect()->route('login')->with('register', 'no');
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'matricula' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'ap_paterno' => ['required', 'string'],
            'ap_materno' => ['required', 'string'],
            'domicilio' => ['required', 'string'],
            'imagen' => 'mimes:jpg,png,PNG',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $tutor = Tutor::find($request->matricula);

        if ($tutor != null) {
            return redirect()->route('register')->with('creado', 'no');;
        } else {


            //cambiar nombre y guarda archivo
            $now = new DateTime();
            $fecha = $now->format('Ymd-His'); //obtiene fecha actual
            $nombre = "";
            $imagen = $request->file('foto'); //obtencion de la imagen

            if ($imagen) {
                $extension = $imagen->getClientOriginalExtension(); //obtiene la extencion
                $nombre = "/tutores/tutor" . "-" . $fecha . "." . $extension; //genera nombre del archivo
                //Storage::disk('local')->put($nombre,File::get($imagen)); //sube archivo a la ruta archivos
                $imagen->move('tutores', $nombre);
            }


            $tutor = Tutor::create([
                'id' => $request->matricula,
                'carrera_id' => $request->carrera,
                'nombre' => $request->name,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'telefono' => $request->telefono,
                'sexo' => $request->sexo,
                'domicilio' => $request->domicilio,
                'foto' => $nombre
            ]);

            //$tutor_b=Tutor::where('matricula',$request->matricula)->paginate(1);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'tutor_id' => $request->matricula //$tutor_b[0]->id
            ])->assignRole('tutor');

            event(new Registered($user));
            Auth::login($user);


            if ($user->can('tutorias.home')) {
                return redirect()->route('orientacion.index');
            } else {
                return redirect()->route('reportes_tutor.show', Auth::user()->tutor->id);
            }
        }
    }
}
