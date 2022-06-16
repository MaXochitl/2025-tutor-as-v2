<?php

namespace App\Imports;

use App\Models\Alumno;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportAlumnos implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $alumno = Alumno::find($row[0]);
        if ($alumno != null) {
            return null;
        }
        return new Alumno([
            'id' => $row[0],
            'nombre' => $row[1],
            'ap_paterno' => $row[2],
            'ap_materno' => $row[3],
            'sexo' => $row[4],
            'domicilio' => $row[5],
            'grupo' => $row[6],
            'telefono' => $row[7],
            'correo' => $row[8],
            'carrera_id' => $row[9],
            'estado' => 1

        ]);
    }
}
