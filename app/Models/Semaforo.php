<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semaforo extends Model
{
    use HasFactory;
    protected $table = 'semaforo';
    protected $primarykey = 'id';
    protected $fillable = ['nombre','fondo','color'];
    public $timestamps = false;

    public function periodo_tutorados()
    {
        //pertenece a muchos periodos  el segundo paramentro es el nombre de la clase
        return $this->hasOne(Periodo_tutorado::class);//->using(periodo_tutor_semaforo::class);
    }
}
