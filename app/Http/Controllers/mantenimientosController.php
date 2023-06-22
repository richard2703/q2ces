<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Helpers\Validaciones;
use App\Helpers\Calculos;
use App\Models\mantenimientos;
use Illuminate\Support\Facades\Gate;

class mantenimientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        dd('Todas las tareas...');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        dd('Todas las tareas...');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('calendario_create'), 403);

        $request->validate([
            'titulo' => 'required|max:250',
            'maquinariaId' => 'required',
            'comentarios' => 'nullable|max:500',

        ], [
            'titulo.required' => 'El campo nombre es obligatorio.',
            'maquinariaId.required' => 'El campo maquinaria es obligatorio.',
            'titulo.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentarios.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);
        $mantenimiento = $request->all();

        // dd( $mantenimiento );

        mantenimientos::create($mantenimiento);
        Session::flash('message', 1);

        return redirect()->route('calendario.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        dd('Todas las tareas...');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        dd('Todas las tareas...');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        abort_if(Gate::denies('calendario_edit'), 403);

        //  dd( $request );
        $request->validate([
            'manttoTitulo' => 'required|max:250',
            'manttoComentario' => 'nullable|max:500',
        ], [
            'manttoTitulo.required' => 'El campo nombre es obligatorio.',
            'manttoTitulo.max' => 'El campo título excede el límite de caracteres permitidos.',
            'manttoComentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);

        $data = $request->all();

        $mantto = mantenimientos::where('id', $data['manttoId'])->first();

        if (is_null($mantto) == false) {

            $data['titulo'] =  $data['manttoTitulo'];
            $data['comentario'] =  $data['manttoComentario'];
            $data['tipo'] =  $data['manttoTipoId'];

            // $data[ 'prioridadId' ] =  $data[ 'manttoPrioridadId' ] ;

            //*** manejo del estatus de la tarea cuando se cambia su estatus inicial*/
            // if ( $mantto->estadoId <= 1 && $mantto->fechaReal == '0000-00-00' ) {
            //     if ( $data[ 'manttoEstadoId' ] > 1 ) {
            //         $data[ 'fechaReal' ] =  date( 'Y-m-d' ) ;
            //     }
            // }
            //*** manejo del estatus de la tarea cuando se cambia su estatus final*/
            if ($data['manttoEstadoId'] == 3) {
                $data['fechaReal'] =  date('Y-m-d');
            }

            $data['estadoId'] =  $data['manttoEstadoId'];

            // dd( $data );
            $mantto->update($data);
            Session::flash('message', 1);
        }

        return redirect()->route('calendario.index');
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
