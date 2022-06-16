<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;
    protected $table = 'tutores';
    protected $primarykey = 'id';
    protected $keyType = 'string';

    protected $fillable = ['id', 'carrera_id', 'nombre', 'ap_paterno', 'ap_materno', 'sexo', 'telefono', 'domicilio', 'foto'];
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class)->using(Periodo_tutorado::class);
    }
    public function asignaciones(){
        return $this->hasMany(Asignacion_tutor::class);
    }
    
}
