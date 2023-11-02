<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mantenimientoImagen extends Model
{
    use HasFactory;
    protected $table = "mantenimientoImagen";

    public $timestamps = false;

    protected $fillable = [
        'maquinariaId', 'ruta','mantenimientoId'
    ];
}
