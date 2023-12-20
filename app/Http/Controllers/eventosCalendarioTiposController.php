<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\calendarioPrincipal;
use App\Models\eventosCalendarioTipos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\tipoMantenimiento;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

class eventosCalendarioTiposController extends Controller
{
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        abort_if(Gate::denies('catalogos_create'), 403);

        // dd( $request );
        $request->validate([
            'comentarios' => 'nullable|max:500',
        ], [
            'comentarios.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);
        $record = $request->all();

        eventosCalendarioTipos::create($record);
        Session::flash('message', 1);

        return redirect()->route('catalogoTiposMantenimiento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        abort_if(Gate::denies('catalogos_edit'), 403);

        // dd( $request );

        $request->validate([
            'comentario' => 'nullable|max:500',
        ], [
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);
        $data = $request->all();
        $record = eventosCalendarioTipos::where('id', $data['controlId'])->first();
        $updteEventos = calendarioPrincipal::where('tipoEvento', $data['tipoEvento'])->get();
        foreach ($updteEventos as $evento) {
            $evento->color = $data['color'];
            $evento->save();
        }
        if (is_null($record) == false) {
            // dd( $data );
            $record->update($data);
            Session::flash('message', 1);
        }

        return redirect()->route('catalogoEventosCalendarioTipos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(eventosCalendarioTipos $eventosCalendarioTipos)
    {
        try {
            $eventosCalendarioTipos->delete(); // Intenta eliminar 
        } catch (QueryException $e) {
            if ($e->getCode() === 23000) {
                return redirect()->back()->with('faild', 'No Puedes Eliminar ');
                // Esto es un error de restricción de clave externa (FOREIGN KEY constraint)
                // Puedes mostrar un mensaje de error o realizar otras acciones aquí.
            } else {
                return redirect()->back()->with('faild', 'No Puedes Eliminar si esta en uso');
                // Otro tipo de error de base de datos
                // Maneja según sea necesario
            }
        }
        return redirect()->back()->with('success', 'Eliminado correctamente');
    }
}
