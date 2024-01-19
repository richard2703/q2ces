<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clientes extends Model {
    use HasFactory;
    protected $table = 'clientes';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'razonSocial',
        'rfc',
        'calle',
        'exterior',
        'interior',
        'colonia',
        'estado',
        'ciudad',
        'cp',
        'logo',
        'estatus',
        'usoCfdiId',
        'metodoPagoId',
        'formaPagoId'
    ];
}
