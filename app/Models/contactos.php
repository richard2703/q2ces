<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactos extends Model
{
    use HasFactory;
    protected $table = "contactos";

    public $timestamps = false;

    protected $fillable = [
        'userId', 'nombre', 'particular', 'celular', 'parentesco', 'nombreP', 'nombreM'
    ];
}
