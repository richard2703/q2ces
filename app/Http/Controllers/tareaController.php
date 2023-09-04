<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\tarea;
use App\Models\tareaCategoria;
use App\Models\tareaTipo;
use App\Models\tareaUbicacion;
use App\Models\tipoValorTarea;

class tareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        abort_if(Gate::denies('tarea_index'), 403);

        $vctCategorias = tareaCategoria::all();
        $vctTipos = tareaTipo::all();
        $vctUbicaciones = tareaUbicacion::all();
        $vctTipoValor = tipoValorTarea::all();

        $vctTareas = tarea::select(
            'tarea.*',
            DB::raw('tareaCategoria.nombre AS categoria'),
            DB::raw('tareaTipo.nombre AS tipo'),
            DB::raw('tareaUbicacion.nombre AS ubicacion'),
        )
            ->leftJoin('tareaCategoria', 'tareaCategoria.id', '=', 'tarea.categoriaId')
            ->leftJoin('tareaTipo', 'tareaTipo.id', '=', 'tarea.tipoId')
            ->leftJoin('tareaUbicacion', 'tareaUbicacion.id', '=', 'tarea.ubicacionId')
            ->orderBy('created_at', 'desc')->paginate(15);;

        return view('tareas.tareas', compact('vctTareas', 'vctCategorias', 'vctTipos', 'vctUbicaciones','vctTipoValor'));
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
        abort_if(Gate::denies('tarea_create'), 403);

        $request->validate( [
            'nombre' => 'required|max:250|unique:tarea,nombre,' . $request['nombre'],
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya esta en uso.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);
        $tarea = $request->all();

        tarea::create($tarea);
        Session::flash('message', 1);

        return redirect()->route('tarea.index');
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

        // dd( $request );
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

        abort_if(Gate::denies('tarea_edit'), 403);

        // dd( $request );

        $request->validate( [
            'nombre' => 'required|max:250|unique:tarea,nombre,' . $request['tareaId'],
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya esta en uso.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);

        $data = $request->all();

        $tarea = tarea::where('id', $data['tareaId'])->first();

        if (is_null($tarea) == false) {
            // dd( $data );
            $tarea->update($data);
            Session::flash('message', 1);
        }

        return redirect()->route('tarea.index');
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
