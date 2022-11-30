<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restock extends Model
{
    use HasFactory;
    protected $table = "restock";
    public $timestamps = true;

    protected $fillable = [
        'productoid', 'cantidad', 'costo',
    ];
}
