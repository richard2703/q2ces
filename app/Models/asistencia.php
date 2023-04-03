<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asistencia extends Model
{
    use HasFactory;
    protected $table = "asistencia";

    public $timestamps = true;

    protected $fillable = [
        'personalId', 'asistenciaId', 'fecha', 'horasExtra'
    ];

}
