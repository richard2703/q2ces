<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maqimagen extends Model
{
    use HasFactory;
    protected $table = "maqimagen";

    public $timestamps = false;

    protected $fillable = [
        'maquinariaId', 'ruta'
    ];
}
