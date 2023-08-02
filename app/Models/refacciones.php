<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class refacciones extends Model {
    use HasFactory;
    protected $table = 'refacciones';

    public $timestamps = true;

    protected $fillable = [
        'nombre', 'marcaId', 'maquinariaId', 'tipoRefaccionId', 'numeroParte', 'comentario', 'activo'
    ];

}
