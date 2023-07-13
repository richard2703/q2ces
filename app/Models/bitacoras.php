<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bitacoras extends Model
{
    use HasFactory;
    protected $table = 'bitacoras';

    public $timestamps = true;

    protected $fillable = [
        'nombre', 'comentario', 'activa'
    ];
}
