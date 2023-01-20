<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class residente extends Model
{
    use HasFactory;
    protected $table = "residente";

    public $timestamps = false;

    protected $fillable = [
        'userId','obraId', 'nombre', 'email', 'empresa','puesto','telefono','firma','publicado'
    ];
}
