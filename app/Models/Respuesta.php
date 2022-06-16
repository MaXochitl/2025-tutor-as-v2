<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;
    protected $table = "respuestas";
    protected $primaryKey = "id";
    protected $fillable = ['pregunta_id', 'respuesta', 'valor'];
    public $timestamps=false;
    protected $keyType='string';

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
