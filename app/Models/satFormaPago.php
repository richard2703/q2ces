<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class satFormaPago extends Model {
    use HasFactory;

    protected $table = 'satFormaPago';
    public $timestamps = true;

    protected $fillable = [
        'codigo',
        'nombre',
        'comentario'
    ];

    /**
    * Obtiene el listado de todas las formas de pago
    *
    * @return void Todas las formas de fago
    */
    public static function getListaFormasPago() {

        $vctItems =  satFormaPago::select(
            'satFormaPago.id',
            'satFormaPago.nombre',
            'satFormaPago.codigo',
            DB::raw( "CONCAT(satFormaPago.codigo,' - ', satFormaPago.nombre)as formaPago")
        )
        ->orderBy( 'satFormaPago.codigo', 'asc' )
        ->get();

        return $vctItems;
    }

}
