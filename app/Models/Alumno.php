<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use tidy;

class Alumno extends Model
{
    use HasFactory;
    protected $table = 'alumnos';
    protected $primarykey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'nombre',
        'ap_paterno',
        'ap_materno',
        'sexo',
        'fecha_nacimiento',
        'domicilio',
        'grupo',
        'telefono',
        'correo',
        'estado',
        'carrera_id'
    ];
    public $timestamps = false;

    public function carrera()
    {
        //pertenece a una sola carrera si_id
        return $this->belongsTo(Carrera::class);
    }
    public function materias()
    {
        return $this->belongsToMany(Materia::class)->using(Control_materia::class);
    }

    public function colores()
    {
        return $this->belongsToMany(Color::class, 'posiciones', 'alumno_id', 'color_id'); //;->using(Posicion::class);
    }

    public function colorPosicion()
    {
        return $this->hasMany(Posicion::class);
    }


    public function preguntas()
    {
        return $this->belongsToMany(Pregunta::class, 'evaluacion_respuesta', 'alumno_id', 'pregunta_id');
    }
    public function respuestas()
    {
        //return $this->belongsToMany(Respuesta::class)->using(Evaluacion_respuesta::class,'evaluacion_respuesta');
        return $this->belongsToMany(Respuesta::class, 'evaluacion_respuesta', 'alumno_id', 'respuesta_id');
    }
    public function periodos()
    {
        return $this->belongsToMany(Periodo::class)->using(Periodo_tutorado::class);
    }
    public function periodo_eval()
    {
        return $this->belongsToMany(Periodo_eval::class, 'evaluacion_respuesta', 'alumno_id', 'periodo_eval_id');
    }

    public function eval_respuesta()
    {
        //muchos
        // return $this->hasMany(Evaluacion_respuesta::class);
        return $this->hasOne(Evaluacion_respuesta::class);
    }


     // En el modelo Alumno.php
     public function atencion()
     {
         return $this->hasOne(Atencion::class, 'alumno_id', 'id');
     }
 
}
