<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obraMaqPerHistorico extends Model {
    use HasFactory;
    protected $table = 'obraMaqPerHistorico';

    public $timestamps = true;

    protected $fillable = [
        'maquinariaId', 'personalId', 'obraId', 'inicio', 'fin', 'combustible', 'usuarioId'
    ];

    public function registraHistorico( $objOperMaqPer ) {
        $blnExito = false;

        if ( $objOperMaqPer ) {
            $objRecord = new obraMaqPerHistorico();

            $objRecord->usuarioId = auth()->user()->id;
            $objRecord->maquinariaId = $objOperMaqPer->maquinariaId;
            $objRecord->personalId = $objOperMaqPer->personalId;
            $objRecord->obraId = $objOperMaqPer->obraId;
            $objRecord->combustible = $objOperMaqPer->combustible;
            $objRecord->inicio = $objOperMaqPer->inicio;
            $objRecord->fin = $objOperMaqPer->fin;
            // dd( $objRecord );
            $objRecord->save();
            $blnExito = true;
        }

        return   $blnExito ;

    }

}
