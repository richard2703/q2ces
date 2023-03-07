<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servicios extends Model
{
    use HasFactory;
    protected $table = 'servicios';
    public $timestamps = true;

    protected $fillable = [
           'userId', 'titulo', 'estadoId', 'maquinariaId', 'comentario','fechaRequerimiento','fechaSolicitud','comentario'
    ];
}
