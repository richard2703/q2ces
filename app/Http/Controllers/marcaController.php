<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\marca;
use App\Models\marcasTipo;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class marcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        abort_if(Gate::denies('catalogos_index'), 403);

        $records = marca::join('marca', 'marcasTipo.marcaId', '=', 'marca.id')
            ->orderBy('nombre', 'asc')
            ->select('marca.*')
            ->paginate(15);

        dd($records);

        return view('catalogo.marcas', compact('records'));
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

        $request->validate([
            'nombre' => 'required|max:250|unique:marca,nombre,' . $request['nombre'],
            'comentarios' => 'nullable|max:500',
            'tipo' => 'required|array', // Asegúrate de que 'tipo' sea un array
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya está en uso.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'tipo.required' => 'El campo tipo es obligatorio.',
            'tipo.array' => 'El campo tipo debe ser un array.', // Agrega una validación para 'tipo'
            'tipo.max' => 'El campo tipo excede el límite de caracteres permitidos.',
            'comentarios.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);

        $record = $request->all();
        $newMarca = marca::create($record);
        // dd($newMarca->id);
        $newMarca->tiposMarcas()->sync($request->input('tipo', []));

        // for ($i = 0; $i < count($record['tipo']); $i++) {

        //     $newTipoMarca['nombre'] = $record['tipo'][$i];
        //     $newTipoMarca['marcaId'] = $newMarca->id;
        //     marcasTipo::create($newTipoMarca);
        // }

        Session::flash('message', 1);
        return redirect()->route('catalogoMarca.index');
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

        // dd($request);

        $request->validate([
            'nombre' => 'required|max:250|unique:marca,nombre,' . $request['controlId'],
            'comentarios' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya esta en uso.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentarios.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);
        $data = $request->all();

        $record = marca::where('id', $data['controlId'])->first();

        if (is_null($record) == false) {
            // dd( $data );
            $record->update($data);
            $record->tiposMarcas()->sync($request->input('tipo', []));
            Session::flash('message', 1);
        }

        return redirect()->route('catalogoMarca.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(marca $marca)
    {
        try {
            $marca->delete(); // Intenta eliminar 
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
