<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class personal extends Model
{
    use HasFactory;
    protected $table = "personal";

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
    public static function getPersonalPorNivel($intPuestoNivelId, $blnMostrarPuesto = false){
        $vctPersonal=null;
        if($intPuestoNivelId>0){

            $vctPersonal = personal::select(
                'personal.id',
                DB::raw("CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as nombreCompleto"),
                ($blnMostrarPuesto == false ? DB::raw("CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal") : DB::raw("CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM,' [' , puesto.nombre , ']')as personal")),
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
                ->leftjoin('maquinaria', 'maquinaria.id', '=', 'obraMaqPer.maquinariaId')
                ->leftjoin('obras', 'obras.id', '=', 'obraMaqPer.obraId')
                ->where('puesto.puestoNivelId', '=', $intPuestoNivelId)
                ->where('personal.estatusId', '=', 1)
                ->orderBy('personal.nombres', 'asc')->get();

        }
            return $vctPersonal;

    }

}
