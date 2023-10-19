<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class frecuenciaEjecucion extends Model
{
    use HasFactory;
    protected $table = "frecuenciaEjecucion";
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'comentario','dias','minimoEjecucion'
    ];
}
