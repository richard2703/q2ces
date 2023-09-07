<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoMantenimiento extends Model
{
    use HasFactory;
    protected $table = "tipoMantenimiento";

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'comentario', 'color'
    ];
}
