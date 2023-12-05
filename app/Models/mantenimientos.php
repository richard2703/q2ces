<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mantenimientos extends Model
{
    use HasFactory;
    protected $table = 'mantenimientos';
    public $timestamps = true;

    protected $fillable = [
        'tipoMantenimientoId',
        'estadoId',
        'titulo',
        'codigo',
        'maquinariaId',
        'personalId',
        'comentario',
        'fechaInicio',
        'fechaReal',
        'mantenimientoPrint',
        'observaciones',
        'usoKom',
        'subtotal',
        'iva',
        'costo',
        'coordTaller',
        'coordOperaciones',
        'mecanico',
        'responsable',
        'imagenSellos'
    ];
}
