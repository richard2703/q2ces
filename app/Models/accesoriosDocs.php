<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accesoriosDocs extends Model
{
    use HasFactory;
    protected $table = "accesoriosDocs";

    public $timestamps = true;

    protected $fillable = [
        'accesorioId', 'ruta', 'tipo', 'fechaVencimiento', 'estatus', 'requerido', 'comentarios'
    ];
}
