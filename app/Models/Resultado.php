<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = "resultados";
    protected $fillable = [
        'alumno_id',
        'periodo_eval_id',
        'psicometrico_I',
        'psicometrico_II',
        'psicometrico_III',
        'psicometrico_IV',
        'psicometrico_V',
        'psicometrico_VI',
        'razonamiento',
        'socioeconomico'

    ];

    public $timestamps = false;

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
    
}
