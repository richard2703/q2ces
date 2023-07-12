<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tareaTipo extends Model
{
    use HasFactory;
    protected $table = "tareaTipo";

    public $timestamps = false;

    protected $fillable = [
          'nombre', 'comentario'
    ];
}
