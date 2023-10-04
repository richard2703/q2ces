<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obraMaqPerHistorico extends Model {
    use HasFactory;
    protected $table = 'obraMaqPerHistorico';

    public $timestamps = true;

    protected $fillable = [
        'maquinariaId', 'personalId', 'obraId', 'inicio', 'fin', 'combustible', 'usuarioId','comentario'
    ];

    public function registraHistorico( $objOperMaqPer, $strComentario = '---' ) {
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
            $objRecord->comentario = $strComentario;
            // dd( $objRecord );
            $objRecord->save();
            $blnExito = true;
        }

        return   $blnExito ;

    }

}
