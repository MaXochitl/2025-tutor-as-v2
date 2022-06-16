<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    protected $table = 'periodos';
    protected $primarykey = 'id';
    protected $fillable = [
        'inicio', 'fin', 'mes_1', 'mes_2', 'mes_3', 'mes_4','reporte_final'
    ];
    public $timestamps = false;

    public function alumnos()
    {
        //pertenece muchos periodos tutorados
        return $this->belongsToMany(Alumno::class)->using(Periodo_tutorado::class);
    }

    public function fechasEntrega()
    {
        //tiene mushos controles de materias 
        return $this->hasMany(Control_materia::class);
    }

    public function materias(){
        //pertence a muchas materias
        return $this->belongsToMany(Materia::class)->using(Control_materia::class);
    }
}
