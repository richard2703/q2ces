<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class serviciosTrasporte extends Model
{
    use HasFactory;
    protected $table = "serviciosTrasporte";

    public $timestamps = true;

    protected $fillable = [
        'fecha', 'conceptoServicioTrasporteId', 'obraId', 'ncomprobante', 'equipoId', 'personalId', 'cantidad', 'estatus'
    ];
}
