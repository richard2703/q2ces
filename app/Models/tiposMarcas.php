<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tiposMarcas extends Model
{
    use HasFactory;

    protected $table = "tiposMarcas";

    public $timestamps = true;

    protected $fillable = [
        'nombre'
    ];

    public function marcas()
    {
        return $this->belongsToMany(marca::class, 'marcasTipo');
    }
}
