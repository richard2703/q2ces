<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoAlmacen extends Model
{
    use HasFactory;

    protected $table = "tipoAlmacen";

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'comentario'
    ];
}
