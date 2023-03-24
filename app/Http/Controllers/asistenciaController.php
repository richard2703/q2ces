<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\asistencia;
use App\Models\personal;

use App\Helpers\Validaciones;
use App\Helpers\Calendario;
use App\Helpers\Calculos;


class asistenciaController extends Controller
{

    public function index()
    {
        return view("asistencias.indexAsistencias");
    }

    public function create( $intAnio = null, $intMes = null, $intDia = null ) {
        $objCalendario = new Calendario();
        $usuario = personal::where( 'userId', auth()->user()->id )->first();
        $personal = personal::orderBy( 'nombres', 'asc' )->get();

        $data = request()->all();
        if ( is_array( $data ) == true && count( $data )>0 ) {
            $intMes = $data[ 'intMes' ] ;
            $intAnio = $data[ 'intAnio' ] ;
        } else {
            $intMes = date( 'm' );
            $intAnio = date( 'Y' );
        }

        $dteMesInicio = $intAnio .'-' .$intMes . '-01';
        $dteMesFin = $intAnio .'-' .$intMes .'-'. $objCalendario->getTotalDaysInMonth( $intMes, $intAnio );


        return view("asistencias.asistenciaDiaria",compact( 'usuario', 'personal', 'intDia', 'intMes', 'intAnio'));
    }

    public function store(Request $request)
    {
        //
    }

    public function horasExtra()
    {
        return view("asistencias.horasExtra");
    }

    public function HEstore(Request $request)
    {
        //
    }

    public function show()
    {
        return view("asistencias.asistenciaDetalle");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
