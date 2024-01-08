<?php

namespace App\Http\Controllers;

use App\Models\almacenTiraderos;
use App\Models\tipoAlmacen;
use App\Http\Controllers\Controller;
use App\Models\almacenServicios;
use App\Models\conceptos;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class almacenTiraderosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('catalogos_index'), 404);
        $docs = almacenTiraderos::join('tipoAlmacen', 'almacenTiraderos.tipoAlmacenId', 'tipoAlmacen.id')
            ->select(
                'almacenTiraderos.id',
                'almacenTiraderos.nombre',
                'tipoAlmacen.nombre as nombreTipo',
                'almacenTiraderos.comentario'
            )->orderBy('almacenTiraderos.created_at', 'desc')->paginate(5);
        // dd($docs);

        return view('catalogos.almacenes.almacenesTiraderosIndex', compact('docs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        abort_if(Gate::denies('catalogos_create'), 404);
        $tiposDocs = tipoAlmacen::all();
        $servicios = conceptos::orderBy('codigo', 'asc')->get();

        return view('catalogos.almacenes.almacenesTiraderosCreate', compact('tiposDocs', 'servicios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('catalogos_create'), 404);
        $docs = $request->all();
        $docs = almacenTiraderos::create($docs);

        if ($request->servicioId[0] != null && $request->precio[0] > 0) {
            for ($i = 0; $i < count($request->servicioId); $i++) {
                //*** se guarda solo si se selecciono una máquina */
                if ($request->servicioId[$i] != '') {

                    $objServicio = new almacenServicios();
                    $objServicio->almacenId = $docs->id;
                    $objServicio->conceptoId  = $request->servicioId[$i];
                    $objServicio->precio = $request->precio[$i];
                    $objServicio->save();
                }
            }
            // dd( $vctDebug );
        }

        Session::flash('message', 1);
        return redirect()->action([almacenTiraderosController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\almacenTiraderos  $almacenTiraderos
     * @return \Illuminate\Http\Response
     */
    public function show(almacenTiraderos $almacenTiraderos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\almacenTiraderos  $almacenTiraderos
     * @return \Illuminate\Http\Response
     */
    public function edit(almacenTiraderos $almacenTiradero)
    {
        abort_if(Gate::denies('catalogos_edit'), 404);
        // $doc = $almacenTiraderos;
        $tiposDocs = tipoAlmacen::all();
        $servicios = conceptos::orderBy('codigo', 'asc')->get();
        $vctAlmacenServicio = almacenServicios::select('*')->where('almacenId', '=', $almacenTiradero->id)->get();
        return view('catalogos.almacenes.almacenesTiraderosEdit', compact('almacenTiradero', 'tiposDocs', 'servicios', 'vctAlmacenServicio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\almacenTiraderos  $almacenTiraderos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, almacenTiraderos $almacenTiradero)
    {
        abort_if(Gate::denies('catalogos_edit'), 404);
        $data = $request->all();
        //dd($data);
        $almacenTiradero->update($data);


        $nuevaLista = collect();
        // dd($request);

        if ($request->servicioId[0] != null && $request->precio[0] > 0) {
            # code...

            for ($i = 0; $i < count($request->servicioId); $i++) {

                $array = [
                    'id' => $request->Idser[$i],
                    'almacenId' => $request->tipoAlmacenId,
                    'conceptoId' => $request->servicioId[$i],
                    'precio' => $request->precio[$i],
                ];
                $objRelacion = almacenServicios::updateOrCreate(['id' => $array['id']], $array);
                $nuevaLista->push($objRelacion->id);
            }
            $test = almacenServicios::where('almacenId', $request->tipoAlmacenId)->whereNotIn('id', $nuevaLista)->delete();
        }
        Session::flash('message', 1);
        return redirect()->action([almacenTiraderosController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\almacenTiraderos  $almacenTiraderos
     * @return \Illuminate\Http\Response
     */
    public function destroy(almacenTiraderos $almacenTiradero)
    {
        abort_if(Gate::denies('catalogos_destroy'), 403);
        try {
            $almacenTiradero->delete();
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
