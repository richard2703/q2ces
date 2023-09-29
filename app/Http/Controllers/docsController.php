<?php

namespace App\Http\Controllers;

use App\Models\docs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tiposDocs;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class docsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$docs = docs::orderBy('created_at', 'desc')->paginate(5);
        abort_if(Gate::denies('docs_index'), 404);
        $docs = docs::join('tiposDocs', 'docs.tipoId', 'tiposDocs.id')
            ->select(
                'docs.id',
                'docs.nombre',
                'tiposDocs.nombre as nombreTipo',
                'docs.comentario'
            )->orderBy('docs.created_at', 'desc')->paginate(5);
        // dd($docs);

        return view('catalogos.docs.indexDocs', compact('docs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('docs_create'), 404);
        $tiposDocs = tiposDocs::all();

        return view('catalogos.docs.createDocs', compact('tiposDocs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('docs_create'), 404);
        $docs = $request->all();
        $docs = docs::create($docs);
        Session::flash('message', 1);
        return redirect()->action([docsController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\docs  $docs
     * @return \Illuminate\Http\Response
     */
    public function show(docs $docs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\docs  $docs
     * @return \Illuminate\Http\Response
     */
    public function edit(docs $doc)
    {
        abort_if(Gate::denies('tiposDocs_edit'), 404);
        $tiposDocs = tiposDocs::all();
        return view('catalogos.docs.editDocs', compact('doc', 'tiposDocs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\docs  $docs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, docs $doc)
    {
        abort_if(Gate::denies('tiposDocs_edit'), 404);
        $data = $request->all();
        //dd($data);
        $doc->update($data);
        Session::flash('message', 1);
        return redirect()->action([docsController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\docs  $docs
     * @return \Illuminate\Http\Response
     */
    public function destroy(docs $doc)
    {
        try {
            $doc->delete(); // Intenta eliminar 
        } catch (QueryException $e) {
            if ($e->getCode() === 23000) {
                return redirect()->back()->with('faild', 'No Puedes Eliminar ');
                // Esto es un error de restricción de clave externa (FOREIGN KEY constraint)
                // Puedes mostrar un mensaje de error o realizar otras acciones aquí.
            } else {
                return redirect()->back()->with('faild', 'No Puedes Eliminar un puesto en uso');
                // Otro tipo de error de base de datos
                // Maneja según sea necesario
            }
        }

        return redirect()->back()->with('success', 'Puesto Eliminado correctamente');
    }
}
