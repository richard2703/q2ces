<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extintores extends Model
{
    use HasFactory;
    protected $table = "extintores";

    public $timestamps = true;

    protected $fillable = [
        'identificador', 'serie', 'capacidad', 'ultimaRevision', 'proximaRevision', 'tipo', 'ubicacionId', 'lugarId', 'maquinariaId',
        'comentario', 'activo'
    ];
}
