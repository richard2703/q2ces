<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicitudes extends Model
{
    use HasFactory;
    protected $table = 'solicitudes';
    public $timestamps = true;

    protected $fillable = [
        'userId', 'personalId', 'maquinariaId', 'title', 'start', 'end', 'estadoId', 'prioridad', 'funcionalidad', 'descripcion'
    ];
}
