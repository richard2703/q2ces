<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tiposDocs extends Model
{
    use HasFactory;
    protected $table = 'tiposDocs';
    public $timestamps = true;

    protected $fillable = [
        'nombre', 'comentario'
    ];
}
