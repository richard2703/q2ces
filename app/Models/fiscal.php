<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fiscal extends Model
{
    use HasFactory;
    protected $table = "fiscal";
    public $timestamps = false;

    protected $fillable = [
        'personaId', 'calle', 'colonia', 'cp', 'entre', 'estado', 'interior', 'localidad', 'municipio', 'numero', 'tipo'
    ];
}
