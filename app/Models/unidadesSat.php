<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unidadesSat extends Model
{
    use HasFactory;
    protected $table = "unidadesSat";

    public $timestamps = true;

    protected $fillable = [
        'nombre',  'codigo', 'comentario'
    ];
}
