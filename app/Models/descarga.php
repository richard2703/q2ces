<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class descarga extends Model
{
    use HasFactory;
    protected $table = "descarga";

    public $timestamps = true;

    protected $fillable = [
        'horas', 'imgHoras', 'imgKm', 'km', 'litros', 'maquinariaId', 'operadorId', 'receptorId', 'servicioId',
    ];
}