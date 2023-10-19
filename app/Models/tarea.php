<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tarea extends Model {
    use HasFactory;
    protected $table = 'tarea';

    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'categoriaId',
        'ubicacionId',
        'tipoId',
        'comentario',
        'activa',
        'tipoValorId',
        'leyenda',
        'requiereLimites',
        'limiteInferior',
        'limiteSuperior',
        'requiereEscala',
        'limiteInferiorEscala',
        'limiteSuperiorEscala',
        'requierePeriodo',
        'fechaInicial',
        'fechaFinal',
    ];

}
