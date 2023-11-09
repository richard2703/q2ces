<?php

namespace App\Helpers;

use App\Models\checkList;
use App\Models\bitacoras;
use App\Models\grupo;
use App\Models\grupoBitacoras;
use App\Models\grupoTareas;
use App\Models\tarea;

use Illuminate\Support\Facades\DB;

class checkListPresentacion {

    public function getControlByType( $strControl, $strTarea, $intTareaId, $intConsecutivo ) {

        $strCodigoControl = null;

        switch ( strtolower( $strControl ) ) {
            case 'text':
            $strCodigoControl =  '<input type="text" class="inputCaja" id="control'. $intConsecutivo . '" name="resultado'. $intTareaId . '" required value="" placeholder="Ej. Escribe el texto aquí">';
            break;

            case 'number':
            $strCodigoControl =  '<input type="number" step="1" min="1"  class="inputCaja text-end" id="control'. $intConsecutivo . '" name="resultado'. $intTareaId . '" required value="" placeholder="Ej. 1234">';
            break;

            case 'date':
            $strCodigoControl = '<input type="date" class="inputCaja" id="control'. $intConsecutivo . '" name="resultado'. $intTareaId . '" required value="">';
            break;

            case 'radio':
            # code...
            break;

            case 'select':
            # code...
            break;

            case 'label':
            default:
            $strCodigoControl = '<label class="labelTitulo" id="control'. $intConsecutivo . '" name="resultado'. $intTareaId . '" value="">'. $strTarea . '</label>';

            break;
        }

        return $strCodigoControl;

    }

    /**
    * Obtiene el control html a desplegar para un checklist
    *
    * @param integer $intTareaId El identificador de la tarea a trabajar
    * @param string $strResultadoControl El valor que se presentará en el control
    * @param string $strValorControl El valor que se buscará en el control
    * @param integer $intConsecutivo El valor del campo ID del control html que será publicado
    * @return string Texto html con el control configurado
    */

