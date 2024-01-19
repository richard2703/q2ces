<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class satUsoCfdi extends Model {
    use HasFactory;

    protected $table = 'satUsoCfdi';
    public $timestamps = true;

    protected $fillable = [
        'codigo',
        'nombre',
        'comentario'
    ];

    /**
    * Obtiene el listado de todos los Uso de CFDI
    *
    * @return void Todas las formas de CFDI
    */
    public static function getListaUsosCfdi() {

        $vctItems =  satUsoCfdi::select(
            'satUsoCfdi.id',
            'satUsoCfdi.nombre',
            'satUsoCfdi.codigo',
            DB::raw( "CONCAT(satUsoCfdi.codigo,' - ', satUsoCfdi.nombre)as usoCfdi" )
        )
        ->orderBy( 'satUsoCfdi.codigo', 'asc' )
        ->get();

        return $vctItems;
    }
}
