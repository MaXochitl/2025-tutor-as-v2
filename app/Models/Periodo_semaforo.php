<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo_semaforo extends Model
{
    use HasFactory;

    protected $table = 'periodo_semaforo';
    protected $primarykey = 'id';
    protected $fillable = ['periodo_id', 'semaforo_id', 'semestre'];

    public $timestamps = false;

    public function semaforos()
    {
        return $this->hasMany(Semaforo::class, 'id', 'semaforo_id');
    }
}
