<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usoMaquinarias extends Model
{
    use HasFactory;

    protected $table = "usoMaquinarias";

    public $timestamps = true;

    protected $fillable = [
        'maquinariaId', 'uso', 'comentario', 'foto'
    ];
}
