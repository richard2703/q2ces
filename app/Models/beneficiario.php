<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beneficiario extends Model
{
    use HasFactory;
    protected $table = "beneficiario";

    public $timestamps = false;

    protected $fillable = [
        'userId', 'nombres', 'apellidoP', 'apellidoM', 'particular', 'celular', 'nacimiento', 'emailB'
    ];
}
