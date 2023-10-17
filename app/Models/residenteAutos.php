<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class residenteAutos extends Model
{
    use HasFactory;
    protected $table = "residenteAutos";

    public $timestamps = false;

    protected $fillable = [
        'autoId', 'residenteId'
    ];
}
