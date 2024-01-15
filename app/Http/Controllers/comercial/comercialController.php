<?php

namespace App\Http\Controllers\comercial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class comercialController extends Controller
{
    public function indexQuienesSomos()
    {
        return view('comercial.quienesSomos');
    }

    public function indexEquipos()
    {
        return view('comercial.equiposMovimientoTierras');
    }
}
