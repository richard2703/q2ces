<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conceptosServiciosTrasporte extends Model
{
    use HasFactory;
    protected $table = "conceptosServiciosTrasporte";

    public $timestamps = false;

    protected $fillable = [
        'codigo', 'nombre', 'comentario'
    ];
}
