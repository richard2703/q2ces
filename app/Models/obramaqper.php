<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\obraMaqPerHistorico;
use stdClass;

class obraMaqPer extends Model {
    use HasFactory;
    protected $table = 'obraMaqPer';

    public $timestamps = false;

    protected $fillable = [
        'maquinariaId', 'personalId', 'obraId', 'inicio', 'fin', 'combustible'
    ];

    /**
    * Realiza el proceso de registro de un movimiento de maquinaria y operador dentro de una obra
    *
    * @param integer $intMaquinariaId Identificador de Maquinaria
    * @param integer $intOperadorId Identificador del Personal
    * @param integer $intObraId Identificador de la Obra, 1 por Defecto para el Centro de Control
    * @param integer $intRecord Identificador del registro en tabla, 0 si no existe
    * @param boolean $blnCombustible True si requiere combustible, False en caso contrario
    * @param date $dteFechaInicio Fecha de inicio del movimiento
    * @param date $dteFechaFin Fecha de Fin del movimiento
    * @return array $objResult
    */

    public function registraMovimiento( $intMaquinariaId, $intOperadorId = 0, $intObraId = 1, $intRecord = 0,  $blnCombustible = false, $dteFechaInicio = null, $dteFechaFin = null ) {
        $vctDebug = array();
        $objHistorico = new obraMaqPerHistorico();
        $objResult = new stdClass;
        $objResult->exito = false;
        $objResult->error = 0;
        $objResult->mensaje = 'Ok';

        if ( is_numeric( $intMaquinariaId ) == false ) {
            $objResult->error = 1;
            $objResult->mensaje = 'Se requiere el parámetro $intMaquinariaId';
            return $objResult;
        }

        if ( is_numeric( $intObraId ) == false   ) {
            $intObraId = 1;
            //*** lo mandamos al centro de control */
            dd( 'QUE paso?' . $intObraId );
        }

        $objMaquinaria = obraMaqPer::where( 'maquinariaId', $intMaquinariaId )->first();
        $objOperador = obraMaqPer::where( 'personalId', $intOperadorId )->first();
        $objRecord = null;

        if ( $intRecord == 0 ) {
            //****************** NO EXISTE UN REGISTRO PREVIO ************************* */
            $vctDebug[] = 'Sin registro asignado';

            //*** preguntamos si la maquinaria esta asignada */
            if ( $objMaquinaria ) {
                $vctDebug[] = 'La maquinaria ya esta asignada, obraId->'. $objMaquinaria->obraId;

                if ( $objOperador ) {
                    $vctDebug[] = 'El operador ya esta asignado en otra maquinaria, obraId->'. $objOperador->obraId;
                    $vctDebug[] = 'El operador se debe de liberar de la otra maquinaria, obraId->'. $objOperador->obraId;

                    $objOperador->eliminarReferenciaDeOperador( $objOperador->id ) ;

                    $strOperadorId = $objOperador->personalId;
                    $objOperador->personalId = null;
                    $objOperador->save()  ;
                    $objHistorico->registraHistorico( $objMaquinaria, 'Se actualizo el registro: ' . $objOperador->id . ' se libera al operadorId->'. $strOperadorId
                    . " que se asigna a Record->maquinariaId->$objMaquinaria->maquinariaId" ) ;

                    $objMaquinaria->personalId = $intOperadorId;
                    $objMaquinaria->combustible =  $blnCombustible;
                    $objMaquinaria->inicio = $dteFechaInicio;
                    $objMaquinaria->fin = $dteFechaFin;
                    $objMaquinaria->save();
                    $objHistorico->registraHistorico( $objMaquinaria, 'Se actualizo el registro: ' . $objMaquinaria->id . ' con los datos:'
                    . " Record->maquinariaId->$objMaquinaria->maquinariaId,"
                    . " Record->operadorId->$objMaquinaria->personalId " ) ;

                    $vctDebug[] = 'El operador se asigna a la maquinaria, obraId->'. $objMaquinaria->obraId;

                } else {
                    $vctDebug[] = 'El operador no esta asignado...';
                    $vctDebug[] = 'Se actualiza el registro de Movimiento existente de maquinariaId->' . $objMaquinaria->maquinariaId .
                    ', se libera el operadorId->' .  $objMaquinaria->personalId .
                    ' y se asigna el operadorId->' . $intOperadorId;

                    // $objMaquinaria->maquinariaId = $intMaquinariaId;
                    $objMaquinaria->personalId = $intOperadorId;
                    $objMaquinaria->combustible =  $blnCombustible;
                    $objMaquinaria->inicio = $dteFechaInicio;
                    $objMaquinaria->fin = $dteFechaFin;
                    $objMaquinaria->save();
                    $objHistorico->registraHistorico( $objMaquinaria, 'Se actualizo el registro: ' . $objMaquinaria->id . ' con los datos:'
                    . " Record->maquinariaId->$objMaquinaria->maquinariaId,"
                    . " Record->operadorId->$objMaquinaria->personalId " ) ;

                }

            } else {
                $vctDebug[] = 'La maquinaria no esta asignada...';

                if ( $objOperador ) {
                    $vctDebug[] = 'El operador ya esta asignado en otra maquinaria, obraId->'. $objOperador->obraId;
                    //*** preguntamos si hay cambio */

                } else {
                    $vctDebug[] = 'El operador no esta asignado...';
                    $vctDebug[] = 'Se crea nuevo registro de Movimiento...';

                    $objRecord = new obraMaqPer();
                    $objRecord->obraId = $intObraId;
                    //*** centro de control de q2ces */
                    $objRecord->maquinariaId = $intMaquinariaId;
                    $objRecord->personalId = ( $intOperadorId != 0 ? $intOperadorId : null );
                    $objRecord->combustible = $blnCombustible;
                    $objRecord->inicio = $dteFechaInicio;
                    $objRecord->fin = $dteFechaFin;
                    $objRecord->save();
                    $objHistorico->registraHistorico( $objRecord, 'Se creo el registro: ' . $objRecord->id . ' con los datos:' .
                    " Record->maquinariaId->$objRecord->maquinariaId," .
                    ( $intOperadorId != 0 ?  " Record->operadorId->$objRecord->personalId " : ' Sin operador asignado' ) ) ;

                    $vctDebug[] = ( 'Se creo el registro: ' . $objRecord->id );
                    $vctDebug[] = $objRecord;
                }

            }

        } else {
            //****************** EXISTE UN REGISTRO PREVIO ************************* */
            $objRecord = obraMaqPer::where( 'id', $intRecord )->first();
            $vctDebug[] = 'Con registro asignado';

            if ( $objRecord ) {
                $vctDebug[] = 'Existe el registro, obraId->'. $objRecord->obraId;
            }

            //*** preguntamos si la maquinaria esta asignada */
            if ( $objMaquinaria ) {
                $vctDebug[] = 'La maquinaria ya esta asignada, obraId->'. $objMaquinaria->obraId;

                if ( $objOperador ) {
                    $vctDebug[] = 'Ya hay registro de operador...';
                    if ( $objOperador->obraId != $intObraId ) {

                        $vctDebug[] = 'Cambiamos de obra...';
                        $strObraId = $objRecord->obraId;
                        $objRecord->obraId = $intObraId;
                        $objRecord->combustible =  $blnCombustible;
                        $objRecord->inicio = $dteFechaInicio;
                        $objRecord->fin = $dteFechaFin;
                        $objRecord->save();
                        $objHistorico->registraHistorico( $objRecord, 'Se actualizo el registro: ' . $objRecord->id . ', se cambio de la obraId->'.$strObraId.' a la obraId->'. $intObraId ) ;
                        $vctDebug[] = $objRecord;

                    } else {
                        $vctDebug[] = 'Es la misma maquinaria...';

                        $strOperadorId = $objRecord->personalId;
                        $objRecord->combustible =  $blnCombustible;
                        $objRecord->inicio = $dteFechaInicio;
                        $objRecord->fin = $dteFechaFin;
                        $objRecord->save();
                        $objHistorico->registraHistorico( $objRecord, 'Se actualizo el registro: ' . $objRecord->id . ' con la siguiente información combustible->'. ( $blnCombustible == 1?1:0 ) ) ;
                        $vctDebug[] = 'Se actualizo la información de los datos';

                    }

                } elseif ( $intOperadorId == 0 ) {
                    //*** no hay cambio de operador */
                    $vctDebug[] = 'No hay cambio de operador...';

                    if ( $objRecord->obraId !=  $intObraId ) {
                        $vctDebug[] = 'Cambiamos de obra...';
                        $strObraId = $objRecord->obraId;
                        $objRecord->obraId = $intObraId;
                        $objRecord->combustible =  $blnCombustible;
                        $objRecord->inicio = $dteFechaInicio;
                        $objRecord->fin = $dteFechaFin;
                        $objRecord->save();
                        $objHistorico->registraHistorico( $objRecord, 'Se actualizo el registro: ' . $objRecord->id . ', se cambio de la obraId->'.$strObraId.' a la obraId->'. $intObraId ) ;
                        $vctDebug[] = $objRecord;
                    }
                } else {
                    $vctDebug[] = 'No hay registro de operador...';
                    if ( $objRecord->maquinariaId == $objMaquinaria->maquinariaId ) {
                        $vctDebug[] = 'Es la misma maquinaria...';
                        $strPersonalId =  $objRecord->personalId;
                        ($intObraId1=0?$objRecord->obraId = $intObraId :'');
                        $objRecord->personalId = $intOperadorId;
                        $objRecord->combustible =  $blnCombustible;
                        $objRecord->inicio = $dteFechaInicio;
                        $objRecord->fin = $dteFechaFin;
                        $objRecord->save();
                        $objHistorico->registraHistorico( $objRecord, 'Se actualizo el registro: ' . $objRecord->id . ', se cambio de operadorId->'.$strPersonalId.' al operadorId->' . $intOperadorId ) ;
                        $vctDebug[] = $objRecord;
                    }
                }

            } else {

                $vctDebug[] = 'La maquinaria no esta asignada...';

                if ( $objOperador ) {
                    $vctDebug[] = 'El operador ya esta asignado en otra maquinaria, obraId->' . $objOperador->obraId ;

                    //*** es el mismo registro */
                    if ( $objRecord->id == $objOperador->id ) {
                        $vctDebug[] = 'Es el mismo registro, solo se asigna maquinaria distinta....';

                        if ( $objRecord->maquinariaId == $intMaquinariaId ) {
                            $vctDebug[] = 'Es la misma maquinaria....';
                        } else {
                            $vctDebug[] = 'Maquinarias distintas....';
                            $strMaquinariaId = $objRecord->maquinariaId;
                            $objRecord->maquinariaId = $intMaquinariaId;
                            $objRecord->combustible =  $blnCombustible;
                            $objRecord->inicio = $dteFechaInicio;
                            $objRecord->fin = $dteFechaFin;
                            $objRecord->save();
                            $objHistorico->registraHistorico( $objRecord, 'Se actualizo el registro: ' . $objRecord->id . ', se cambio de la maquinariaId-> a la maquinariaId-> $intMaquinariaId' ) ;
                            $vctDebug[] = $objRecord;

                        }

                    } else {
                        $vctDebug[] = 'Son obras distintas...';

                    }

                } else {
                    $vctDebug[] = 'El operador no esta asignado...';
                    $vctDebug[] = 'Se crea nuevo registro de Movimiento...';
                }
            }

        }

        $objResult->debug =  $vctDebug;

        //  dd( "MaquinariaId->$intMaquinariaId", "OperadorId->$intOperadorId", "ObraId->$intObraId", "Record->$intRecord", $vctDebug );

        return $objResult;

    }

