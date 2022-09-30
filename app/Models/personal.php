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
        'userId', 'nombres', 'apellidoP', 'apellidoM', 'fechaNacimiento', 'lugarNacimiento', 'curp', 'ine', 'rfc', 'licencia',
        'cpf', 'cpe', 'sexo', 'civil', 'hijos', 'sangre', 'calle', 'numero', 'colonia', 'estado', 'ciudad', 'cp', 'particular',
        'celular', 'mailpersonal', 'mailEmpresaril', 'casa', 'foto'
    ];
}
