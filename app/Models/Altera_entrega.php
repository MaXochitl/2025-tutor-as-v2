<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Altera_entrega extends Model
{
    use HasFactory;
    protected $table = 'altera_entrega';
    protected $primarykey = 'id';
    protected $fillable = ['mes_1', 'mes_2', 'mes_3', 'mes_4', 'mes_5',];
    public $timestamps = false;
}
