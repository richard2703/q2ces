<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use stdClass;

class personal extends Model
{
    use HasFactory;
    protected $table = 'personal';

    public $timestamps = true;

    protected $fillable = [
        'userId', 'nombres', 'apellidoP', 'apellidoM', 'fechaNacimiento', 'lugarNacimiento', 'curp', 'fine', 'rfc', 'licencia',
        'cpf', 'ine', 'cpe', 'sexo', 'civil', 'hijos', 'sangre', 'calle', 'numero', 'colonia', 'estado', 'ciudad', 'cp', 'particular',
        'celular', 'mailpersonal', 'mailEmpresarial', 'casa', 'foto', 'aler', 'profe', 'interior', 'estatusId', 'personalId',
        'puestoNivelId', 'tipoLicencia', 'puestoId'
    ];

    /**
     * Get the user's full concatenated name.
     * -- Must postfix the word 'Attribute' to the function name
     *
     * @return string
     */

    public function getFullnameAttribute()
    {
        return "{$this->nombres} {$this->apellidoP} {$this->apellidoM}";
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getFullLastNameAttribute()
    {
        return "{$this->apellidoP} {$this->apellidoM}, {$this->nombres}";
    }


    /**
     * Obtiene el personal por el tipo de Nivel de puesto
     *
     * @param integer $intPuestoNivelId Identificador del tipo de nivel de puesto
     * @param boolean $blnMostrarPuesto True para mostrar el puesto del personal, False en caso contrario
     * @return void Todo el personal del Nivel de puesto solicitados y que estan activos
     */
    public static function getPersonalPorNivel($intPuestoNivelId, $blnMostrarPuesto = false)
    {
        $vctPersonal = null;
        if ($intPuestoNivelId > 0) {

            $vctPersonal = personal::select(
                'personal.id',
                'personal.nombres',
                'personal.apellidoP',
                'personal.apellidoM',
                DB::raw("CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as nombreCompleto"),
                ($blnMostrarPuesto == false ? DB::raw("CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal") : DB::raw("CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM,' [ ' , puesto.nombre , ' ]')as personal")),
                'obras.nombre AS obra',
                'maquinaria.identificador',
                'maquinaria.nombre AS auto',
                'nomina.puestoId',
                'puesto.nombre AS puesto',
                'puesto.puestoNivelId',
                'personal.estatusId',
                'puestoNivel.nombre AS puestoNivel'
            )
                ->join('nomina', 'nomina.personalId', 'personal.id')
                ->join('puesto', 'puesto.id', 'nomina.puestoId')
                ->join('puestoNivel', 'puestoNivel.id', 'puesto.puestoNivelId')
                ->leftjoin('obraMaqPer', 'obraMaqPer.personalId', 'personal.id')
                ->leftjoin('maquinaria', 'maquinaria.id', "=", 'obraMaqPer.maquinariaId')
                ->leftjoin('obras', 'obras.id', "=", 'obraMaqPer.obraId')
                ->where('puesto.puestoNivelId', "=", $intPuestoNivelId)
                ->where('personal.estatusId', "=", 1)
                ->orderBy('personal.nombres', "asc")->get();
        }
        return $vctPersonal;
    }

    /**
     * Obtiene la lista de asistencia de todo el personal activo ordenada por el nombre
     *
     * @param int $intAnio Año
     * @param int $intMes Mes
     * @param int $intDia Día
     *
     * @return array Un arreglo con todo el personal activo para asistencia
     */
    public static function getListaAsistenciaPersonal($intAnio = null, $intMes = null, $intDia = null)
    {

        if ($intAnio != '' && $intMes != '' && $intDia != '') {
            //*** hay parametros */
            $strDate = $intAnio . '-' . $intMes . '-' . $intDia;
        } else {
            //*** el día actual */
            $strDate = date('Y-m-d');
        }

        $listaAsistencia = personal::select(
            'personal.id',
            'personal.nombres',
            'personal.apellidoP',
            'personal.apellidoM',
            DB::raw("CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal"),
            DB::raw('nomina.nomina AS numNomina'),
            DB::raw('nomina.hEntrada AS horarioEntrada'),
            DB::raw('nomina.hSalida AS horarioSalida'),
            DB::raw('nomina.hEntradaSabado AS horarioEntradaSabado'),
            DB::raw('nomina.hSalidaSabado AS horarioSalidaSabado'),
            DB::raw('puesto.nombre AS puesto'),
            DB::raw('puestoNivel.nombre AS puestoNivel'),
            DB::raw('nomina.ingreso AS fechaIngreso'),
            DB::raw('userEstatus.nombre AS estatus'),
            DB::raw('userEstatus.color AS estatusColor')
        )
            ->join('nomina', 'nomina.personalId', 'personal.id')
            ->join('userEstatus', 'userEstatus.id', 'personal.estatusId')
            ->join('puesto', 'puesto.id', 'nomina.puestoId')
            ->join('puestoNivel', 'puestoNivel.id', 'puesto.puestoNivelId')
            ->where('puestoNivel.requiereAsistencia', "=", 1)
            ->where('userEstatus.id', "=", 1)
            ->where('personal.estatusId', "=", 1)
            ->where('nomina.ingreso', "<=", $strDate)
            ->orderBy('personal.apellidoP', "asc")->get();

        // dd($strDate, $listaAsistencia);
        return $listaAsistencia;
    }

    /**
     * Obtiene todos los registros de asistencia de una fecha determinada
     *
     * @param int $intAnio Año
     * @param int $intMes Mes
     * @param int $intDia Día
     * @return void
     */
    public static function getAsistenciaDia($intAnio = null, $intMes = null, $intDia = null)
    {

        if ($intAnio != '' && $intMes != '' && $intDia != '') {
            //*** hay parametros */
            $strDate = $intAnio . '-' . $intMes . '-' . $intDia;
        } else {
            //*** el día actual */
            $strDate = date('Y-m-d');
        }

        $asistencias = personal::select(
            'personal.*',
            'asistencia.*',
            DB::raw('puesto.nombre AS puesto'),
            DB::raw('puestoNivel.nombre AS puestoNivel'),
            DB::raw('userEstatus.nombre AS estatus'),
            DB::raw('userEstatus.color AS estatusColor'),
            DB::raw('nomina.nomina AS numNomina'),
            DB::raw('nomina.hEntrada AS horarioEntrada'),
            DB::raw('nomina.hSalida AS horarioSalida'),
            DB::raw('nomina.hEntradaSabado AS horarioEntradaSabado'),
            DB::raw('nomina.hSalidaSabado AS horarioSalidaSabado'),
            DB::raw('nomina.ingreso AS fechaIngreso'),
            DB::raw('asistencia.id AS recordId'),
            DB::raw('asistencia.entradaAnticipada'),
        )
            ->join('nomina', 'nomina.personalId', "=", 'personal.id')
            ->join('puesto', 'puesto.id', "=", 'nomina.puestoId')
            ->join('puestoNivel', 'puestoNivel.id', "=", 'puesto.puestoNivelId')
            ->join('userEstatus', 'userEstatus.id', "=", 'personal.estatusId')
            ->join('asistencia', 'asistencia.personalId', "=", 'personal.id')
            ->where('puestoNivel.requiereAsistencia', "=", 1)
            ->where('userEstatus.id', "=", 1)
            // ->where( 'nomina.ingreso', '<=', $strDate )
            ->where('asistencia.fecha', "=", $strDate)
            ->orderBy('personal.apellidoP', "asc")->get();

        return $asistencias;
    }

    /**
     * Undocumented function
     *
     * @param date $dteHEntrada Hora de Entrada
     * @param date $dteHorarioEntrada Horario de Entrada
     * @param boolean $blnEntradaAnticipada Hora anticipada de Entrada
     * @param date $dteHSalida Hora de Salida
     * @param date $dteHorarioSalida Horario de Salida
     * @return object $objTiempoExtra un objeto con la información del tiempo extra
     */
    public static function getCalculaTiempoExtra($dteHEntrada, $dteHorarioEntrada, $blnEntradaAnticipada,  $dteHSalida, $dteHorarioSalida)
    {

        $vctDebug = array();
        $objTiempoExtra = new stdClass;

        //*** calculamos tiempo extra anticipado */
        $horasAnticipada = 0;
        $horasDescuento = 0;
        $horasExtra = 0;
        $intMinutos = 0;

        $dteHorario =   Carbon::parse($dteHorarioEntrada);
        $dteHoraEntrada =  Carbon::parse($dteHEntrada);
        $vctDebug[] = 'Hora entrada: ' . $dteHEntrada;
        $vctDebug[] = 'Horario entrada: ' . $dteHorarioEntrada;
        $vctDebug[] = 'Entrada anticipada: ' . $blnEntradaAnticipada;

        $dteHorarioSalida = Carbon::parse($dteHorarioSalida);
        $dteHoraSalida = Carbon::parse($dteHSalida);
        $vctDebug[] = 'Hora salida: ' . $dteHSalida;
        $vctDebug[] = 'Horario salida: ' . $dteHorarioSalida;


        $vctDebug[] = 'TIEMPO ANTICIPADO';
        if ($blnEntradaAnticipada == 1) {
            $intMinutosA = 0;

            //*** preguntamos si la entrada es menor que la hora salida */
            if ($dteHoraEntrada < $dteHorario) {
                $intMinutosA = $dteHoraEntrada->diffInMinutes($dteHorario);
                $vctDebug[] = '- Tengo tiempo anticipado ' . $intMinutosA . ' minutos';
            } else {
                $vctDebug[] = '- No tengo tiempo anticipado';
            }

            $horasAnticipada = $intMinutosA;
        } else {
            $vctDebug[] = '- Sin tiempo anticipado' .  $horasAnticipada;
            $horasAnticipada = 0;
        }
        $vctDebug[] = '- Tiempo anticipado total: ' . $horasAnticipada;


        $vctDebug[] = 'TIEMPO RETRASO ENTRADA';
        //*** calculamos tiempo de retraso de entrada */
        $horasRetraso = 0;
        //*** preguntamos si la entrada es menor que la hora salida */
        if ($dteHoraEntrada > $dteHorario) {
            $horasRetraso = $dteHoraEntrada->diffInMinutes($dteHorario);
            $vctDebug[] = '- Tengo un retraso de ' . $horasRetraso . ' minutos';
        } else {
            $vctDebug[] = '- Sin retraso';
        }
        $vctDebug[] = '- Tiempo retraso total: ' .  $horasRetraso;


        $vctDebug[] = 'TIEMPO EXTRA';
        //*** obtenemos los minutos de diferencia */
        if (is_null($dteHorarioSalida) == false &&  is_null($dteHSalida) == false) {

            $dteHorarioSalida =   Carbon::parse($dteHorarioSalida);
            $dteHoraSalida =  Carbon::parse($dteHSalida);

            //*** preguntamos si la salida es mayor que la hora salida */
            if ($dteHoraSalida > $dteHorarioSalida) {
                $intMinutos = $dteHoraSalida->diffInMinutes($dteHorarioSalida);
                $vctDebug[] = '- Tengo tiempo extra ' . $intMinutos  . ' minutos';
            } else {
                $vctDebug[] = '- No tengo tiempo extra';
            }
        } else {
            //*** se marca en 0 y se marca que no aplica */
            $vctDebug[] = '- Sin hora de salida registrada';
            $horasExtra = 0;
        }


        $vctDebug[] = 'TIEMPO DESCUENTO';
        //*** validamos el descuento de tiempo de retraso */
        if ($horasRetraso > 0) {
            $vctDebug[] = '- Se aplica descuento de tiempo por retraso de entrada';
            $horasDescuento = ($intMinutos - $horasRetraso);
        } else {
            $vctDebug[] = '- Sin descuento de tiempo por retraso de entrada';
            $horasDescuento = 0;
        }
        $vctDebug[] = '- Tiempo descuento total: ' .  $horasDescuento;


        //*** obtenemos las horas extras a pagar */
        $intHoras = (int) (($intMinutos + $horasAnticipada) / 60);
        $intHorasFraccionadas = (int) (($intMinutos + $horasAnticipada) >= 35 ? 1 : 0);

        $totalHorasExtra =  (int) $intHoras + $intHorasFraccionadas;

        $vctDebug[] = 'RESUMEN';
        $vctDebug[] = "Minutos extra: " . $intMinutos;
        $vctDebug[] = "Minutos anticipados: " . $horasAnticipada;
        $vctDebug[] = "Horas completas: " . (int) (($intMinutos + $horasAnticipada) / 60);
        $vctDebug[] = "Horas fraccionadas: " . (int) (($intMinutos + $horasAnticipada) >= 35 ? 1 : 0);
        $vctDebug[] = "Horas extras totales: " . (int) $totalHorasExtra;

        $objTiempoExtra->horasExtra = $intMinutos;
        $objTiempoExtra->totalHorasExtra = $totalHorasExtra;
        $objTiempoExtra->horasRetraso = $horasRetraso;
        $objTiempoExtra->horasAnticipada = $horasAnticipada;
        $objTiempoExtra->horasDescuento = $horasDescuento;

        // dd($vctDebug, $objTiempoExtra);

        return $objTiempoExtra;
    }
}
