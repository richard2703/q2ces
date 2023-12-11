<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obrasServicios extends Model
{
    use HasFactory;

    protected $table = "obrasServicios";
    public $timestamps = true;

    protected $fillable = [
        'obraId', 'conceptoId', 'precio'
    ];
}
