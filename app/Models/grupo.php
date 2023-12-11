<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grupo extends Model {
    use HasFactory;
    protected $table = 'grupo';

    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'comentario',
        'imagen',
        'activo'
    ];
}
