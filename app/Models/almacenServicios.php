<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class almacenServicios extends Model
{
    use HasFactory;

    protected $table = "almacenServicios";
    public $timestamps = true;

    protected $fillable = [
        'almacenId', 'conceptoId', 'precio'
    ];
}
