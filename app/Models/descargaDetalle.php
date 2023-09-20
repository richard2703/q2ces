<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class descargaDetalle extends Model
{
    use HasFactory;
    protected $table = "descargaDetalle";

    public $timestamps = true;

    protected $fillable = [
        'nombreSolicitante',
        'costoTrabajo',
        'horaLlegada',
        'observaciones',
        'tipo_solicitud',
        'descargaId'
    ];
}
