<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedorCategoria extends Model
 {
    use HasFactory;
    protected $table = 'proveedorCategoria';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'comentario',
        'activo'
    ];

    public function proveedores()
    {
        return $this->belongsToMany(proveedor::class, 'provedorCategorias');
    }
}
