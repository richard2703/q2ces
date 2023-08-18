<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignacionUniforme extends Model {
    use HasFactory;
    protected $table = 'asignacionUniforme';

    public $timestamps = true;

    protected $fillable = [
        'personalId', 'inventarioId', 'cantidad',  'comentario'
    ];
}
