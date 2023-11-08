<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkList extends Model {
    use HasFactory;
    protected $table = 'checkList';

    public $timestamps = true;

    protected $fillable = [
        'bitacoraId','estatus', 'maquinariaId', 'usuarioId', 'registrada', 'comentario','usoKom'
    ];
}
