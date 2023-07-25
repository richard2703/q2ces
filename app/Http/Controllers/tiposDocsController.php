<?php

namespace App\Http\Controllers;

use App\Models\tiposDocs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class tiposDocsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('tiposDocs_index'), 403);
        $tiposDocs = tiposDocs::orderBy('created_at', 'desc')->paginate(5);
        return view('tiposDocs.indexTiposDocs', compact('tiposDocs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('tiposDocs_create'), 403);
        return view('tiposDocs.createTiposDocs');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('tiposDocs_create'), 403);

        $tipoDocs = $request->all();
        $tipoDocs = tiposDocs::create($tipoDocs);
        return redirect()->action([tiposDocsController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tiposDocs  $tiposDocs
     * @return \Illuminate\Http\Response
     */
    public function show(tiposDocs $tiposDocs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tiposDocs  $tiposDocs
     * @return \Illuminate\Http\Response
     */
    public function edit(tiposDocs $tiposDoc)
    {
        abort_if(Gate::denies('tiposDocs_edit'), 403);
        // dd($tiposDoc);
        return view('tiposDocs.editTiposDocs', compact('tiposDoc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tiposDocs  $tiposDocs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tiposDocs $tiposDoc)
    {
        abort_if(Gate::denies('tiposDocs_edit'), 403);
        $data = $request->all();
        // dd($data);
        $tiposDoc->update($data);
        return redirect()->action([tiposDocsController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tiposDocs  $tiposDocs
     * @return \Illuminate\Http\Response
     */
    public function destroy(tiposDocs $tiposDocs)
    {
        //
    }
}
