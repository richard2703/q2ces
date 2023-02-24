<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accesorios extends Model
{
    use HasFactory;
    protected $table = "accesorios";

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'marca', 'modelo', 'color', 'serie', 'ano', 'foto', 'maquinariaId'
    ];
}
