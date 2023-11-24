<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provedorCategorias extends Model
{
    use HasFactory;

    protected $table = "provedorCategorias";

    public $timestamps = false;

    protected $fillable = [
        'proveedor_id', 'proveedor_categoria_id'
    ];
}
