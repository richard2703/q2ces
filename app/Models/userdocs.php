<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userdocs extends Model
{
    use HasFactory;
    protected $table = "userdocs";

    public $timestamps = true;

    protected $fillable = [
        'personalId', 'ruta', 'tipo', 'fechaVencimiento', 'estatus', 'comentarios', 'requerido'
    ];
}
