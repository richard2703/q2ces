<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class manoDeObra extends Model
{
    use HasFactory;
    protected $table = "manoDeObra";

    public $timestamps = false;

    protected $fillable = [
        'codigo', 'nombre', 'costo', 'comentario'
    ];
}
