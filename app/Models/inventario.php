<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventario extends Model
{
    use HasFactory;
    protected $table = "inventario";

    public $timestamps = true;

    protected $fillable = [
        'numparte', 'nombre', 'marca', 'modelo', 'proveedor', 'cantidad', 'reorden',
        'maximo', 'valor', 'imagen', 'tipo',
        'uniformeTipoId', 'uniformeTalla','uniformeRetornable',
        'extintorCapacidad', 'extintorCodigo','extintorFechaVencimiento'
    ];
}
