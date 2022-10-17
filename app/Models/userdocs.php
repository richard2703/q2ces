<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userdocs extends Model
{
    use HasFactory;
    protected $table = "userdocs";

    public $timestamps = false;

    protected $fillable = [
        'personalId', 'dvitae', 'dnacimiento', 'dine', 'dcurp', 'dlicencia', 'dlicenciaEstatus', 'dcedula', 'dfiscal',
        'ddomicilio', 'dpenales', 'drecomendacion', 'ddc3', 'dmedico', 'ddoping', 'destudios', 'dnss', 'dari', 'dpuesto', 'dcontrato',
        'dcontratoEstatus'
    ];
}
