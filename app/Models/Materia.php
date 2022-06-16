<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $table = 'materias';
    protected $primarykey = 'id';
    protected $fillable = ['nombre', 'semestre', 'carrera_id'];
    public $timestamps = false;

    public function periodos()
    {
        /**_____________pertenece a muchas____________________________- */
        return $this->belongsToMany(Periodo::class)->using(Control_materia::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
}
