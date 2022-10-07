<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nomina extends Model
{
    use HasFactory;
    protected $table = "nomina";

    public $timestamps = false;

    protected $fillable = [
        'userId', 'nomina', 'imss', 'clinica', 'infonavit', 'afore', 'pago', 'tarjeta', 'banco', 'puesto',
        'ingreso', 'vactotales', 'vactomadas', 'primavactotal', 'primavactomadas', 'laborables', 'horario',
        'jefeId', 'neto', 'bruto', 'diario', 'diariointegro', 'mensualintegro',
        'imssAportacion', 'imssriesgo', 'aforeAportacion', 'isn', 'ispt', 'aguinaldo', 'ptu'
    ];
}