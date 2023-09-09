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

    public function getControl( $strControl, $strTarea, $intTareaId, $intConsecutivo ) {

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

}
