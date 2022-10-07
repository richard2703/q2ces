<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maquinaria extends Model
{
    use HasFactory;
    protected $table = "maquinaria";

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'tipo', 'categoria', 'marca', 'submarca', 'modelo', 'uso', 'color', 'placas', 'motor',
        'nummotor', 'numserie', 'vin', 'capacidad', 'tanque', 'ejes', 'rinD', 'rinT', 'llantaD', 'llantaT', 'aceitemotor',
        'aceitetras', 'aceitehidra', 'filtroaceite', 'filtroaire', 'bujias', 'tipobujia', 'horometro', 'kilometraje', 'kom', 'foto',
        'ano', 'aceitedirec', 'combustible'
    ];
}