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
        'maquinariaId',
        'userId',
        'personalId',
        'solicitudesId',
        'actividadesId',
        'eventosId',
        'fecha',
        'descripcion',
        'estatus',
        'color',
        'start',
        'end',
    ];
}
