<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividades_tutoria extends Model
{
    use HasFactory; 

    protected $table = 'actividades_tutorias';
    
    protected $fillable = [
        'tema',
        'descripcion_actividad',
        'fecha',
        'tiempo',
        'recursos',
        'tutor_id', 
    ];

    protected $casts = [
        'fecha' => 'datetime', 
    ];
}
