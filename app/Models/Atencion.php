<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    protected $table = 'atenciones';
    
    public $timestamps = false;
    
    protected $fillable = [
        'alumno_id',
        'periodo_id',
        'atencion',
        'canalizado',
        'area_canalizada',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }
}

