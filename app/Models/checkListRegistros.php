<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkListRegistros extends Model {
    use HasFactory;
    protected $table = 'checkListRegistros';

    public $timestamps = true;

    protected $fillable = [
        'checkListId',
        'maquinariaId' ,
        'maquinaria',
        'bitacoraId' ,
        'bitacora',
        'grupoId' ,
        'grupo',
        'tareaId',
        'tarea',
        'tareaTipoValor',
        'resultado' ,
        'valor' ,
        'usuarioId',
        'ruta',
    ];
}
