<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $table = 'carreras';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_carrera', 'icono', 'fondo'];
    public $timestamps = false;


    public function alumnos()
    {
        //tiene muchos alumnos no_id
        return $this->hasMany(Alumno::class);
    }

    public function tutores()
    {
        //tiene muchos tutores no_id
        return $this->hasMany(Tutor::class);
    }
    public function materias()
    {
        return $this->hasMany(Materia::class);
    }
}
