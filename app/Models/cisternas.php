<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cisternas extends Model
{
    use HasFactory;
    protected $table = "cisternas";
    public $timestamps = true;

    protected $fillable = [
        'nombre', 'contenido', 'ultimoPrecio', 'ultimaCarga'
    ];
}
