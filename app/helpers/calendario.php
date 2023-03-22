<?php

namespace App\Helpers;

use App\Models\tareas;
use App\Models\carga;
use App\Models\descarga;
use App\Models\maquinaria;
use Illuminate\Support\Facades\DB;
use DateTime;

class Calendario {
    /**
    * Obtiene todos los días de un mes especificado tomando en cuenta el año
    * @param int $month Mes a consultar
    * @param int $year Año a consultar
    * @return array
    */
    public static function getDaysInMonth( $month, $year ) {
        $num = cal_days_in_month( CAL_GREGORIAN, $month, $year );
        $dates_month = array();
        for ( $i = 1; $i <= $num; $i++ ) {
            $mktime = mktime( 0, 0, 0, $month, $i, $year );
            $date = date( 'Y-m-d', $mktime );
            $dates_month[ $i ] = $date;
        }
        return $dates_month;
    }


    public function getMesAnterior( $month, $year){
        $date=  array();
        if($month == 1){
            $date['month']=(int)12;
            $date['year']=(int)$year-1;
            
        }else{$date['month']=(int)$month-1;
            $date['year']=(int)$year;

        }
        return $date;

    }
    public function getMesSiguiente( $month, $year){
        $date=  array();
        if($month == 12){
            $date['month']=(int)1;
            $date['year']=(int)$year+1;
            
        }else{$date['month']=(int)$month+1;
            $date['year']=(int)$year;

        }
        return $date;
    }

    /**
     * Obtiene el numero de de dias del mes del año enviados
     *
     * @param int $month El mes
     * @param int $year El año
     * @return void
     */
    public function getTotalDaysInMonth( $month, $year ) {
        return count( $this->getDaysInMonth( $month, $year ) );
    }

    function getNameMonth( $intMonth ) {

        switch ( ( int )$intMonth ) {
            case 1:
            $strMes = 'Enero';
            break;
            case 2:
            $strMes = 'Febrero';
            break;
            case 3:
            $strMes = 'Marzo';
            break;
            case 4:
            $strMes = 'Abril';
            break;
            case 5:
            $strMes = 'Mayo';
            break;
            case 6:
            $strMes = 'Junio';
            break;
            case 7:
            $strMes = 'Julio';
            break;
            case 8:
            $strMes = 'Agosto';
            break;
            case 9:
            $strMes = 'Septiembre';
            break;
            case 10:
            $strMes = 'Octubre';
            break;
            case 11:
            $strMes = 'Noviembre';
            break;
            case 12:
            $strMes = 'Diciembre';
            break;

            default:
            # code...
            break;
        }
        return $strMes;
    }

    function getDaysWeekCalendar() {
        $days = null;
        $aDays = [ 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado' ];

        foreach ( $aDays as $value ) {
            $days .= '<h5 class="col-sm p-1 text-center">' . $value . '</h5>';
        }

        return '<div class="row d-none d-sm-flex p-1 bg-dark text-white">' . $days . '</div>';
    }

    function getDayOnWeek( $day ) {
        //*** check day in week
        $dDay = new DateTime( $day );
        $iWeek = $dDay->format( 'w' );
        return $iWeek;
    }

    function getStartWeek( $day ) {
        $cols = null;
        //*** check day in week
        $iWeek = $this->getDayOnWeek( $day );
        if ( $iWeek > 0 ) {
            for ( $index = 0; $index < ( $iWeek );
            $index++ ) {
                $cols .= '<div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">';
                $cols .= '   <h5 class="row align-items-center">';
                $cols .= '       <span class="date col-1"></span>';
                $cols .= '       <small class="col d-sm-none text-center text-muted">Saturday</small>';
                $cols .= '       <span class="col-1"></span>';
                $cols .= '   </h5>';
                $cols .= '   <p class="d-sm-none"></p>';
                $cols .= '</div>';
            }
        } else {
            $cols = '';
        }
        return $cols;
    }

    function getEndWeek( $day ) {
        $cols = null;
        //*** check day in week
        $iWeek = $this->getDayOnWeek( $day );

        if ( $iWeek < 6 ) {
            for ( $index = $iWeek; $index < 6; $index++ ) {
                $cols .= '<div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">';
                $cols .= '   <h5 class="row align-items-center">';
                $cols .= '       <span class="date col-1"></span>';
                $cols .= '       <small class="col d-sm-none text-center text-muted">Saturday</small>';
                $cols .= '       <span class="col-1"></span>';
                $cols .= '   </h5>';
                $cols .= '   <p class="d-sm-none"></p>';
                $cols .= '</div>';
            }
        } else {
            $cols = '';
        }
        return $cols;
    }

    function getTareasDelDia( $dteDia ) {
        $vctTasks = null;
        $strTareas = 'Sin tareas';
        $vctTask =  tareas::where( 'fechaFin', '=',   "'". $dteDia . "'" )->orderBy( 'titulo', 'asc' )->get();

        if ( $vctTask->isEmpty() == false ) {
            dd( 'Vacio' );
            return  '';
        } else {
            foreach ( $vctTask as $tarea ) {
                dd( $tarea );
                return '<a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-info text-white" title="Test Event 1">Test Event 1</a>';
            }
        }
    }
}
