<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tareas extends Model {
    use HasFactory;
    protected $table = 'tareas';
    public $timestamps = true;

    protected $fillable = [
        'userId', 'responsable', 'titulo', 'fechaInicio', 'fechaFin', 'prioridadId', 'estadoId', 'fechaInicioR', 'fechaFinR', 'comentario'
    ];
}
