<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class corteCajaChica extends Model
{
    use HasFactory;
    protected $table = "corteCajaChica";

    public $timestamps = true;

    protected $fillable = [
        'inicio', 'fin', 'saldo', 'movimientos'
    ];
}
