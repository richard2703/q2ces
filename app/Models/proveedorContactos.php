<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedorContactos extends Model
 {
    use HasFactory;
    protected $table = 'proveedorContactos';

    public $timestamps = false;

    protected $fillable = [
        'proveedorId',
        'nombre',
        'telefono',
        'email',
    ];

}
