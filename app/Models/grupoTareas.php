<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grupoTareas extends Model {
    use HasFactory;
    protected $table = 'grupoTareas';

    public $timestamps = true;

    protected $fillable = [
        'bitacoraId', 'tareaId'
    ];
}
