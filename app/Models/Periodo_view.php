<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo_view extends Model
{
    use HasFactory;
    protected $table = 'Periodo_view';
    protected $primarykey = 'id';
    protected $fillable = ['id_periodo'];
    public $timestamps = false;

    public function Periodo()
    {
        //indica que pertenece a referencia a una clave primaria de otro modelo
        return $this->belongsTo(Periodo::class);//->using(periodo_tutor_semaforo::class);
    }
}
