<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkList extends Model {
    use HasFactory;
    protected $table = 'checkList';

    public $timestamps = true;

    protected $fillable = [
        'bitacoraId', 'estatus', 'maquinariaId', 'usuarioId', 'registrada', 'comentario', 'usoKom'
    ];

    /**
    * Crea el proximo registro de un checklist Ejecutado
    *
    * @param [ type ] $checkListId
    * @return void
    */

    public function crearProximoChecklist( $checkListId ) {
        //*** obtenemos el checklist */
        $objRecord = programacionCheckLists::where( 'checkListId', '=', $checkListId )->first();
        $intResultado = 0;

        if ( $objRecord ) {
            //*** obtenemos los dias de ejecución de la bitacoras */
            $objBitacora = bitacoras::select( 'bitacoras.*', 'frecuenciaEjecucion.dias' )
            ->join( 'frecuenciaEjecucion', 'frecuenciaEjecucion.id', 'bitacoras.frecuenciaId' )
            ->where( 'bitacoras.id', '=', $objRecord->bitacoraId )->first();

            //*** verificamos que se pueda renovar el checklist */
            if ( $objBitacora && $objBitacora->renovacion == 1 ) {
                $intDias = $objBitacora->dias;

                //*** hay que verificar si existe una reprogramacion  */
                $objExiste = programacionCheckLists::where( 'maquinariaId', '=', $objRecord->maquinariaId )
                ->where( 'bitacoraId', '=', $objRecord->bitacoraId )
                ->where( 'fecha', '>', $objRecord->fecha )
                ->first();

                if ( ! $objExiste ) {
                    $objProg =  $objRecord->replicate();
                    //*** preguntamos si la fecha es domingo para agregar un día mas */
                    $intDiaSemana = ( date( 'w', strtotime( $objRecord->fecha . '+ '. $intDias .' days' ) ) == 0? $intDias+1 : $intDias ) ;

                    $objProg->checkListId = null;
                    $objProg->estatus = 1;
                    $objProg->comentario = 'Programación automática';
                    $objProg->fecha =  date( 'Y-m-d', strtotime( $objRecord->fecha . '+ '. $intDiaSemana .' days' ) )  ;
                    // $objProg->save();

                    // dd( $intDias, $objProg );
                    $intResultado = 1;
                } else {
                    $intResultado = 0;
                    // dd( 'Existe un registro' );
                }

            }

        }
        return $intResultado;

    }
}
