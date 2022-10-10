<?php

namespace App\Http\Controllers;

use App\Models\maquinaria;
use App\Models\maqdocs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class maquinariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maquinaria = maquinaria::paginate(5);
        // dd('test');
        return view('maquinaria.indexMaquinaria', compact('maquinaria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maquinaria.altaDeMaquinaria');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maquinaria = $request->all();
        // dd($request);
        $maquinaria = maquinaria::create($maquinaria);
        if ($request->hasFile("factura")) {
            $docs['factura'] = time() . '_' . $request->file('factura')->getClientOriginalName();
            $request->file('factura')->storeAs('/public/docmaquinaria', $docs['factura']);
        }
        if ($request->hasFile("circulacion")) {
            $docs['circulacion'] = time() . '_' . $request->file('circulacion')->getClientOriginalName();
            $request->file('circulacion')->storeAs('/public/docmaquinaria', $docs['circulacion']);
        }
        if ($request->hasFile("verificacion")) {
            $docs['verificacion'] = time() . '_' . $request->file('verificacion')->getClientOriginalName();
            $request->file('verificacion')->storeAs('/public/docmaquinaria', $docs['verificacion']);
        }
        if ($request->hasFile("ficha")) {
            $docs['ficha'] = time() . '_' . $request->file('ficha')->getClientOriginalName();
            $request->file('ficha')->storeAs('/public/docmaquinaria', $docs['ficha']);
        }
        if ($request->hasFile("manual")) {
            $docs['manual'] = time() . '_' . $request->file('manual')->getClientOriginalName();
            $request->file('manual')->storeAs('/public/docmaquinaria', $docs['manual']);
        }
        if ($request->hasFile("seguro")) {
            $docs['seguro'] = time() . '_' . $request->file('seguro')->getClientOriginalName();
            $request->file('seguro')->storeAs('/public/docmaquinaria', $docs['seguro']);
        }
        if ($request->hasFile("registro")) {
            $docs['registro'] = time() . '_' . $request->file('registro')->getClientOriginalName();
            $request->file('registro')->storeAs('/public/docmaquinaria', $docs['registro']);
        }
        $docs['maquinariaId'] = $maquinaria->id;
        $docs = maqdocs::create($docs);

        Session::flash('message', 1);
        return redirect()->route('maquinaria.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function show(maquinaria $maquinaria)
    {
        return view('maquinaria.detalleMaquinaria', compact('maquinaria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function edit(maquinaria $maquinaria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, maquinaria $maquinaria)
    {
        $data = $request->all();
        $maquinaria->update($data);
        if ($request->hasFile("factura")) {
            $docs['factura'] = time() . '_' . $request->file('factura')->getClientOriginalName();
            $request->file('factura')->storeAs('/public/docmaquinaria', $docs['factura']);
        }
        if ($request->hasFile("circulacion")) {
            $docs['circulacion'] = time() . '_' . $request->file('circulacion')->getClientOriginalName();
            $request->file('circulacion')->storeAs('/public/docmaquinaria', $docs['circulacion']);
        }
        if ($request->hasFile("verificacion")) {
            $docs['verificacion'] = time() . '_' . $request->file('verificacion')->getClientOriginalName();
            $request->file('verificacion')->storeAs('/public/docmaquinaria', $docs['verificacion']);
        }
        if ($request->hasFile("ficha")) {
            $docs['ficha'] = time() . '_' . $request->file('ficha')->getClientOriginalName();
            $request->file('ficha')->storeAs('/public/docmaquinaria', $docs['ficha']);
        }
        if ($request->hasFile("manual")) {
            $docs['manual'] = time() . '_' . $request->file('manual')->getClientOriginalName();
            $request->file('manual')->storeAs('/public/docmaquinaria', $docs['manual']);
        }
        if ($request->hasFile("seguro")) {
            $docs['seguro'] = time() . '_' . $request->file('seguro')->getClientOriginalName();
            $request->file('seguro')->storeAs('/public/docmaquinaria', $docs['seguro']);
        }
        if ($request->hasFile("registro")) {
            $docs['registro'] = time() . '_' . $request->file('registro')->getClientOriginalName();
            $request->file('registro')->storeAs('/public/docmaquinaria', $docs['registro']);
        }
        $docu = maqdocs::where("maquinariaId", $maquinaria->id);
        $docu->update($docs);
        Session::flash('message', 1);

        return redirect()->route('maquinaria.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function destroy(maquinaria $maquinaria)
    {
        //
    }
}
