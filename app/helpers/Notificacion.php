<?php

namespace App\Helpers;

use App\Models\notificaciones;
use stdClass;

/**
* Clase para generar operaciones de notificación de información
*/

class Notificacion {

    /**
    * Registra una notificación en el sistema
    *
    * @param int $personalId Identificador del personal que será notificado
    * @param string $strTitulo Titulo de la Notificación
    * @param string $strDetalle Detalle de la notificación
    * @param string $modulo Modulo o bloque donde se genera
    * @param string $accion Acción que se realiza
    * @param string $recordId Número de registro del modulo que será notificado
    * @return void
    */

    public function registrar( $personalId, $strTitulo, $strDetalle, $modulo, $accion,  $recordId ) {

        $intValor = trim( $personalId );
        $objItem = new stdClass;
        $vctMensajes = array();

        $blnError  = false;

        if ( is_numeric( trim( $personalId ) ) == false ) {
            $blnError = true;
            $vctMensajes[] = 'No existe registro de personal';
        }

        if ( is_numeric( trim( $recordId ) ) == false ) {
            $vctMensajes[] = 'Se redirige a index de sección';
        }

        if ( $blnError == false ) {
            $objRecord = new notificaciones();
            $objRecord->personalId = $personalId;
            $objRecord->titulo = $strTitulo;
            $objRecord->detalle = $strDetalle;
            $objRecord->modulo = $modulo;
            $objRecord->accion = $accion;
            $objRecord->recordId = $recordId;
            $objRecord->save();

            $objItem->recordId =  $objRecord->id;
            $blnError = false;
            $vctMensajes[] = 'Notificación registrada correctamente.';
        }

        $objItem->error = $blnError;
        $objItem->mensajes = $vctMensajes;

        return $objItem;

    }

    /**
    * Crea el enlace al registro de una notificacion
    *
    * @param string $strModulo
    * @param string $strAccion
    * @param int $intId
    * @return void
    */

    public function getEnlaceRegistro( $strModulo, $strAccion, $intId ) {
        $strResult = null;
        $blnSinId = false;

        if ( is_numeric( trim( $intId ) ) == false ) {
            $blnSinId = true;
        }

        switch ( strtolower( $strModulo ) ) {
            case 'servicios':
            switch ( strtolower( $strAccion ) ) {
                case 'nuevo':
                # code...
                break;

                default:
                # code...
                break;
            }
            break;

            default:
            $strResult = '';
            break;
        }

        return $strResult;
    }

}
