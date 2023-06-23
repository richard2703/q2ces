<?php

namespace App\Helpers;

use App\Models\carga;
use App\Models\descarga;
use App\Models\maquinaria;
use App\Models\cajachica;
use Illuminate\Support\Facades\DB;

class Calculos {

    /**
    * Obtiene el total de cargas de un equipo o en general
    *
    * @param integer $intMaquinaria Identificador del equipo a consultar, 0 es el general
    * @return float el Total de los litros de carga registrados
    */

    public function getTotalLitrosCargas( $intMaquinaria = 0 ) {
        $total = 0;
        if ( $intMaquinaria == 0 ) {
            //*** en general */
            $objLitros = carga::select(
                DB::raw( 'sum(carga.litros)as litros' )
            )
            ->groupby( 'carga.maquinariaId' )->first();
        } else {
            /*** en particular */
            $objLitros = carga::select(
                DB::raw( 'sum(carga.litros)as litros' )
            )
            ->where( 'carga.maquinariaId', '=', $intMaquinaria )
            ->groupby( 'carga.maquinariaId' )->first();
        }

        if ( $objLitros ) {
            $total = $objLitros->litros;
        } else {
            $total = 0;
        }

        return $total;
    }
    /**
    * Obtiene el total de decargas de un equipo o en general
    *
    * @param integer $intMaquinaria Identificador del equipo a consultar, 0 es el general
    * @return float el Total de los litros descargados registrados
    */

    public function getTotalLitrosDescargas( $intMaquinaria = 0 ) {
        $total = 0;
        if ( $intMaquinaria == 0 ) {
            //*** en general */
            $objLitros = descarga::select(
                DB::raw( 'sum(descarga.litros)as litros' )
            )
            ->groupby( 'descarga.maquinariaId' )->first();
        } else {
            /*** en particular */
            $objLitros = descarga::select(
                DB::raw( 'sum(descarga.litros)as litros' )
            )
            ->where( 'descarga.maquinariaId', '=', $intMaquinaria )
            ->groupby( 'descarga.maquinariaId' )->first();
        }

        if ( $objLitros ) {
            $total = $objLitros->litros;
        } else {
            $total = 0;
        }

        return $total;
    }

    /**
    * Obtiene el nivel de una cisterna mediante la consulta de todas sus cargas y descargas,
    *
    * @param integer $intMaquinaria  Identificador del equipo a consultar, 0 es el general
    * @return float El total de litros del nivel de la cisterna
    */

    public function getNivelTotalCisterna( $intMaquinaria = 0 ) {
        $totalLitros  = 0;
        $decCargados = 0;
        $decDescargados = 0;

        if ( $intMaquinaria == 0 ) {
            //*** total general */
            $decCargados = $this->getTotalLitrosCargas( 0 );
            $decDescargados = $this->getTotalLitrosDescargas( 0 );
        } else {
            //*** total individual */
            $decCargados = $this->getTotalLitrosCargas( $intMaquinaria );
            $decDescargados = $this->getTotalLitrosDescargas( $intMaquinaria );
        }

        //  dd( "$intMaquinaria .-" . $decCargados . ' / ' . $decDescargados );
        $totalLitros = $decCargados - $decDescargados;

        return $totalLitros;
    }

    /**
    * Recalcula el acumulado de la caja chica tomando en cuenta solo movimientos de entradas y salidas de ingresos
    *
    * @param int $registro Sobre el cual se realiza el pibote para el calculo
    * @return void
    */

    public function RecalcularCajaChica( $registroId ) {
        $blnExito = true;
        //*** Arreglo para buscar ingresos y egresos */
        $vctTipos = [ 1, 2 ];

        //*** obtenemos la informacion del registro pivote  */
        $objRecord = cajachica::select( '*' )->where( 'id', '=', $registroId )->first();

        //*** buscamos el registro anterior inmediato */
        $objAnterior = cajachica::select( '*' )
        ->where( 'cajachica.dia', '<=', $objRecord->dia )
        ->where( 'id', '!=', $registroId )
        ->where( 'id', '<', $registroId )
        ->whereIn( 'cajachica.tipo',   $vctTipos )
        ->orderBy( 'cajachica.id', 'desc' )->first();

        $registroAnteriorId = 0;
        $decTotalAnterior = 0;
        $decRegistroTotalActualizado = 0;
        $decRegistroTotalAnterior = $objRecord->total;

        if ( $objAnterior ) {
            $registroAnteriorId = $objAnterior->id;
            //*** Existe anterior y ajustamos el total */
            $decTotalAnterior = $objAnterior->total;

            $decRegistroTotalActualizado =  ( $objRecord->tipo == 1 ? ( $decTotalAnterior + $objRecord->cantidad )  : ( $decTotalAnterior - $objRecord->cantidad ) );

            $objRecord->total =  $decRegistroTotalActualizado;
            $objRecord->save();

        } else {
            //*** no hay anterior */
            $decRegistroTotalActualizado = ( $objRecord->tipo == 1 ? ( $decTotalAnterior + $objRecord->cantidad )  : ( $decTotalAnterior - $objRecord->cantidad ) );
            $objAnterior = null;
            //*** nois aseguramos de que el inicial quede iniciado correctamente */
            $objRecord->total = $decRegistroTotalActualizado;
            $objRecord->save();
        }

        //*** buscamos los registros posteriores al pivote */
        $vctRegistros = cajachica::select( 'cajachica.*' )
        // ->where( 'cajachica.id', '!=', $registroId )
        ->where( 'cajachica.id', '>', $registroId )
        ->where( 'cajachica.dia', '>=', $objRecord->dia )
        ->whereIn( 'cajachica.tipo',   $vctTipos )
        ->orderBy( 'cajachica.id', 'asc' )
        ->orderBy( 'cajachica.dia', 'asc' )
        ->get();

        $intCont = 0;
        $decTotal = $decRegistroTotalActualizado;
        //*** para el control del ciclo */
        if ( $vctRegistros->count() > 0 ) {
            //*** actualizamos los registros posteriores */
            foreach ( $vctRegistros as $key => $objItem ) {

                //*** preguntamos por el tipo de movimiento */
                if ( $objItem->tipo == 1 ) {
                    //*** ingreso Suma */
                    $decTotal  +=  ( $objItem->cantidad );

                } else {
                    //*** egreso Resta */
                    $decTotal -=  ( $objItem->cantidad );

                }

                $objItem->total = $decTotal;
                $objItem->save();

            }

        } else {
            //*** no hay registros siguientes */

        }

        // dd(
        //     'Registro: ' . $registroId . ', total actualizado: ' .  $decRegistroTotalActualizado . ', total anterior: ' . $decRegistroTotalAnterior,
        //     $objRecord,
        //     'Registro anterior: ' . $registroAnteriorId . ', total anterior: ' . $decTotalAnterior,
        //     $objAnterior,
        //     'Registros posteriores: ' . $vctRegistros->count() . ', total actualizado: ' . $decTotal,
        //     $vctRegistros
        // );
        return $blnExito;

    }

}
