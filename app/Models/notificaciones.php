<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notificaciones extends Model
 {
    use HasFactory;
    protected $table = 'notificaciones';

    public $timestamps = true;

    protected $fillable = [
        'titulo',
        'detalle',
        'visto',
        'userId',
        'modulo',
        'accion',
        'recordId',
    ];
}
