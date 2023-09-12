<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicitudDetalle extends Model
{
    use HasFactory;
    protected $table = 'solicitudDetalle';
    public $timestamps = true;

    protected $fillable = [
        'inventarioId',
        'estadoId',
        'solicitudId',
        'tipo',
        'cantidad',
        'comentario',
        'carga',
        'litros',
        'reparacion'
    ];
}
