<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obraMaqPerHistorico extends Model
{
    use HasFactory;
    protected $table = "obraMaqPerHistorico";

    public $timestamps = true;

    protected $fillable = [
        'maquinariaId', 'personalId', 'obraId', 'inicio', 'fin', 'combustible','usuarioId'
    ];
}