    /**
    * Elimina la referencia de un operador en registro de maquinaria y obra
    *
    * @param integer $intRecord El id del registro de donde se elimina la referencia del operador
    * @return void
    */

    public function eliminarReferenciaDeOperador( $intRecord ) {
        $vctDebug = array();
        $objHistorico = new obraMaqPerHistorico();
        $objResult = new stdClass;
        $objResult->exito = false;
        $objResult->error = 0;
        $objResult->mensaje = 'Ok';

        $objHistorico = new obraMaqPerHistorico();
        $objRecord = obraMaqPer::where( 'id', $intRecord )->first();
        $vctDebug[] = 'Buscamos el registro...';

        if ( $objRecord ) {
            $strOperadorId = $objRecord->personalId;
            $objRecord->personalId = null;
            $objRecord->save();
            $objHistorico->registraHistorico( $objRecord, 'Se actualizo el registro: ' . $objRecord->id . ' se libera al operadorId->'. $strOperadorId ) ;

        } else {
            $vctDebug[] = 'No existe el registro...';
        }

        return  $objResult;
    }

    public function actualizarDatosRegistro( $intRecord, $blnCombustible = false, $dteFechaInicio = null, $dteFechaFin = null ) {
        $vctDebug = array();
        $objHistorico = new obraMaqPerHistorico();
        $objResult = new stdClass;
        $objResult->exito = false;
        $objResult->error = 0;
        $objResult->mensaje = 'Ok';

        $objHistorico = new obraMaqPerHistorico();
        $objRecord = obraMaqPer::where( 'id', $intRecord )->first();
        $vctDebug[] = 'Buscamos el registro...';

        if ( $objRecord ) {
            $strOperadorId = $objRecord->personalId;
            $objRecord->combustible =  $blnCombustible;
            $objRecord->inicio = $dteFechaInicio;
            $objRecord->fin = $dteFechaFin;
            $objRecord->save();
            $objHistorico->registraHistorico( $objRecord, 'Se actualizo el registro: ' . $objRecord->id . ' con la siguiente información combustible->'. ( $blnCombustible == 1?1:0 ) ) ;

        } else {
            $vctDebug[] = 'No existe el registro...';
        }

        return  $objResult;
    }

    // private function registraDenegarMovimiento( $intMaquinariaId, $intOperadorId = 0, $intObraId = 1, $intRecord = 0 ) {
    //     $vctDebug = array();

    //     $objResult = new stdClass;
    //     $objResult->exito = false;
    //     $objResult->error = 0;
    //     $objResult->mensaje = 'Ok';

    //     if ( is_numeric( $intMaquinariaId ) == false ) {
    //         $objResult->error = 1;
    //         $objResult->mensaje = 'Se requiere el parámetro $intMaquinariaId';
    //         return $objResult;
    //     }

    //     if ( $intRecord == 0 ) {
    //         $vctDebug[] = 'Sin registro asignado';

    //     } else {
    //         $objRecord = obraMaqPer::where( 'id', $intRecord )->first();
    //         $vctDebug[] = 'Con registro asignado';
    //     }

    //     $objResult->debug =  $vctDebug;

    //     dd( "MaquinariaId->$intMaquinariaId", "OperadorId->$intOperadorId", "ObraId->$intObraId", "Record->$intRecord", $vctDebug );

    //     return $objResult;

    // }

}
