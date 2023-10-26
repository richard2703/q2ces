<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programacionCheckLists extends Model {
    use HasFactory;
    protected $table = 'programacionCheckLists';
    public $timestamps = true;

    protected $fillable = [
        'checkListId',
        'maquinariaId',
        'bitacoraId',
        'personalId',
        'fecha',
        'estatus',
        'comentario'
    ];

}
