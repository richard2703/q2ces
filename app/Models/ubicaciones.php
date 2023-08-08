<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ubicaciones extends Model
{
    use HasFactory;

    protected $table = "ubicaciones";

    public $timestamps = true;

    protected $fillable = [
        'nombre', 'direccion','comentario', 'activo'
    ];
}
