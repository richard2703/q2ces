<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tiposServicios extends Model
{
    use HasFactory;
    
    protected $table = "tiposServicios";

    public $timestamps = true;

    protected $fillable = [
        'nombre',  'codigo', 'costo', 'comentario', 'activo' 
    ];
}
