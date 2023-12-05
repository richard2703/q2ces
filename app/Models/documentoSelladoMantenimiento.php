<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documentoSelladoMantenimiento extends Model
{
    use HasFactory;
    protected $table = "documentoSelladoMantenimiento";

    public $timestamps = true;

    protected $fillable = [
        'mantenimientoId', 'ruta',
    ];
}
