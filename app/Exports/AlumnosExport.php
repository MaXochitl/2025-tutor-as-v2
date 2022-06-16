<?php

namespace App\Exports;

use App\Models\Alumnos_examenes;
use Maatwebsite\Excel\Concerns\FromCollection;

class AlumnosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Alumnos_examenes::all();
    }
}
