<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoEquipo extends Model
{
    use HasFactory;

    protected $table = "tipoEquipo";

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'tipo', 'comentario'
    ];
}