<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facturaProvedor extends Model
{
    use HasFactory;
    protected $table = "facturaProvedor";

    public $timestamps = true;

    protected $fillable = [
        'userId', 'provedorId', 'folio', 'fecha', 'pdf', 'xml'
    ];
}
