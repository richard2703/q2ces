<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class randomTest extends Model
{
    use HasFactory;
    protected $table = "randomTest";

    public $timestamps = false;

    protected $fillable = [
        'nombre'
    ];
}
