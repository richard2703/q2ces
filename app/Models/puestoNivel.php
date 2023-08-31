<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class puestoNivel extends Model
{
    use HasFactory;
    protected $table = "puestoNivel";

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'comentario', 'requiereAsistencia', 'usaCajaChica', 'usoCombustible'
    ];
}
