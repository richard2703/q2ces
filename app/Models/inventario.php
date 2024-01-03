<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventario extends Model
{
    use HasFactory;
    protected $table = 'inventario';

    public $timestamps = true;

    protected $fillable = [
        'numparte', 'nombre', 'marcaId', 'modelo', 'proveedorId', 'cantidad', 'reorden',
        'maximo', 'valor', 'imagen', 'tipo', 'estatusId',
        'uniformeTipoId', 'uniformeTalla', 'uniformeRetornable',
        'extintorCapacidad', 'extintorCodigo', 'extintorFechaVencimiento', 'extintorTipo', 'extintorUbicacion', 'extintorAsignadoMaquinariaId'
    ];
}
