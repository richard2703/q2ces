<?php

namespace App\Http\Controllers;

use App\Models\tipoAlmacen;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

class tipoAlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = tipoAlmacen::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.tipoAlmacen', compact('records'));
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
            'nombre' => 'required|max:250|unique:tipoAlmacen,nombre,' . $request['nombre'],
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya esta en uso.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);
        $record = $request->all();

        tipoAlmacen::create($record);
        Session::flash('message', 1);

        return redirect()->route('tipoAlmacen.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tipoAlmacen  $tipoAlmacen
     * @return \Illuminate\Http\Response
     */
    public function show(tipoAlmacen $tipoAlmacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tipoAlmacen  $tipoAlmacen
     * @return \Illuminate\Http\Response
     */
    public function edit(tipoAlmacen $tipoAlmacen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tipoAlmacen  $tipoAlmacen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tipoAlmacen $tipoAlmacen)
    {
        abort_if(Gate::denies('catalogos_edit'), 403);

        // dd($request);

        $request->validate([
            'nombre' => 'required|max:250|unique:tipoAlmacen,nombre,' . $request['controlId'],
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya esta en uso.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);
        $data = $request->all();

        $record = tipoAlmacen::where('id', $data['controlId'])->first();

        if (is_null($record) == false) {
            // dd( $data );
            $record->update($data);
            Session::flash('message', 1);
        }

        return redirect()->route('tipoAlmacen.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tipoAlmacen  $tipoAlmacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(tipoAlmacen $tipoAlmacen)
    {
        abort_if(Gate::denies('catalogos_destroy'), 403);
        try {
            $tipoAlmacen->delete();
            // Intenta eliminar
        } catch (QueryException $e) {
            if ($e->getCode() === 23000) {
                return redirect()->back()->with('faild', 'No Puedes Eliminar ');
                // Esto es un error de restricción de clave externa ( FOREIGN KEY constraint )
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
