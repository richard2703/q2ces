<?php

namespace App\Http\Controllers;

use App\Models\serviciosMtq;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class serviciosMtqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('index Servicios MTQ');
        // abort_if(Gate::denies('ubicaciones_index'), '404');
        $servicios = serviciosMtq::orderBy('created_at', 'desc')->paginate(15);
        return view('catalogos.indexServiciosMtq', compact('servicios'));
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
        // dd($request);
        $request->validate([
            'nombre' => 'required|max:250',
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);

        $servicios = $request->all();
        // dd( $ubicaciones );
        serviciosMtq::create($servicios);
        Session::flash('message', 1);

        return redirect()->route('serviciosMtq.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\serviciosMtq  $serviciosMtq
     * @return \Illuminate\Http\Response
     */
    public function show(serviciosMtq $serviciosMtq)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\serviciosMtq  $serviciosMtq
     * @return \Illuminate\Http\Response
     */
    public function edit(serviciosMtq $serviciosMtq)
    {
        dd('edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:250',
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);
        $data = $request->all();
        $servicio = serviciosMtq::where('id', $data['servicioId'])->first();

        if (is_null($servicio) == false) {
            // dd( $data );
            $servicio->update($data);
            Session::flash('message', 1);
        }

        return redirect()->route('serviciosMtq.index');
    }

    public function destroy(serviciosMtq $serviciosMtq)
    {
        try {
            $serviciosMtq->delete(); // Intenta eliminar 
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
