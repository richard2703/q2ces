<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedor extends Model
{
    use HasFactory;
    protected $table = "proveedor";

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'razonSocial', 'rfc', 'calle', 'exterior', 'interior', 'colonia', 'estado', 'ciudad', 'cp', 'logo', 'estatus', 'categoriaId', 'comentario'
    ];
}
