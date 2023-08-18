<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventarioMovimientos extends Model {
    use HasFactory;
    protected $table = 'inventarioMovimientos';

    public $timestamps = true;

    protected $fillable = [
        'inventarioId' ,
        'usarioId' ,
        'movimiento' ,
        'cantidad',
        'precioUnitario' ,
        'total'
    ];
}
