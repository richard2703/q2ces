<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gastosMantenimiento extends Model
 {
    use HasFactory;
    protected $table = 'gastosMantenimiento';
    public $timestamps = true;

    protected $fillable = [
        'mantenimientoId',
        'inventarioId',
        'manoDeObraId',
        'concepto',
        'numeroParte',
        'seccion',
        'cantidad',
        'costo',
        'total',
    ];
}
