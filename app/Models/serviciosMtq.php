<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class serviciosMtq extends Model
{
    use HasFactory;

    protected $table = "serviciosMtq";
    public $timestamps = true;

    protected $fillable = [
        'nombre', 'codigo', 'color', 'comentario', 'activo'
    ];
}
