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


    public function getControl( $strControl  ) {

        return $strControl;

    }


}
