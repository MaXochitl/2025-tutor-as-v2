<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo_eval extends Model
{
    use HasFactory;

    protected $table='periodo_eval';
    protected $primaryKey='id';
    protected $fillable=['inicio','fin','estado'];
    public $timestamps = false;


    public function eval_respuesta(){
        return $this->belongsToMany(Eval_Respuesta::class);
    }

}
