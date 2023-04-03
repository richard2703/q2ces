<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maquinariaEstatus extends Model
{
    use HasFactory;
    protected $table = 'maquinariaEstatus';
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'color', 'comentario'
    ];
}

