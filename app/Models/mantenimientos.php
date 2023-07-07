<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mantenimientos extends Model {
    use HasFactory;
    protected $table = 'mantenimientos';
    public $timestamps = true;

    protected $fillable = [
        'tipo', 'estadoId', 'titulo', 'maquinariaId', 'personalId', 'comentario', 'fechaInicio', 'fechaReal', 'adscripcion',
        'horometro',        'kilometraje',        'subtotal',        'iva',
        'costo' ,
    ];
}
