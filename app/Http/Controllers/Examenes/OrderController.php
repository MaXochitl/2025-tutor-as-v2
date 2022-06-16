<?php

namespace App\Http\Controllers\Examenes;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Color;
use App\Models\Posicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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

        $colores = Posicion::all()->where('alumno_id', $request->positions[0][0]); //->sortBy('posicion');

        foreach ($colores as $list_color) {
            foreach ($request->positions as $posiciones) {
                if ($list_color->color_id == $posiciones[1]) {
                    $list_color->posicion = $posiciones[2];
                    $list_color->save();
                }
            }
        }

        return $request->positions;
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
        $colores = Posicion::all()->where('alumno_id', $id)->sortBy('posicion');
        $alumno = Alumno::find($id);
        if (count($colores) == 0) {
            DB::insert("insert into posiciones(
                alumno_id,
                color_id,
                posicion
            )values
            ('" . $id . "',1,1),
            ('" . $id . "',2,2),
            ('" . $id . "',3,3),
            ('" . $id . "',4,4),
            ('" . $id . "',5,5),
            ('" . $id . "',6,6),
            ('" . $id . "',7,7),
            ('" . $id . "',8,8)
            ");
            $colores = Posicion::all()->where('alumno_id', $id)->sortBy('posicion');
        } else {
            return redirect()->route('menu-examen.show', $alumno->id);
        }

        return view('examenes.testColores', compact('colores', 'alumno'));
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
