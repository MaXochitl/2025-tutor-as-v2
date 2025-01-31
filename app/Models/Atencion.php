<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    use HasFactory;


    // Define la tabla asociada al modelo
    protected $table = 'atenciones';

    // Campos que se pueden asignar de forma masiva
    protected $fillable = ['alumno_id', 'atencion', 'canalizado', 'area_canalizada'];
    public $timestamps = false;

 // Establecer la clave primaria como alumno_id
 protected $primaryKey = 'alumno_id';
 public $incrementing = false; // Si la clave primaria no es autoincremental
 protected $keyType = 'string'; // Si alumno_id no es un número

    // Relación con el modelo Alumno
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }
}
