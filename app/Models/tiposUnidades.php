<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tiposUnidades extends Model
{
    use HasFactory;
    protected $table = "tiposUnidades";

    public $timestamps = true;

    protected $fillable = [
        'nombre',  'codigo', 'comentario'
    ];
}
