<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obraMaqPer extends Model
{
    use HasFactory;
    protected $table = "obraMaqPer";

    public $timestamps = false;

    protected $fillable = [
        'maquinariaId', 'personalId', 'obraId', 'inicio', 'fin', 'combustible'
    ];
}
