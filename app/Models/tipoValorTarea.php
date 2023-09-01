<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoValorTarea extends Model
{
    use HasFactory;

    protected $table = "tipoValorTarea";

    public $timestamps = false;

    protected $fillable = [
        'nombre',  'comentario'
    ];
}
