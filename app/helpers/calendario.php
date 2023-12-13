<?php

namespace App\Helpers;

use App\Helpers\date;
use Illuminate\Support\Facades\DB;
use DateTime;

use App\Models\tareas;
use App\Models\carga;
use App\Models\descarga;
use App\Models\frecuenciaEjecucion;
use App\Models\maquinaria;
use Symfony\Component\Finder\Iterator\VcsIgnoredFilterIterator;

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

    /**
    * Obtenemos el mes anterior
    *
    * @param [ type ] $month
    * @param [ type ] $year
    * @return void
    */

    public function getMesAnterior( $month, $year ) {
        $date =  array();
        if ( $month == 1 ) {
            $date[ 'month' ] = ( int )12;
            $date[ 'year' ] = ( int )$year - 1;
        } else {
            $date[ 'month' ] = ( int )$month - 1;
            $date[ 'year' ] = ( int )$year;
        }
        return $date;
    }

    /**
    * Obtenemos el dia anterior
    *
    * @param [ type ] $fecha
    * @return void
    */

    public function getDiaAnterior( $fecha ) {

        $date =  date_create( date( 'Y-m-d', strtotime( $fecha . '- 1 days' ) ) );

        return $date;
    }

    /**
    * obtenemos el dia siguiente
    *
    * @param [ type ] $fecha
    * @return void
    */

    public function getDiaSiguiente( $fecha ) {

        $date =   date_create( date( 'Y-m-d', strtotime( $fecha . '+ 1 days' ) ) );

        return $date;
    }

    /**
    * obtenemos el mes siguiente
    *
    * @param [ type ] $month
    * @param [ type ] $year
    * @return void
    */

    public function getMesSiguiente( $month, $year ) {
        $date =  array();
        if ( $month == 12 ) {
            $date[ 'month' ] = ( int )1;
            $date[ 'year' ] = ( int )$year + 1;
        } else {
            $date[ 'month' ] = ( int )$month + 1;
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

    /**
    * Obtiene el nombre del día
    *
    * @param [ type ] $intDay
    * @param boolean $blnCompleto
    * @return void
    */

    function getNameDay( $intDay, $blnCompleto = false ) {
        switch ( ( int )$intDay ) {
            case 1:
            $strDia = ( $blnCompleto == true ? 'Lunes' : 'Lun' );
            break;
            case 2:
            $strDia = ( $blnCompleto == true ? 'Martes' : 'Mar' );
            break;
            case 3:
            $strDia = ( $blnCompleto == true ? 'Miércoles' : 'Mié' );
            break;
            case 4:
            $strDia = ( $blnCompleto == true ? 'Jueves' : 'Jue' );
            break;
            case 5:
            $strDia = ( $blnCompleto == true ? 'Viernes' : 'Vie' );
            break;
            case 6:
            $strDia = ( $blnCompleto == true ? 'Sábado' : 'Sáb' );
            break;
            case 7:
            $strDia = ( $blnCompleto == true ? 'Domingo' : 'Dom' );
            break;

            default:
            # code...
            break;
        }
        return $strDia;
    }

    /**
    * Obtiene el nombre del mes
    *
    * @param [ type ] $intMonth
    * @return void
    */

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

    /**
    * Obtiene los encabezados de los dias de la semana
    */

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
            for (
                $index = 0; $index < ( $iWeek );
                $index++
            ) {
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
        $vctTask =  tareas::where( 'fechaFin', '=',   "'" . $dteDia . "'" )->orderBy( 'titulo', 'asc' )->get();

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
            $intDiferencia = ( int )$intSemanaDiaInicial - $intDiaFecha;

            if ( ( $intSemanaDiaInicial - $intDiaFecha ) == 2 ) {
                $intDiaInicialPeriodo = $intSemanaDiaInicial + $intDiferencia;
                $strMensaje = '2.- El dia de hoy es mayor al día de inicio de la semana, hay diferencia en 2';
            } elseif ( ( $intSemanaDiaInicial - $intDiaFecha ) == 1 ) {
                $intDiaInicialPeriodo = 6;
                $strMensaje = '2.- El dia de hoy es mayor al día de inicio de la semana, hay diferencia en 1';
            } else {
                $intDiaInicialPeriodo = $intSemanaDiaInicial - $intDiaFecha;
                $strMensaje = '2.- El dia de hoy es mayor al día de inicio de la semana';
            }
        }

        $dtFechaInicialPeriodo =   date_create( date( 'Y-m-d', strtotime( $dtFecha->format( 'Y-m-d' )  . '- ' . abs( $intDiaInicialPeriodo ) . ' days' ) ) );
        $dtFechaFinalPeriodo =   date_create( date( 'Y-m-d', strtotime( $dtFechaInicialPeriodo->format( 'Y-m-d' ) . '+ 6 days' ) ) );

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

    /**
    * Obtiene el periodo de trabajo de una bitacora usando la fecha y la frecuencia de ejecución
    *
    * @param date $dtFecha Fecha sobre la que se realiza el calculo del periodo
    * @param integer $intFrecuencia Identificador de frecuencia
    * @return void
    */

    function getPeriodoDeTrabajo( $dtFecha, $intFrecuencia = 1 ) {
        $dtFechaInicialPeriodo = $dtFecha;
        $dtFechaFinalPeriodo = $dtFecha;

        $intDia = $dtFecha->format( 'd' );
        $intMes = $dtFecha->format( 'm' );
        $intMesDias = $dtFecha->format( 'm' );
        $intYear = $dtFecha->format( 'Y' );
        $blnBisiesto = $dtFecha->format( 'L' );
        $intPeriodo = 0;

        $objFrecuencia = frecuenciaEjecucion::select( 'frecuenciaEjecucion.dias' )->where( 'id', '=', $intFrecuencia )->first();

        if ( $objFrecuencia ) {
            switch ( $objFrecuencia->dias ) {
                case 1:
                //*** diaria */
                $dtFechaInicialPeriodo = $dtFecha;
                $dtFechaFinalPeriodo = $dtFecha;
                break;

                case 7:
                //*** semanal */
                $vctFechas = $this->getSemanaTrabajo( $dtFecha, 1 );
                $dtFechaInicialPeriodo = $vctFechas[ 0 ] ;
                $dtFechaFinalPeriodo = $vctFechas[ 1 ] ;
                // dd( $vctFechas );
                break;

                case 15:
                //*** quincenal */
                if ( $intMes == 2 ) {
                    $dtFechaInicialPeriodo = date_create( $intYear . '-' . $intMes .'-' . ( $intDia <= 14 ?    '01'  :     '15' ) );
                    $dtFechaFinalPeriodo = date_create( $intYear . '-' . $intMes .'-' . ( $intDia <= 14 ?    '14'  :  ( $blnBisiesto == 1?'29':'28' ) ) ) ;
                } else {
                    $dtFechaInicialPeriodo = date_create( $intYear . '-' . $intMes .'-' . ( $intDia <= 15 ?    '01'  :     '16' ) );
                    $dtFechaFinalPeriodo = date_create( $intYear . '-' . $intMes .'-' . ( $intDia <= 15 ?    '15'  :     date( 't' ) ) ) ;
                }
                break;

                //*** mensual */
                case 30:
                $dtFechaInicialPeriodo = date_create( $intYear . '-' . $intMes .'-01' );
                $dtFechaFinalPeriodo = date_create( $intYear . '-' . $intMes .'-' . cal_days_in_month( CAL_GREGORIAN, $intMes, $intYear ) ) ;
                break;

                /*** bimestral */
                case 60:
                $intPeriodo = ( int )( $intMes / 2 ) + ( $intMes % 2 ) ;
                $dtFechaInicialPeriodo = date_create( $intYear . '-' . ( ( $intPeriodo*2 )-1 ) .'-01' );
                $dtFechaFinalPeriodo = date_create( $intYear . '-' . ( $intPeriodo*2 ) .'-' . cal_days_in_month( CAL_GREGORIAN, ( $intPeriodo*2 ), $intYear ) ) ;
                break;

                /*** bimestral */
                case 90:
                $intPeriodo = ( int )( $intMes / 3 ) + ( ( $intMes % 3 )>1?1:0 ) ;
                $dtFechaInicialPeriodo = date_create( $intYear . '-' . ( ( $intPeriodo*3 )-2 ) .'-01' );
                $dtFechaFinalPeriodo = date_create( $intYear . '-' . ( $intPeriodo*3 ) .'-' . cal_days_in_month( CAL_GREGORIAN, ( $intPeriodo*3 ), $intYear ) ) ;
                break;

                /*** cuatrimestral */
                case 120:
                $intPeriodo = ( int )( $intMes / 4 ) + ( ( $intMes % 4 )>1?1:0 ) ;
                $dtFechaInicialPeriodo = date_create( $intYear . '-' . ( ( $intPeriodo*4 )-3 ) .'-01' );
                $dtFechaFinalPeriodo = date_create( $intYear . '-' . ( $intPeriodo*4 ) .'-' . cal_days_in_month( CAL_GREGORIAN, ( $intPeriodo*4 ), $intYear ) ) ;

                break;

                /*** semestral */
                case 180:
                $intPeriodo = ( int )( $intMes / 6 ) + ( ( $intMes % 6 )>1?1:0 ) ;
                $dtFechaInicialPeriodo = date_create( $intYear . '-' . ( ( $intPeriodo*6 )-5 ) .'-01' );
                $dtFechaFinalPeriodo = date_create( $intYear . '-' . ( $intPeriodo*6 ) .'-' . cal_days_in_month( CAL_GREGORIAN, ( $intPeriodo*6 ), $intYear ) ) ;

                break;

                /*** anual */
                case 365:
                $dtFechaInicialPeriodo = date_create( $intYear . '-01-01' );
                $dtFechaFinalPeriodo = date_create( $intYear . '-12-31' ) ;

                default:
                # code...
                break;
            }
        } else {

        }
        // dd( 'Días: '. $objFrecuencia->dias,
        // 'Día: '. $intDia,
        // 'Mes: '. $intMes,
        // 'Bisiesto: ' . $blnBisiesto,
        // 'Año: ' . $intYear,
        // $dtFechaInicialPeriodo,
        // $dtFechaFinalPeriodo,
        // $intPeriodo
        // );

        return array( $dtFechaInicialPeriodo, $dtFechaFinalPeriodo );

    }

    /**
    * Obtiene si una fecha esta en el periodo de trabajo
    *
    * @param [ type ] $dtFecha
    * @param integer $intSemanaDiaInicial
    * @return void
    */

    function getEnSemanaDeTrabajo( $dtFecha, $intSemanaDiaInicial = 1 ) {
        $dtToday =  date_create( date( 'Y-m-d' ) );
        $vctSemanaTrabajo = $this->getSemanaTrabajo( $dtToday, 3 );
        $blnEnSemanaDeTrabajo = false;

        if ( $dtFecha >= $vctSemanaTrabajo[ 0 ] && $dtFecha <= $vctSemanaTrabajo[ 1 ] ) {
            $blnEnSemanaDeTrabajo = true;
        }

        /*  dd( 'Fecha', $dtFecha,
        'Inicio',  $vctSemanaTrabajo[ 0 ],
        'Fin',  $vctSemanaTrabajo[ 1 ] );
        */

        return $blnEnSemanaDeTrabajo;

    }

    /**
    * Formatea la fecha
    *
    * @param [ type ] $dtFecha
    * @param boolean $blnUsarDiaCompleto
    * @return void
    */

    function getFechaFormateada( $dtFecha, $blnUsarDiaCompleto = false ) {

        $objCalendar = new Calendario();
        $intDia =  date_format( $dtFecha, 'd' );
        $intDiaNombre = $objCalendar->getNameDay( date_format( $dtFecha, 'N' ), $blnUsarDiaCompleto );
        $intMes = $objCalendar->getNameMonth( date_format( $dtFecha, 'm' ) );
        $intAnio =  date_format( $dtFecha, 'Y' );

        return "$intDiaNombre $intDia de $intMes de $intAnio.";
    }

    /**
    * Formatea la fecha
    *
    * @param [ type ] $dtFecha
    * @param boolean $blnUsarDiaCompleto
    * @return void
    */

    function getPeriodoFormateado( $dtFechaInicio, $dtFechaFin, $blnUsarDiaCompleto = false ) {

        $objCalendar = new Calendario();
        $intDia =  date_format( $dtFechaInicio, 'd' );
        $intDiaNombre = $objCalendar->getNameDay( date_format( $dtFechaInicio, 'N' ), $blnUsarDiaCompleto );
        $intMes = $objCalendar->getNameMonth( date_format( $dtFechaInicio, 'm' ) );
        $intAnio =  date_format( $dtFechaInicio, 'Y' );

        $intDia2 =  date_format( $dtFechaFin, 'd' );
        $intDiaNombre2 = $objCalendar->getNameDay( date_format( $dtFechaFin, 'N' ), $blnUsarDiaCompleto );
        $intMes2 = $objCalendar->getNameMonth( date_format( $dtFechaFin, 'm' ) );
        $intAnio2 =  date_format( $dtFechaFin, 'Y' );

        return "$intDiaNombre $intDia de $intMes de $intAnio al $intDiaNombre2 $intDia2 de $intMes2 de $intAnio2";
    }

    /**
    * Valida si permite o no editar la asistencia de la semana actual usando una fecha seleccionada
    *
    * @param date $dteFecha Fecha a Validar del periodo de la semana de trabajo
    * @param integer $intSemanaDiaInicial El día en que inicia la semana de trabajo
    * @param integer $intSemanaDiaCorte El día en que se realizará el corte para asistencia
    * @return boolean True si se tiene que bloquear, False en caso contrario
    */

    public function getEditarAsistencia( $dteFecha, $intSemanaDiaInicial = 1, $intSemanaDiaCorte = 2 ) {
        $vctDebug = array();
        $blnBloquear = false;

        //*** fecha del día */
        $dtToday =  date_create( date( 'Y-m-d' ) );

        /*** semana de trabajo seleccionada*/
        $vctSemanaTrabajoActual = $this->getSemanaTrabajo( $dtToday, $intSemanaDiaInicial );

        /*** semana de trabajo seleccionada*/
        $vctSemanaTrabajoSeleccionada = $this->getSemanaTrabajo( $dteFecha, $intSemanaDiaInicial );

        //*** estoy dentro del periodo de la semana de trabajo en curso
        $blnEnSemanaEnCurso = $this->getEnSemanaDeTrabajo( $dteFecha, $intSemanaDiaInicial );

        //*** fecha inicial del periodo anterior del periodo actual en curso */
        $dteFechaInicialPeriodoAnterior = date( 'Y-m-d', strtotime( $vctSemanaTrabajoActual[ 0 ]->format( 'Y-m-d' ).'- 1 week' ) );

        $vctDebug[] = 'Fecha: '. $dteFecha->format( 'Y-m-d' );
        $vctDebug[] = 'Inicio semana: '. $intSemanaDiaInicial;
        $vctDebug[] = 'Dia de corte: '. $intSemanaDiaCorte ;
        $vctDebug[] = 'Semana de Trabajo Seleccionada: ' . $vctSemanaTrabajoSeleccionada[ 0 ]->format( 'Y-m-d' ). ' al ' . $vctSemanaTrabajoSeleccionada[ 1 ]->format( 'Y-m-d' ) ;
        $vctDebug[] = 'Semana de Trabajo Actual: ' . $vctSemanaTrabajoActual[ 0 ]->format( 'Y-m-d' ). ' al ' . $vctSemanaTrabajoActual[ 1 ]->format( 'Y-m-d' ) ;
        $vctDebug[] = 'En semana de trabajo: '. $blnEnSemanaEnCurso ;
        $vctDebug[] = 'Fecha inicial periodo anterior al actual: ' . $dteFechaInicialPeriodoAnterior;
        $vctDebug[] = 'Hoy es: '. $dtToday->format( 'Y-m-d' );

        $vctDebug[] = 'VALIDANDO...';

        //*** estamos en el dia de corte maximo */
        if ( $dtToday->format( 'N' ) == $intSemanaDiaCorte ) {
            $vctDebug[] = 'Hoy es el día de corte máximo del periodo anterior:' . $dtToday->format( 'N' );
            //*** validamos si estamos en la semana en curso */
            if ( $vctSemanaTrabajoSeleccionada[ 0 ] < $vctSemanaTrabajoActual[ 0 ] ) {
                $vctDebug[] = 'Estamos en un periodo anterior';
                if ( $vctSemanaTrabajoSeleccionada[ 0 ]->format( 'Y-m-d' ) >= $dteFechaInicialPeriodoAnterior ) {
                    $vctDebug[] = 'Podemos editar el periodo anterior';
                } else {
                    $vctDebug[] = 'Estamos 2 o mas periodos anteriores';
                    $blnBloquear = true;
                }

            } else {

                if ( $blnEnSemanaEnCurso == 1 ) {
                    $vctDebug[] = 'Estamos en la semana en curso';
                    if ( $dteFecha <= $dtToday ) {
                        $vctDebug[] = 'Podemos editar el día';
                    } else {
                        $vctDebug[] = 'No podemos editar, el día es mayor a la fecha de hoy';
                        $blnBloquear=true;
                    }

                } else {
                    $vctDebug[] = 'Ya estamos fuera de la semana en curso';
                    if ( $dteFecha >= $vctSemanaTrabajoSeleccionada[ 0 ] ) {
                        if ( ( $intSemanaDiaInicial + 1 ) == $intSemanaDiaCorte ) {
                            $vctDebug[] = 'Podemos editar, estamos en fecha maxima de corte ';
                        } else {
                            $vctDebug[] = 'Estamos fuera de corte';
                            $blnBloquear = true;

                        }
                    } else {
                        $vctDebug[] = 'Estamos fuera del rango permitido de la semana de corte';
                        $blnBloquear = true;
                    }

                }
            }

        } else {
            $vctDebug[] = 'No es día de corte ' . $dtToday->format( 'N' );
            $blnBloquear=true;
        }
        $vctDebug[] = "Bloquear: " . ($blnBloquear==true?'Sí':'No');

        // dd( $vctDebug );
        return $blnBloquear;

    }

}
