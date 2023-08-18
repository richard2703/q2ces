<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipo extends Model {
    use HasFactory;
    protected $table = 'equipo';

    public $timestamps = false;

    protected $fillable = [
        'personalId',
        'chaleco' ,
        'camisa' ,
        'botas' ,
        'guantes' ,
        'comentarios' ,
        'pc' ,
        'pcSerial' ,
        'celular' ,
        'celularImei' ,
        'radio' ,
        'radioSerial' ,
        'cargadorSerial' ,
    ];
}
