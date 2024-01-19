<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class satMetodoPago extends Model
{
    use HasFactory;

    protected $table = 'satMetodoPago';
    public $timestamps = true;

    protected $fillable = [
        'codigo',
        'nombre',
        'comentario'
    ];

    /**
    * Obtiene el listado de todos los métodos de pago
    *
    * @return void Todos los métodos de pago
    */
    public static function getListaMetodosPago() {

        $vctItems =  satMetodoPago::select(
            'satMetodoPago.id',
            'satMetodoPago.nombre',
            'satMetodoPago.codigo',
            DB::raw( "CONCAT(satMetodoPago.codigo,' - ', satMetodoPago.nombre)as metodoPago")
        )
        ->orderBy( 'satMetodoPago.codigo', 'asc' )
        ->get();

        return $vctItems;
    }
}
