<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventarioEstatus extends Model
{
    use HasFactory;
    protected $table = 'inventarioEstatus';
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'color', 'comentario'
    ];
}
