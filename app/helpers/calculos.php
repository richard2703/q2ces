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
    * Recalcula el acumulado de la caja chica
    *
    * @param int $registro Sobre el cual se realiza el pibote para el calculo
    * @return void
    */

    public function RecalcularCajaChica( $registroId ) {

        //*** obtenemos la informacion del registro */
        $objRecord = cajachica::select( '*' )->where( 'id', '=', $registroId )->first();

        $objAnterior = cajachica::select( '*' )->where( 'id', '!=', $registroId )->orderBy( 'cajachica.dia', 'desc' )->first();
        $vctTipos = [1, 2];
        $vctRegistros = cajachica::select( 'cajachica.*' )
        ->where( 'cajachica.id', '!=', $registroId )
        ->where( 'cajachica.dia', '>=', $objRecord->dia )
        ->whereIn( 'cajachica.tipo',   $vctTipos )
        ->orderBy( 'cajachica.dia', 'asc' )
        ->orderBy( 'cajachica.id', 'asc' )
        ->get();

        dd(
            $objRecord,
            $objAnterior,
            $vctRegistros
        );

    }

}
