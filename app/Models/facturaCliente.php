<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facturaCliente extends Model
{
    use HasFactory;
    protected $table = "facturaCliente";

    public $timestamps = true;

    protected $fillable = [
        'userId', 'clienteId', 'folio', 'fecha', 'pdf', 'xml'
    ];
}
