<?php

namespace App\Http\Controllers;

use App\Models\docs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class docsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd( 'test docs' );
        return view('docs.indexDocs');
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
        //
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
    public function edit(docs $docs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\docs  $docs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, docs $docs)
    {
        //
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
