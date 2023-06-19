<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cajachica extends Model
{
    use HasFactory;
    protected $table = "cajachica";

    public $timestamps = true;

    protected $fillable = [
        'dia', 'concepto', 'comprobante', 'ncomprobante', 'cliente', 'obra', 'equipo', 'personal', 'tipo', 'cantidad', 'comentario',
        'total'
    ];
}
