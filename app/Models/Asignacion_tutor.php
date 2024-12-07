<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion_tutor extends Model
{
    use HasFactory;
    protected $table = 'asignacion_tutor';
    protected $primarykey = 'id';
    protected $fillable = [
        'tutor_id',
        'periodo_id',
        'semestre',
        'grupo'
    ];

    public $timestamps = false;

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }
}
