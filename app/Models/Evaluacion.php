<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;
    protected $table="Evaluaciones";
    protected $pimaryKey="id";
    protected $fillable=['nombre'];

    public function preguntas(){
        return $this->hasMany(Pregunta::class);
    }
    
}
