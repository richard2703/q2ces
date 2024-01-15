<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class serviciosTrasporte extends Model {
    use HasFactory;
    protected $table = 'serviciosTrasporte';

    public $timestamps = true;

    protected $fillable = [
        'fecha',
        'conceptoId',
        'obraId',
        'ncomprobante',
        'equipoId',
        'personalId',
        'cantidad',
        'estatus',
        'recibe',
        'horaEntrega',
        'horaLlegada',
        'cajaChica',
        'almacenId',
        'comentario',
        'maniobristaId',
        'odometro',
        'servicio',
        'costoMaterial',
        'costoServicio',
        'costoMano',
        'cobrado', 'numFactura'
    ];

    /**
    * Obtiene el detalle de un servicio de trasporte al registrarse inicialmente
    *
    * @param int $recordId El registro recien creado
    * @return void string $strResult La información del registro
    */

    public function getDetalleNuevo( $recordId ) {

        $objResult = new stdClass;
        if ( is_numeric( trim( $recordId ) ) == true ) {

            $objRecord = serviciosTrasporte::join( 'conceptos', 'serviciosTrasporte.conceptoId', 'conceptos.id' )
            ->leftJoin( 'obras', 'serviciosTrasporte.obraId', 'obras.id' )
            ->leftJoin( 'clientes', 'obras.clienteId', 'clientes.id' )
            ->join( 'maquinaria', 'serviciosTrasporte.equipoId', 'maquinaria.id' )
            ->join( 'personal', 'serviciosTrasporte.personalId', 'personal.id' )
            ->join( 'personal as p2', 'serviciosTrasporte.maniobristaId', 'p2.id' )
            ->select(
                'serviciosTrasporte.id',
                'serviciosTrasporte.fecha',
                'serviciosTrasporte.servicio',
                'serviciosTrasporte.comentario',
                'conceptos.nombre as cnombre',
                'clientes.nombre as cliente',
                'obras.nombre as obra',
                'obras.centroCostos',
                'obras.proyecto',
                'maquinaria.identificador',
                'maquinaria.nombre as maquinaria',
                'personal.nombres as pnombre',
                'personal.apellidoP as papellidoP',
                'p2.nombres as mnombre',
                'p2.apellidoP as mapellidoP',
                'cantidad',
                'costoMano',
                'costoServicio',
                'costoMaterial',
                'numFactura',
                'serviciosTrasporte.estatus'
            )
            ->where( 'serviciosTrasporte.id', '=', [ $recordId ] )->first();

            if ( $objRecord ) {
                $objResult->titulo = 'Nuevo servicio: ' . $objRecord->cnombre;
                $objResult->detalle = 'Información del Servicio: ' . " \n"
                . 'Servicio: ' . $objRecord->cnombre . " \n"
                . ', Fecha: ' . $objRecord->fecha . " \n"
                . ', Obra: ' . ( $objRecord->obra? $objRecord->obra : '---' ) . " \n"
                . ', Equipo: ' . $objRecord->identificador . ' ' . $objRecord->maquinaria . " \n"
                . ', Operador: '   . $objRecord->pnombre . ' ' . $objRecord->papellidoP . " \n"
                . ', Maniobrista: '   . $objRecord->mnombre . ' ' . $objRecord->mapellidoP . " \n"
                . ', Servicio: ' . ( $objRecord->servicio? $objRecord->servicio : '---' ) . " \n"
                . ', Comentario: ' . ( $objRecord->comentario? $objRecord->comentario : '---' );

                // dd( $objRecord,  $strResult );
            } else {
                $objResult->titulo = 'Nuevo Servicio Programado';
                $objResult->detalle = 'Nuevo servicio programado, para mas detalles revise el registro.';
            }

        }
        return $objResult;
    }
}
