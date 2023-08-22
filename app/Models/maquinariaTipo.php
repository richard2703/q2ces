<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maquinariaTipo extends Model
{
    use HasFactory;
    protected $table = "maquinariaTipo";

    public $timestamps = false;

    protected $fillable = [
          'nombre', 'comentario'
    ];
}
