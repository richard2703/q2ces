<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Calendario;

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
    * @param int $checkListId Identificador del registro del CheckList realizado
    * @return void
    */

    public function crearProximoChecklist( $checkListId ) {
        //*** obtenemos el checklist */
        $objRecord = programacionCheckLists::where( 'checkListId', '=', $checkListId )->first();
        $intResultado = 0;
        $objCalendar = new Calendario();
        $vctDebug = array();

        if ( $objRecord ) {
            //*** obtenemos los dias de ejecución de la bitacoras */
            $objBitacora = bitacoras::select( 'bitacoras.*', 'frecuenciaEjecucion.dias' )
            ->join( 'frecuenciaEjecucion', 'frecuenciaEjecucion.id', 'bitacoras.frecuenciaId' )
            ->where( 'bitacoras.id', '=', $objRecord->bitacoraId )->first();
            $vctDebug[] = 'Frecuencia de ejecución ' .$objBitacora->dias;

            //*** verificamos que se pueda renovar el checklist */
            if ( $objBitacora && $objBitacora->renovacion == 1 ) {
                $intDias = $objBitacora->dias;

                $vctDebug[] = 'Verificación de existencia de un registro en la planeación';

                //*** obtenemos el periodo proximo de ejecución del checklist */
                $vctDiasPeriodo = $objCalendar->getPeriodoDeTrabajo( date_create( date( 'Y-m-d', strtotime( $objRecord->fecha . '+ '. $intDias .' days' ) ) ), $objBitacora->frecuenciaId );
                $strFechaInicioPeriodo = $vctDiasPeriodo[ 0 ];
                $strFechaFinPeriodo = $vctDiasPeriodo[ 1 ];

                $vctDebug[] = 'Periodo inicia: '. $strFechaInicioPeriodo->format( 'Y-m-d' )  ;
                $vctDebug[] = 'Periodo termina: '. $strFechaFinPeriodo->format( 'Y-m-d' )  ;

                //*** hay que verificar si existe una reprogramacion  */
                $objExiste = programacionCheckLists::where( 'maquinariaId', '=', $objRecord->maquinariaId )
                ->where( 'bitacoraId', '=', $objRecord->bitacoraId )
                ->whereBetween( 'programacionCheckLists.fecha',   [ $strFechaInicioPeriodo, $strFechaFinPeriodo ] )
                ->first();

                if ( ! $objExiste ) {
                    $objProg =  $objRecord->replicate();
                    //*** preguntamos si la fecha es domingo para agregar un día mas */
                    $intDiaSemana = ( date( 'w', strtotime( $objRecord->fecha . '+ '. $intDias .' days' ) ) == 0? $intDias+1 : $intDias ) ;

                    $objProg->checkListId = null;
                    $objProg->estatus = 1;
                    $objProg->comentario = 'Programación automática';
                    $objProg->fecha =  date( 'Y-m-d', strtotime( $objRecord->fecha . '+ '. $intDiaSemana .' days' ) )  ;
                    $objProg->save();

                    $vctDebug[] = 'No existe registro en la planeación y se agrego' ;
                    $intResultado = 1;
                } else {
                    $intResultado = 0;
                    $vctDebug[] = 'Ya existe un registro en la planeación';
                }

            } else {
                $vctDebug[] = 'La bitacorá no genera un registro en la planeación';
            }

        }else{
            $vctDebug[] = 'El registro no existe';
            $intResultado = 0;
        }
        // dd( $vctDebug );
        return $intResultado;

    }
}
