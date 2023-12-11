<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eventoImportante extends Model
{
    use HasFactory;
    protected $table = "eventoImportante";

    public $timestamps = true;

    protected $fillable = [
        'userId',
        'titulo',
        'start',
        'end',
        'comentario'
    ];
}
