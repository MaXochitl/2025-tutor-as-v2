<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo_tutorado extends Model
{
    use HasFactory;

    protected $table = 'periodo_tutorado';
    protected $primarykey = 'id';
    protected $fillable = [
        'periodo_id',
        'tutor_id',
        'alumno_id',
        'semestre',
        'tipo',
        'staus',
        'mes_1',
        'mes_2',
        'mes_3',
        'mes_4',
        'reporte_final',
        'oe_1',
        'oe_2',
        'oe_3',
        'oe_4',
        'entrega_1',
        'entrega_2',
        'entrega_3',
        'entrega_4',
        'entrega_final',
        'status',
        'semaforo_id'
    ];

    public $timestamps = false;

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }
    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
    public function semaforo()
    {
        //return $this->belongsToMany(Semaforo::class)->using(periodo_tutor_semaforo::class);
        return $this->belongsTo(Semaforo::class);
    }

    public function lights()
    {
        return $this->hasMany(Periodo_semaforo::class,'periodo_id');
    }
}
