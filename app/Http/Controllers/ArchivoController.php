<?php

namespace App\Http\Controllers;

use App\Models\File_format;
use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos = File_format::all();
        return view('admin.constancia.datos', compact('datos'));
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

        $file_format = File_format::find($id);
        $file_format->destinatario = $request->destinatario;
        $file_format->atentamente_1 = $request->nombre_1;
        $file_format->cargo = $request->cargo_1;
        $file_format->atentamente_2 = $request->nombre_2;
        $file_format->cargo_2 = $request->cargo_2;
        $file_format->atentamente_3 = $request->nombre_3;
        $file_format->cargo_3 = $request->cargo_3;
        $file_format->save();
        return redirect()->route('datospdf.index');
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
