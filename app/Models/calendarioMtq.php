<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calendarioMtq extends Model
{
    use HasFactory;
    protected $table = "mtqEventos";

    public $timestamps = true;

    protected $fillable = [
        'title', 'maquina','fecha', 'descripcion','estatus', 'color', 'start', 'end', 
    ];
}
