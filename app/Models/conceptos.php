<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conceptos extends Model
{
    use HasFactory;
    protected $table = "conceptos";

    public $timestamps = false;

    protected $fillable = [
        'codigo', 'nombre', 'tipo', 'comentario'
    ];
}
