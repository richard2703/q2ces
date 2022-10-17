<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maqdocs extends Model
{
    use HasFactory;
    protected $table = "maqdocs";

    public $timestamps = false;

    protected $fillable = [
        'maquinariaId', 'factura', 'circulacion', 'verificacion', 'verificacionEstado', 'ficha', 'manual',
        'seguro', 'seguroEstatus', 'registro', 'verificacion', 'especial'
    ];
}
