<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reparaciones extends Model
{
    use HasFactory;
    protected $table = 'reparaciones';
    public $timestamps = true;

    protected $fillable = [
         'codigo', 'nombre', 'comentario'
    ];
}
