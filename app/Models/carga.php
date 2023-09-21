<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carga extends Model
{
    use HasFactory;
    protected $table = "carga";

    public $timestamps = true;

    protected $fillable = [
        'litros', 'maquinariaId', 'operadorId', 'precio', 'userId', 'horaLlegadaCarga', 'comentario'
    ];
}