    public function getControlByTarea( $intTareaId, $strResultadoControl = null, $strValorControl = null,  $intConsecutivo = null ) {

        $vctDebug = array();
        $vctItems = array();
        $strCodigoControl = null;
        $objTarea =   tarea::select(
            'tarea.*',
            DB::raw( 'tareaCategoria.nombre AS categoria' ),
            DB::raw( 'tareaTipo.nombre AS tipo' ),
            DB::raw( 'tareaUbicacion.nombre AS ubicacion' ),
            DB::raw( 'tipoValorTarea.controlHtml' ),
            DB::raw( 'tipoValorTarea.codigo' ),
        )
        ->join( 'tipoValorTarea', 'tipoValorTarea.id', '=', 'tarea.tipoValorId' )
        ->join( 'tareaCategoria', 'tareaCategoria.id', '=', 'tarea.categoriaId' )
        ->join( 'tareaTipo', 'tareaTipo.id', '=', 'tarea.tipoId' )
        ->join( 'tareaUbicacion', 'tareaUbicacion.id', '=', 'tarea.ubicacionId' )
        ->where( 'tarea.id', '=', $intTareaId )
        ->first();

        // dd( $intTareaId, $strValorControl, $intConsecutivo, $objTarea );
        if ( $objTarea ) {
            $strLeyenda = ' title="' . $objTarea->leyenda . '"';
            $strUnidadMedida =  ( $objTarea->requiereUnidadMedida == 1 ?   "<label class='labelUnidadMedida'>". $objTarea->unidadMedida .'</label><br>'  : '' ) ;
            $strImagen =  ( $objTarea->requiereImagen == 1 ?   '<span class="mi-archivo">'.
                                                                '<input class="mb-4 ver" type="file" name="foto'. $intTareaId . '" id="control'. $intConsecutivo . 'Img" accept="image/*">'.
                                                                '</span>'.
                                                                '<label for="control'. $intConsecutivo . 'Img" style="font-size: 14px;
                                                                font-weight: 600;
                                                                color: #fff;
                                                                background-color: #A6CE34;
                                                                display: inline-block;
                                                                transition: all .5s;
                                                                cursor: pointer;
                                                                padding: 15px 40px !important;
                                                                text-transform: uppercase;
                                                                width: 50%;
                                                                text-align: center;"><span>Sube Imagen</span></label>' : '' ) ;

            switch ( strtolower( $objTarea->controlHtml ) ) {
                case 'text':
                $strCodigoControl =  '<input type="text" class="inputCaja" minlength="8" maxlength="200" '.
                ' id="control'. $intConsecutivo . '"' .
                ' name="resultado'. $intTareaId . '" ' .
                $strLeyenda .
                ' required value="'. $strResultadoControl . '" '.
                ' placeholder="Ej. Escribe el texto aquí" >';
                $strCodigoControl .= $strImagen;

                $vctDebug[] = $strCodigoControl ;
                break;

                case 'number':
                $strStep = ( $objTarea->tipoValorId == 4 ? ' step="0.01" ':' step="1" ' );
                $strPlaceHolder = ( $objTarea->tipoValorId == 4 ? ' placeholder="Ej. 1234.01" ':' placeholder="Ej. 1234" ' );
                $strMinimo = ( $objTarea->requiereLimites == 1 ? ' min="'.  $objTarea->limiteInferior . '" ':' min="0.0" ' );
                $strMaximo = ( $objTarea->requiereLimites == 1 ? ' max="'.  $objTarea->limiteSuperior . '" ':' max="1000000" ' );

                $strCodigoControl =  '<input type="number" ' .
                $strMinimo .
                $strMaximo .
                $strStep .
                $strLeyenda .
                $strPlaceHolder. ' pattern="\d*"  class="inputCaja text-end" id="control'. $intConsecutivo . '" name="resultado'. $intTareaId . '" required value="'. $strResultadoControl . '">' . $strUnidadMedida . $strImagen;
                break;

                case 'date':
                $strMinimo = ( $objTarea->tipoValorId == 4 ? ' min="2000-01-01" ':'' );
                $strMaximo = ( $objTarea->tipoValorId == 4 ? ' max="2023-12-31" ':' ' );
                $strCodigoControl = '<input type="date" class="inputCaja" id="control'. $intConsecutivo . '" name="resultado'. $intTareaId . '" required value="'. $strResultadoControl . '" ' .
                $strLeyenda .
                $strMinimo .
                $strMaximo . ' pattern="\d{4}-\d{2}-\d{2}">' . $strImagen;

                $vctDebug[] = $strCodigoControl ;
                break;

                case 'radio':
                $vctItems = explode( ',', $objTarea->codigo );

                if ( is_array( $vctItems ) && count( $vctItems )>0 ) {

                    $intOpcion = 0;
                    foreach ( $vctItems as $item ) {
                        $aValue = explode( '=>', $item ) ;
                        $strCodigoControl .=  '<div>' .
                        '<input type="radio"'.
                        'id="control'. $intConsecutivo . $intOpcion .'"'.
                        'name="resultado'. $intTareaId . '[]"'.
                        'value="'. $intOpcion .'"' .
                        ( $strValorControl == $intOpcion   ? ' checked' : '' ) . '>' .
                        '<label for="control'. $intConsecutivo . $intOpcion .'" '. $strLeyenda .'>' .  $aValue[ 1 ] . '</label>' .
                        '</div>';
                        $intOpcion += 1;

                    }

                    $strCodigoControl .= $strImagen;
                } else {
                    $strCodigoControl = "<label class='labelTitulo'>Algo salio MAL con la tarea->$objTarea->nombre, favor de revisar!!!</label>";
                }
                $vctDebug[] = $strCodigoControl ;
                break;

                case 'select':
                $vctItems = explode( ',', $objTarea->codigo );
                $strItems = null;
                foreach ( $vctItems as $item ) {
                    $aValue = explode( '=>', $item ) ;

                    $strItems .= '<option value="'.$aValue[ 0 ] . '"'. ( $item[ 0 ] == $strValorControl ? ' selected' : '' ).'>'.$aValue[ 1 ].'</option>' ;
                }

                $strCodigoControl = '<select class="form-select"  aria-label="Default select example" id="control'. $intConsecutivo . '"' . $strLeyenda .
                ' name="resultado'. $intTareaId . '" required>' .
                '<option value="">Seleccione</option>' .
                $strItems .
                '</select>' . $strImagen;

                $vctDebug[] = $strCodigoControl ;
                break;

                case 'label':
                default:
                $strCodigoControl = '<label id="control'. $intConsecutivo . '">'. $objTarea->leyenda . '</label>';
                $strCodigoControl .= $strImagen;

                $vctDebug[] = $strCodigoControl ;
                break;
            }
        } else {
            $strCodigoControl = "<label class = 'labelTitulo'>Algo salio MAL!!!</label>";
        }

        // dd( $vctDebug, $objTarea );
        return $strCodigoControl;

    }

    public function etiquetaValor( $intValor, $intTareaId ) {

        $vctDebug = array();
        $objTarea =   tarea::select(
            'tarea.*',
            DB::raw( 'tareaCategoria.nombre AS categoria' ),
            DB::raw( 'tareaTipo.nombre AS tipo' ),
            DB::raw( 'tareaUbicacion.nombre AS ubicacion' ),
            DB::raw( 'tipoValorTarea.controlHtml' ),
            DB::raw( 'tipoValorTarea.codigo' ),
        )
        ->join( 'tipoValorTarea', 'tipoValorTarea.id', '=', 'tarea.tipoValorId' )
        ->join( 'tareaCategoria', 'tareaCategoria.id', '=', 'tarea.categoriaId' )
        ->join( 'tareaTipo', 'tareaTipo.id', '=', 'tarea.tipoId' )
        ->join( 'tareaUbicacion', 'tareaUbicacion.id', '=', 'tarea.ubicacionId' )
        ->where( 'tarea.id', '=', $intTareaId )
        ->first();

        $vctDebug[] = 'intValor->' . $intValor .'intTareaId->' . $intTareaId;

        $strResultado = '';
        if ( $objTarea ) {
            $vctDebug[] = 'Hay tarea...';
            $vctItems = explode( ',', $objTarea->codigo );
            $blnEncontrado = false;
            $vctDebug[] = 'Hay items...';
            $vctDebug[] =  $vctItems;

            if ( is_array( $vctItems ) && count( $vctItems )>0 ) {
                //*** buscamos en el array */
                foreach ( $vctItems as $valores ) {

                    $vctDebug[] = 'Checamos el elemento ' . $valores;
                    $aValue = explode( '=>', $valores );

                    if ( is_array( $aValue ) && count( $aValue )>0 ) {

                        $vctDebug[] = 'Tiene opciones...';
                        $vctDebug[] =  $aValue;

                        $vctDebug[] = $intValor. ' = ' . $aValue[ 0 ] ;
                        if ( $intValor == ( int ) $aValue[ 0 ] ) {
                            $vctDebug[] = 'Encontre el valor buscado'.  $strResultado ;
                            $strResultado = $aValue[ 1 ];
                            $blnEncontrado == true;
                        } else {
                            $vctDebug[] = 'No esta el valor buscado' ;

                        }
                    }

                    if ( $blnEncontrado == true ) {
                        $vctDebug[] = 'Hay que salir';
                        break;
                    }

                }
            } else {
                $vctDebug[] = 'No hay items...';
            }

        } else {
            $vctDebug[] = 'No hay tarea...';
        }

        // dd( $vctDebug );

        return  $strResultado;
    }

    /**
    * Obtiene el control html a desplegar para un checklist
    *
    * @param integer $intTipoValorTarea El tipo de valor a trabajar
    * @param string $strValorControl El valor que se presentará en el control
    * @param integer $intIdContador El valor del campo ID del control html que será publicado
    * @return void
    */

    public function getControlValor( $intTipoValorTarea, $strValorControl = null, $intIdContador = null ) {

        $strInput = "<label>$strValorControl</label>";

        switch ( $intTipoValorTarea ) {
            case 1:
            # etiqueta tipo label...
            $strInput = "<label>$strValorControl</label>";
            break;

            default:
            # code...
            break;
        }

        return $strInput;
    }

}
