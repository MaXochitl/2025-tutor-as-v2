<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos_examenes extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    protected $table = "alumnos_examenes";
    protected $fillable = [
        'periodo_eval_id',
        'num_control',
        'carrera_id',
        'nombre',
        'telefono',
        'correo',
        'status'
    ];

    public $timestamps = false;

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
}
