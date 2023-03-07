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
        'userId', 'responsable', 'maquinariaId', 'servicioId', 'titulo', 'prioridadId', 'estadoId', 'comentario', 'fechaSolicitud', 'fechaRequerimiento'
    ];
}
