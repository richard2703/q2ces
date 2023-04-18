<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoAsistencia extends Model
{
    use HasFactory;
    protected $table = 'tipoAsistencia';
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'comentario', 'color'
    ];
}