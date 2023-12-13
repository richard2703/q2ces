<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eventosCalendarioTipos extends Model
{
    use HasFactory;
    protected $table = 'eventosCalendarioTipos';
    public $timestamps = true;

    protected $fillable = [
        'nombre', 'color', 'comentario', 'tipoEvento', 'activo'
    ];
}
