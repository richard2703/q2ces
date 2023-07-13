<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personal extends Model
{
    use HasFactory;
    protected $table = "personal";

    public $timestamps = true;

    protected $fillable = [
        'userId', 'nombres', 'apellidoP', 'apellidoM', 'fechaNacimiento', 'lugarNacimiento', 'curp', 'fine', 'rfc', 'licencia',
        'cpf', 'cpe', 'sexo', 'civil', 'hijos', 'sangre', 'calle', 'numero', 'colonia', 'estado', 'ciudad', 'cp', 'particular',
        'celular', 'mailpersonal', 'mailEmpresarial', 'casa', 'foto', 'aler', 'profe', 'interior', 'estatusId', 'personalId',
        'puestoNivelId', 'tipoLicencia'
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

    public function getFullLastNameAttribute()
    {
        return "{$this->apellidoP} {$this->apellidoM}, {$this->nombres}";
    }
}
