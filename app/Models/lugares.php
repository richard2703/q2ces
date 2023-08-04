<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lugares extends Model
{
    use HasFactory;
    
    protected $table = "lugares";

    public $timestamps = true;

    protected $fillable = [
        'nombre', 'comentario', 'activo', 'ubicacionId'
    ];
}
