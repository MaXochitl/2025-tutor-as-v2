<?php

namespace App\Imports;

use App\Models\Alumnos_examenes;
use App\Models\Periodo_eval;
use Maatwebsite\Excel\Concerns\ToModel;

class AlumnosImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //return $row;

        $periodo = Periodo_eval::max('id');
        
        return new Alumnos_examenes([
            'periodo_eval_id' => $periodo,
            'num_control' => $row[0],
            'carrera_id' => $row[1],
            'nombre' => $row[2],
            'telefono' => $row[3],
            'correo' => $row[4],
            'status' => 0
        ]);
        
    }
}
