<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actividades extends Model
{
    use HasFactory;
    protected $table = "actividades";

    public $timestamps = true;

    protected $fillable = [
        'userId',
        'personalId',
        'title',
        'start',
        'end',
        'prioridad',
        'estadoId',
        'descripcion',
    ];
}
