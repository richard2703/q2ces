<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calendarioMtq extends Model
{
    use HasFactory;
    protected $table = "calendarioMtq";

    public $timestamps = true;

    protected $fillable = [
        'dia', 'concepto', 
    ];
}
