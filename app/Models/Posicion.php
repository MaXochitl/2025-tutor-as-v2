<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posicion extends Model
{
    use HasFactory;
    protected $table = 'posiciones';
    protected $primaryKey = 'id';
    protected $fillable = ['alumno_id', 'color_id', 'posicion'];
    public $timestamps = false;

    public function alumno()
    {
        return $this->belongsToMany(Alumno::class);
    }
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
