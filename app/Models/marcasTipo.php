<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marcasTipo extends Model
{
    use HasFactory;

    protected $table = "marcasTipo";

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'marcaId'
    ];
}
