<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File_format extends Model
{
    use HasFactory;
    protected $table = 'file_format';
    protected $prymariKey = 'id';
    protected $fillable = [
        'nombre_artichivo',
        'destinatario',
        'atentamente_1',
        'cargo',
        'atentamente_2',
        'cargo_2',
        'atentamente_3',
        'cargo_3'

    ];
    public $timestamps = false;
}
