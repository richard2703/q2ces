<?php

namespace App\Http\Controllers;

use App\Models\mtq;
use App\Models\maquinaria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Helpers\Validaciones;

class mtqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('MTQ.dashMtq');
    }

    public function indexMtqs()
    {
        abort_if(Gate::denies('maquinaria_index'), 403);

        $maquinaria = maquinaria::paginate(15);
        // dd( 'test' );
        return view('MTQ.indexMtq', compact('maquinaria'));
    }

    public function indexResidentes()
    {
        abort_if(Gate::denies('maquinaria_index'), 403);

        $maquinaria = maquinaria::paginate(15);
        // dd( 'test' );
        return view('MTQ.indexMtq', compact('maquinaria'));
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
     * @param  \App\Models\mtq  $mtq
     * @return \Illuminate\Http\Response
     */
    public function show(mtq $mtq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mtq  $mtq
     * @return \Illuminate\Http\Response
     */
    public function edit(mtq $mtq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mtq  $mtq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mtq $mtq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mtq  $mtq
     * @return \Illuminate\Http\Response
     */
    public function destroy(mtq $mtq)
    {
        //
    }
}
