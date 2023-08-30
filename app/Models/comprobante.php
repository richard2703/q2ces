<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comprobante extends Model
{
    use HasFactory;
    protected $table = "comprobante";

    public $timestamps = false;

    protected $fillable = [
          'nombre', 'comentario'
    ];
}
