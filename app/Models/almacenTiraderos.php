<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class almacenTiraderos extends Model
{
    use HasFactory;

    protected $table = "almacenTiraderos";

    public $timestamps = true;

    protected $fillable = [
        'nombre',  'comentario', 'tipoAlmacenId'
    ];
}
