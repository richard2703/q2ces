<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bitacorasEquipos extends Model
{
    use HasFactory;
    protected $table = 'bitacorasEquipos';

    public $timestamps = true;

    protected $fillable = [
        'bitacoraId', 'maquinariaId'
    ];
}
