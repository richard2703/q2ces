<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grupoBitacoras extends Model
{
    use HasFactory;
    protected $table = 'grupoBitacoras';

    public $timestamps = true;

    protected $fillable = [
        'bitacoraId', 'tareaId'
    ];
}
