<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Altera_entrega;
use App\Models\Periodo;
use App\Models\Periodo_tutorado;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class PeriodoTutoradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $periodo_tutorado = Periodo::orderBy('id', 'desc')->get();
        $registro = Registro::max('id');
        $registro = Registro::find($registro);
        //___________________________________________________________
        $id = Altera_entrega::max('id');
        $altera_entrega = Altera_entrega::find($id);

        return view('admin.periodo.periodo', compact(
            'periodo_tutorado',
            'registro',
            'altera_entrega'
        ));
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
        //return $request;

        $periodos = Periodo::create([
            'inicio' => $request->inicio,
            'fin' => $request->fin,
            'mes_1' => $request->mes1,
            'mes_2' => $request->mes2,
            'mes_3' => $request->mes3,
            'mes_4' => $request->mes4,
            'reporte_final' => $request->mes5
        ]);

        return redirect()->route('periodo-tutorado.index');
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
        $registro = Registro::max('id');
        $registro = Registro::find($registro);
        $registro->status = $id;
        $registro->save();
        //return $registro;
        return redirect()->route('periodo-tutorado.index');
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

        $periodo = Periodo::find($id);
        $periodo->inicio = $request->inicio;
        $periodo->mes_1 = $request->fin;
        $periodo->fin = $request->fin;
        $periodo->mes_1 = $request->mes1;
        $periodo->mes_2 = $request->mes2;
        $periodo->mes_3 = $request->mes3;
        $periodo->mes_4 = $request->mes4;
        $periodo->reporte_final = $request->mes5;
        $periodo->save();
        return redirect()->route('periodo-tutorado.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datos = Periodo_tutorado::where('periodo_id', $id)->count();
        if ($datos == 0) {
            Periodo::find($id)->delete();
            return redirect()->route('periodo-tutorado.index')->with('eliminar', 'si');
        }
        return redirect()->route('periodo-tutorado.index')->with('eliminar', 'no');
    }
}
