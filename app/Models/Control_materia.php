<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Control_materia extends Model
{
    use HasFactory;
    protected $table = 'control_materias';
    protected $primarykey = 'id';
    protected $fillable = [
        'periodo_id', 'materia_id', 'alumno_id', 'status'
    ];
    public $timestamps = false;

    public function materia()
    {
        //pertence a uma materia
        return $this->belongsTo(Materia::class);
    }
    public function periodo()
    {
        //pertence a un periodo
        return $this->belongsTo(Periodo::class);
    }

    public function alumno(){
        //pertence a un alumno
        return $this->belongsTo(Alumno::class);
    }
}
