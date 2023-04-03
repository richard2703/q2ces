<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eventos extends Model
{
    use HasFactory;
    protected $table = 'eventos';
    public $timestamps = true;

    protected $fillable = [
        'userId', 'titulo', 'fechaInicio', 'fechaFin', 'prioridadId', 'comentario'
    ];

}
