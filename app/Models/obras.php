<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obras extends Model {
    use HasFactory;
    protected $table = 'obras';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'tipo',
        'calle',
        'numero',
        'colonia',
        'estado',
        'ciudad',
        'cp',
        'logo',
        'foto',
        'estatus',
        'clienteId',
        'centroCostos',
        'proyecto'
    ];

    /**
    * Obtiene el listado de todas las Obras
    *
    * @param boolean $blnActivas True para mostrar solo las obras activas, False para mostrar todas las obras (activas y no activas).
    * @return void Todas las obras de acuerdo a su estatus
    */
    public static function getListaObras( $blnActivas = true ) {

        $vctItems =  obras::select(
            'obras.id',
            'obras.nombre',
            'obras.nombre AS obra',
        );

        if ( $blnActivas == true ) {
            //*** solo las activas */
            $vctItems = $vctItems->where( 'obras.estatus', '=', 1 );
        }

        $vctItems = $vctItems->orderBy( 'obras.nombre', 'asc' )
        ->get();

        return $vctItems;
    }

}
