<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marca extends Model
{
    use HasFactory;
    protected $table = "marca";

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'comentario', 'activo',
    ];

    public function tiposMarcas()
    {
        return $this->belongsToMany(tiposMarcas::class, 'marcasTipo');
    }
}
