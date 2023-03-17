<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userEstatus extends Model
 {
    use HasFactory;
    protected $table = 'userEstatus';
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'color', 'comentario'
    ];
}
