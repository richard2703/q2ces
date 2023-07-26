<?php

namespace App\Http\Controllers;

use App\Models\docs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tiposDocs;

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

        $docs = docs::join('tiposDocs', 'docs.tipoId', 'tiposDocs.id')
        ->select(
            'docs.id',
            'docs.nombre',
            'tiposDocs.nombre as nombreTipo',
            'docs.comentario'
        )->orderBy('docs.created_at', 'desc')->paginate(5);
        // dd($docs);
        return view('docs.indexDocs', compact('docs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposDocs = tiposDocs::all();
        
        return view('docs.createDocs', compact('tiposDocs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $docs = $request->all();
        $docs = docs::create($docs);
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
        //dd($doc);
        $tiposDocs = tiposDocs::all();
        return view('docs.editDocs', compact('doc','tiposDocs'));
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
        
        $data = $request->all();
        //dd($data);
        $doc->update($data);
        return redirect()->action([docsController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\docs  $docs
     * @return \Illuminate\Http\Response
     */
    public function destroy(docs $docs)
    {
        //
    }
}
