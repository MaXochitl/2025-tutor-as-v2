<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table = "colores";
    protected $primarykey = "id";
    protected $fillable = ['nombre', 'codigo', 'caracteristicas'];

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class);
    }
    public function colorPosicion()
    {
        return $this->hasMany(Posicion::class);
    }
}
