<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventarioMtq extends Model
{
    use HasFactory;
    protected $table = 'inventarioMtq';

    public $timestamps = true;

    protected $fillable = [
        'numparte', 'nombre', 'marcaId', 'modelo', 'proveedorId', 'cantidad', 'reorden',
        'maximo', 'valor', 'imagen', 'tipo', 'unidad',
        'uniformeTipoId', 'uniformeTalla', 'uniformeRetornable',
        'extintorCapacidad', 'extintorCodigo', 'extintorFechaVencimiento', 'extintorTipo', 'extintorUbicacion', 'extintorAsignadoMaquinariaId'
    ];
}
