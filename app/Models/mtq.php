<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mtq extends Model
{
    use HasFactory;
    protected $table = "mtq";

    public $timestamps = true;

    protected $fillable = [
        'foto', 'nombre', 'marca', 'modelo', 'submarca', 'año', 'color', 'placas', 'numeroEconomico', 'Vin', 'NumeroMotor'
    ];
}
