<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maqdocs extends Model
{
    use HasFactory;
    protected $table = "maqdocs";

    public $timestamps = true;

    protected $fillable = [
        'maquinariaId', 'ruta', 'tipo', 'fechaVencimiento', 'estatus', 'requerido', 'comentarios'
    ];
}
