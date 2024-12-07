<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aviso;
use App\Models\Carrera;
use App\Models\Periodo;
use App\Models\Periodo_tutorado;
use App\Models\Periodo_view;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrientacionController extends Controller
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
        if ($user->can('solo.tutor')) {
            //return redirect()->route('alumnos-tutor.show', Auth::user()->tutor->id);
            return redirect()->route('reportes_tutor.show', Auth::user()->tutor->id);
        }

        $carreras = Carrera::orderby('id')->get();
        $avisos = Aviso::all();
        $periodo_view = Periodo_view::find(1);
        $periodo_view = $periodo_view->Periodo;
        $periodos = Periodo::orderBy('id', 'desc')->get();
        return view('admin.home.index', compact('carreras', 'avisos', 'periodo_view', 'periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periodo_view = Periodo_view::find(1);
        $periodo_view = Periodo::find($periodo_view->id);
        return $periodo_view;
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
        $periodo_view = Periodo_view::find(1);
        $periodo_view->periodo_id = $request->periodo_select;
        $periodo_view->save();
        return redirect()->route('orientacion.index')->with('change', 'yes');
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
    public function update(Request $request, $id, $mes)
    {
        //
        Periodo_tutorado::all();
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
