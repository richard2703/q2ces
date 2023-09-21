<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\descargaDetalle;
use Illuminate\Http\Request;

class detalleDescargaController extends Controller
{
    public function comprobarDescarga($id)
    {
        dd('HOLA');
        $existe = descargaDetalle::where('descargaId', $id)->exists();

        return response()->json(['existe' => $existe]);
    }
}
