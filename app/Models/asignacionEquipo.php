<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignacionEquipo extends Model
{
    use HasFactory;
    protected $table = "asignacionEquipo";

    public $timestamps = true;

    protected $fillable = [
        'personalId', 'equipoId', 'cantidad', 'marcaId', 'serial', 'comentario'
    ];
}
