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
        'fecha', 'conceptoId', 'obraId', 'ncomprobante', 'equipoId', 'personalId', 'cantidad', 'estatus', 'recibe', 'horaEntrega',
        'horaLlegada', 'cajaChica', 'almacenId', 'comentario', 'maniobristaId', 'odometro', 'servicio', 'costoMaterial', 'costoServicio', 'costoMano'
    ];
}
