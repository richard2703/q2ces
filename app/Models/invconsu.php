<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invconsu extends Model
{
    use HasFactory;
    protected $table = "invconsu";
    public $timestamps = true;

    protected $fillable = [
        'productoId', 'tipo', 'cantidad', 'desde', 'hasta', 'comentarios', 'maquinariasDesde', 'maquinariasHasta'
    ];


    public function maquinariasDesde()
    {
        return $this->belongsTo(maquinaria::class, 'desde');
    }

    public function maquinariasHasta()
    {
        return $this->belongsTo(maquinaria::class, 'hasta');
    }
}
