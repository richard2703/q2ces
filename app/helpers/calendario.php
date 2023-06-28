<?php

namespace App\Helpers;

use App\Helpers\date;
use Illuminate\Support\Facades\DB;
use DateTime;

use App\Models\tareas;
use App\Models\carga;
use App\Models\descarga;
use App\Models\maquinaria;

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

    public function getMesAnterior( $month, $year ) {
        $date =  array();
        if ( $month == 1 ) {
            $date[ 'month' ] = ( int )12;
            $date[ 'year' ] = ( int )$year-1;

        } else {
            $date[ 'month' ] = ( int )$month-1;
            $date[ 'year' ] = ( int )$year;

        }
        return $date;

    }

    public function getDiaAnterior( $fecha ) {

        $date =  date_create( date( 'Y-m-d', strtotime( $fecha .'- 1 days' ) ) );

        return $date;

    }

    public function getDiaSiguiente( $fecha ) {

        $date =   date_create( date( 'Y-m-d', strtotime( $fecha .'+ 1 days' ) ) );

        return $date;

    }

    public function getMesSiguiente( $month, $year ) {
        $date =  array();
        if ( $month == 12 ) {
            $date[ 'month' ] = ( int )1;
            $date[ 'year' ] = ( int )$year+1;

        } else {
            $date[ 'month' ] = ( int )$month+1;
            $date[ 'year' ] = ( int )$year;

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

    function getNameDay( $intDay ) {
        switch ( ( int )$intDay ) {
            case 1:
            $strDia = 'Lunes';
            break;
            case 2:
            $strDia = 'Martes';
            break;
            case 3:
            $strDia = 'Miércoles';
            break;
            case 4:
            $strDia = 'Jueves';
            break;
            case 5:
            $strDia = 'Viernes';
            break;
            case 6:
            $strDia = 'Sábado';
            break;
            case 7:
            $strDia = 'Domingo';
            break;

            default:
            # code...
            break;
        }
        return $strDia;
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
        $aDays = [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ];

        foreach ( $aDays as $value ) {
            $days .= '<h5 class="col-sm p-1 text-center">' . $value . '</h5>';
        }

        return '<div class="row d-none d-sm-flex p-1 cabeceraDias">' . $days . '</div>';
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
                $cols .= '<div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted celda" style="height: 110px;">';
                $cols .= '   <p class="row align-items-center celda">';
                $cols .= '       <span class="date col-1"></span>';
                $cols .= '       <small class="col d-sm-none text-center text-muted">Saturday</small>';
                $cols .= '       <span class="col-1"></span>';
                $cols .= '   </p>';
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
                $cols .= '<div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted" style="height: 110px;">';
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

    /**
    * Obtiene el periodo de la semana de trabajo
    *
    * @param date $dtFecha La fecha sobre la que se calcula la semana de trabajo
    * @param integer $intSemanaDiaInicial El día en que empieza la semana ( por defecto 1 = lunes )
    * @return array Arreglo con la el periodo de fechas de la semana de trabajo
    */

    function getSemanaTrabajo( $dtFecha, $intSemanaDiaInicial = 1 ) {

        //** obtenemos el numero de dia de la fecha */
        $intDiaFecha =  ( int ) $dtFecha->format( 'N' );

        $intDiaInicialPeriodo = null;
        $intDiaFinalPeriodo = null;
        $dtFechaInicialPeriodo = null;
        $dtFechaFinalPeriodo = null;
        $intDiferencia = null;
        $strMensaje = null;

        if ( $intDiaFecha >  $intSemanaDiaInicial ) {
            //*** el día seleccionado es mayor que el día de inicio y se le resta al dia seleccionado */
            $intDiaInicialPeriodo =  $intDiaFecha - $intSemanaDiaInicial;
            $strMensaje = '1.- El dia de hoy es menor al día de inicio de la semana';
        } else {
            //*** el día inicial es mayor que el día en curso y se le resta al dia en curso */
            $intDiferencia = ( int )$intSemanaDiaInicial - $intDiaFecha ;

            if ( ( $intSemanaDiaInicial - $intDiaFecha ) == 2 ) {
                $intDiaInicialPeriodo = $intSemanaDiaInicial + $intDiferencia ;
                $strMensaje = '2.- El dia de hoy es mayor al día de inicio de la semana, hay diferencia en 2';
            } elseif ( ( $intSemanaDiaInicial - $intDiaFecha ) == 1 ) {
                $intDiaInicialPeriodo = 6 ;
                $strMensaje = '2.- El dia de hoy es mayor al día de inicio de la semana, hay diferencia en 1';
            } else {
                $intDiaInicialPeriodo = $intSemanaDiaInicial - $intDiaFecha ;
                $strMensaje = '2.- El dia de hoy es mayor al día de inicio de la semana';
            }
        }

        $dtFechaInicialPeriodo =   date_create( date( 'Y-m-d', strtotime( $dtFecha->format( 'Y-m-d' )  .'- '. abs ( $intDiaInicialPeriodo ) .' days' ) ) );
        $dtFechaFinalPeriodo =   date_create( date( 'Y-m-d', strtotime( $dtFechaInicialPeriodo->format( 'Y-m-d' ) .'+ 6 days' ) ) );

        // dd( 'Fecha recibida dtFecha: '. $dtFecha->format( 'Y-m-d' ),
        // 'Dia Fecha recibida intDiaFecha: ' . $intDiaFecha,
        // 'Dia inicio de semana intSemanaDiaInicial: ' . $intSemanaDiaInicial,
        // 'Diferencia intDiferencia: ' . $intDiferencia,
        // 'Dia inicial del periodo intDiaInicialPeriodo: '. $intDiaInicialPeriodo,
        // 'Dia final del periodo intDiaFinalPeriodo: '. $intDiaFinalPeriodo,
        // $dtFechaInicialPeriodo,  $dtFechaFinalPeriodo,
        // 'Debug: '. $strMensaje );

        return array( $dtFechaInicialPeriodo, $dtFechaFinalPeriodo );

    }

    function getFechaFormateada( $dtFecha ) {

        $objCalendar = new Calendario();
        $intDia =  date_format( $dtFecha, 'd' );
        $intDiaNombre = $objCalendar->getNameDay( date_format( $dtFecha, 'N' ) );
        $intMes = $objCalendar->getNameMonth( date_format( $dtFecha, 'm' ) );
        $intAnio =  date_format( $dtFecha, 'Y' );

        return "$intDiaNombre $intDia de $intMes de $intAnio.";
    }
}
