<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calendarioPrincipal extends Model
{
    use HasFactory;
    protected $table = "calendarioPrincipal";

    public $timestamps = true;

    protected $fillable = [
        'title',
        'mantenimientoId',
        'tipoMantenimientoId',
        'maquinariaId',
        'userId',
        'personalId',
        'solicitudesId',
        'actividadesId',
        'eventosId',
        'descripcion',
        'estatus',
        'color',
        'start',
        'end',
        'prioridad'
    ];
}
