<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ajustesCisternas extends Model
{
    use HasFactory;
    protected $table = "ajustesCisternas";
    public $timestamps = true;

    protected $fillable = [
        'tipoCisternaId', 'contenidoTeorico', 'contenidoReal'
    ];
}
