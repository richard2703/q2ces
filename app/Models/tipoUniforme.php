<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoUniforme extends Model
{
    use HasFactory;

    protected $table = "tipoUniforme";

    public $timestamps = false;

    protected $fillable = [
        'nombre',  'comentario'
    ];
}
