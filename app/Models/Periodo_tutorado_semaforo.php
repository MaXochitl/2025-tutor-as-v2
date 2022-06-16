<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo_tutorado_semaforo extends Model
{
    use HasFactory;
    protected $table = 'periodo_tutorado_semaforo';
    protected $primarykey = 'id';
    protected $fillable = ['periodo_tutorado_id', 'mes', 'semaforo_id'];
    public $timestamps = false;
    public function semaforo()
    {
        return $this->belongsTo(Semaforo::class);
    }
    public function periodo_tutorado()
    {
        return $this->belongsTo(Periodo_tutorado::class);
    }
}
