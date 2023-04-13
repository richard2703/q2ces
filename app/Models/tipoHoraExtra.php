<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoHoraExtra extends Model {
    use HasFactory;
    protected $table = 'tipoHoraExtra';
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'valor', 'comentario', 'color'
    ];
}
