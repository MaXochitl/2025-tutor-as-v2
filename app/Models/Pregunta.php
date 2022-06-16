<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;
    protected $table = "preguntas";
    protected $primaryKey = "id";
    protected $fillable = ['evaluacion_id', 'pregunta'];
    public $timestamps=false;
    protected $keyType='string';


    public function evaluacion()
    {
       return  $this->belongsTo(Evaluacion::class);
    }

    public function respuestas()
    {
       return $this->hasMany(Respuesta::class);
    }
}
