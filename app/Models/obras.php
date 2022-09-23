<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obras extends Model
{
    use HasFactory;
    protected $table = "obras";
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'tipo', 'calle', 'numero', 'colonia', 'estado', 'ciudad', 'cp', 'logo', 'foto', 'estatus',
    ];
}
