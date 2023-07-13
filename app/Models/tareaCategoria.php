<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tareaCategoria extends Model
{
    use HasFactory;
    protected $table = "tareaCategoria";

    public $timestamps = false;

    protected $fillable = [
          'nombre', 'comentario'
    ];
}
