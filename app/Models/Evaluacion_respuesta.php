<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion_respuesta extends Model
{
    use HasFactory;
    protected $table="evaluacion_respuesta";
    protected $primaryKey="id";
    protected $fillable=['alumno_id','pregunta_id','respuesta_id','periodo_id','periodo_eval_id'];
    public $timestamps = false;
    

    public function pregunta(){
        return $this->belongsTo(Pregunta::class);
    }
    public function respuesta(){
        return $this->belongsTo(Respuesta::class);
    }
    public function alumno(){
        return $this->belongsTo(Alumno::class);
        //return $this->belongsToMany(Alumno::class);

    }
}
