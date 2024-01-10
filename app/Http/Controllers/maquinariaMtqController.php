<?php

namespace App\Http\Controllers;

use App\Models\maquinaria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Helpers\Validaciones;
use Illuminate\Support\Facades\Session;
use App\Models\maqimagen;
use App\Models\usoMaquinarias;
use App\Models\marca;
use App\Models\residente;
use App\Models\residenteAutos;
use App\Models\serviciosMtq;
use Illuminate\Support\Facades\Storage;

class maquinariaMtqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        abort_if(Gate::denies('maquinaria_mtq_index'), 403);

        // Filtrar maquinarias donde el campo 'compania' no sea nulo
        // $maquinaria = maquinaria::whereNotNull( 'compania' )->paginate( 15 );

        $maquinaria = maquinaria::where('compania', 'mtq')
            ->leftJoin('marca', 'marca.id', 'maquinaria.marcaId')
            ->leftJoin('residenteAutos', 'residenteAutos.autoId', 'maquinaria.id')
            ->leftJoin('residente', 'residente.id', 'residenteAutos.residenteId')
            ->select('maquinaria.*', 'marca.nombre as nombreMarca',  'residenteAutos.autoId as residenteId', 'residente.nombre as residente')
            ->orderBy('identificador', 'asc')
            ->paginate(15);

        $autos = residente::select(
            'residente.*',
            'obras.nombre AS obra',
            'maquinaria.identificador',
            'maquinaria.nombre AS auto'
        )
            ->leftjoin('obras', 'obras.id', '=', 'residente.obraId')
            ->leftjoin('maquinaria', 'maquinaria.id', '=', 'residente.autoId')
            ->where('residente.clienteId', '=', 2)
            ->orderBy('nombre', 'asc')->get();

        $marcas = marca::all();
        $servicios = serviciosMtq::all();

        // dd($maquinaria);
        return view('MTQ.indexMaquinariaMtq', compact('maquinaria', 'marcas', 'servicios', 'autos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        abort_if(Gate::denies('maquinaria_mtq_create'), 403);
        return view('MTQ.altaDeMaquinariaMtq');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        abort_if(Gate::denies('maquinaria_mtq_create'), 403);

        $request->validate([
            'identificador' => 'required|max:150|unique:maquinaria,identificador',
        ], [
            'identificador.unique' => 'El Numero Económico Ya Existe.',
        ]);

        $maquinaria = $request->all();

        //** Generamos el identificador de la maquinaria */
        $maquinaria['estatusId'] = 1;
        $maquinaria['compania'] = 'mtq';
        // dd( $maquinaria[ 'identificador' ] );
        $maquinaria['marcaId'] = $request->marca[0];

        /*** directorio contenedor de su información */
        $maquinaria['kom'] = 'Km';
        $maquinaria['placas'] = strtoupper($maquinaria['placas']);
        $maquinaria['nummotor'] = strtoupper($maquinaria['nummotor']);
        $maquinaria['numserie'] = strtoupper($maquinaria['numserie']);
        $maquinaria['identificador'] = str_pad($maquinaria['identificador'], 4, '0', STR_PAD_LEFT);

        //*** se guarda la maquinaria */
        $maquinariaNew = maquinaria::create($maquinaria);
        // dd($maquinariaNew);
        $pathMaquinaria = str_pad($maquinariaNew->id, 4, '0', STR_PAD_LEFT);
        //**Imagenes de la maquinaria */

        if ($request->hasFile('foto')) {
            // dd( $request );
            $maquinariaNew->foto = time() . '_' . $request->file('foto')->getClientOriginalName();
            //$maqimagen = maqimagen::create( $imagen );
            $request->file('foto')->storeAs('/public/maquinaria/' . $pathMaquinaria, $maquinariaNew->foto);
            $maquinariaNew->save();
        }
        if ($request->hasFile('frente')) {
            // dd( $request );
            $maquinariaNew->frente = time() . '_' . $request->file('frente')->getClientOriginalName();
            //$maqimagen = maqimagen::create( $imagen );
            $request->file('frente')->storeAs('/public/maquinaria/' . $pathMaquinaria, $maquinariaNew->frente);
            $maquinariaNew->save();
        }
        if ($request->hasFile('derecho')) {
            // dd( $request );
            $maquinariaNew->derecho = time() . '_' . $request->file('derecho')->getClientOriginalName();
            //$maqimagen = maqimagen::create( $imagen );
            $request->file('derecho')->storeAs('/public/maquinaria/' . $pathMaquinaria, $maquinariaNew->derecho);
            $maquinariaNew->save();
        }
        if ($request->hasFile('izquierdo')) {
            // dd( $request );
            $maquinariaNew->izquierdo = time() . '_' . $request->file('izquierdo')->getClientOriginalName();
            //$maqimagen = maqimagen::create( $imagen );
            $request->file('izquierdo')->storeAs('/public/maquinaria/' . $pathMaquinaria, $maquinariaNew->izquierdo);
            $maquinariaNew->save();
        }
        if ($request->hasFile('trasero')) {
            // dd( $request );
            $maquinariaNew->trasero = time() . '_' . $request->file('trasero')->getClientOriginalName();
            //$maqimagen = maqimagen::create( $imagen );
            $request->file('trasero')->storeAs('/public/maquinaria/' . $pathMaquinaria, $maquinariaNew->trasero);
            $maquinariaNew->save();
        }

        Session::flash('message', 1);
        return redirect()->route('mtq.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */

    public function show(maquinaria $maquinaria)
    {
        // dd( 'show' );

        abort_if(Gate::denies('maquinaria_mtq_show'), 403);

        // dd( $docs );
        //        return view( 'maquinaria.detalleMaquinaria', compact( 'maquinaria', 'docs', 'fotos', 'vctEstatus' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */

    public function edit(maquinaria $maquinaria)
    {
        // dd( $maquinaria );
        // $docs = maqdocs::where( 'maquinariaId', $maquinaria->id )->first();
        // return view( 'maquinaria.detalleMaquinaria', compact( 'maquinaria', 'docs' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\maquinaria $maquinaria
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $maquinaria)
    {
        abort_if(Gate::denies('maquinaria_mtq_edit'), 403);
        // if ( $request->hasFile( 'foto' ) ) {
        //     dd( 'entro' );
        // }
        // dd( 'fallo' );

        $maquinariaMtq = maquinaria::where('id', $request->id)->first();
        // dd($request, $maquinaria, $maquinariaMtq);
        $data = $request->all();
        // dd( $data );
        $data['placas'] = strtoupper($data['placas']);
        $data['nummotor'] = strtoupper($data['nummotor']);
        $data['numserie'] = strtoupper($data['numserie']);
        $data['marcaId'] = $request->marca[0];
        $data['identificador'] = str_pad($data['identificador'], 4, '0', STR_PAD_LEFT);


        /*** directorio contenedor de su información */
        $pathMaquinaria = str_pad($maquinariaMtq->id, 4, '0', STR_PAD_LEFT);
        $data['compania'] = 'mtq';
        $maquinariaMtq->update($data);

        if ($request->hasFile('foto')) {
            // dd( $request );
            $maquinariaMtq->foto = time() . '_' . $request->file('foto')->getClientOriginalName();
            //$maqimagen = maqimagen::create( $imagen );
            $request->file('foto')->storeAs('/public/maquinaria/' . $pathMaquinaria, $maquinariaMtq->foto);
            $maquinariaMtq->save();
        }
        if ($request->hasFile('frente')) {
            // dd( $request );
            $maquinariaMtq->frente = time() . '_' . $request->file('frente')->getClientOriginalName();
            //$maqimagen = maqimagen::create( $imagen );
            $request->file('frente')->storeAs('/public/maquinaria/' . $pathMaquinaria, $maquinariaMtq->frente);
            $maquinariaMtq->save();
        }
        if ($request->hasFile('derecho')) {
            // dd( $request );
            $maquinariaMtq->derecho = time() . '_' . $request->file('derecho')->getClientOriginalName();
            //$maqimagen = maqimagen::create( $imagen );
            $request->file('derecho')->storeAs('/public/maquinaria/' . $pathMaquinaria, $maquinariaMtq->derecho);
            $maquinariaMtq->save();
        }
        if ($request->hasFile('izquierdo')) {
            // dd( $request );
            $maquinariaMtq->izquierdo = time() . '_' . $request->file('izquierdo')->getClientOriginalName();
            //$maqimagen = maqimagen::create( $imagen );
            $request->file('izquierdo')->storeAs('/public/maquinaria/' . $pathMaquinaria, $maquinariaMtq->izquierdo);
            $maquinariaMtq->save();
        }
        if ($request->hasFile('trasero')) {
            // dd( $request );
            $maquinariaMtq->trasero = time() . '_' . $request->file('trasero')->getClientOriginalName();
            //$maqimagen = maqimagen::create( $imagen );
            $request->file('trasero')->storeAs('/public/maquinaria/' . $pathMaquinaria, $maquinariaMtq->trasero);
            $maquinariaMtq->save();
        }

        // if ( $request->hasFile( 'foto' ) ) {
        //     // // dd( $maquinariaMtq->foto );
        //     // $image_path = storage_path() . '\app\public\maquinaria' . $pathMaquinaria . '/' . $maquinariaMtq->foto;
        //     // // $image_path = str_replace( 'storage', 'maquinaria', $pathMaquinaria . '/' . $maquinariaMtq->foto );

        //     // if ( Storage::exists( $image_path ) ) {
        //     //     Storage::delete( $image_path );
        //     //     // return 'Imagen eliminada con éxito.';
        //     // } else {
        //     //     // dd( $image_path );

        //     //     // dd( 'no existe' );
        //     //     // return 'La imagen no existe.';
        //     // }

        //     $maquinariaMtq->foto = time() . '_' . $request->file( 'foto' )->getClientOriginalName();
        //     $request->file( 'foto' )->storeAs( '/public/maquinaria/' . $pathMaquinaria, $maquinariaMtq->foto );

        //     // $maquinariaMtq->save();
        //     $maquinariaMtq->save();
        // }

        Session::flash('message', 1);

        return redirect()->route('mtq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */

    public function destroy(maquinaria $maquinaria)
    {
        // dd($maquinaria);

        abort_if(Gate::denies('maquinaria_mtq_destroy'), 403);

        // $this->cambiaEstatusMaquinaria( $id, $estatusId );
    }

    public function uso()
    {
        // dd('uso');
        abort_if(Gate::denies('maquinaria_mtq_update_uso_bloque'), 403);

        $maquinaria = usoMaquinarias::join('maquinaria', 'maquinaria.id', 'usoMaquinarias.maquinariaId')
            ->select('usoMaquinarias.id', 'identificador', 'nombre', 'marca', 'modelo', 'placas', 'usoMaquinarias.uso')
            ->where('compania', 'mtq')->orderBy('usoMaquinarias.created_at', 'desc')
            ->orderBy('identificador', 'asc')
            ->paginate(15);
        // dd( $maquinaria );

        return view('MTQ.indexUsoMaquinariaMtq', compact('maquinaria'));
    }

    public function asignacion(Request $request)
    {
        // dd( $request );
        abort_if(Gate::denies('maquinaria_mtq_assign_personal'), 403);
        $data = $request->all();
        // dd($data);

        if ($data['NresidenteId'] == null || $data['NresidenteId'] == '') {
            // dd( 'Borrar' );
            $record = residenteAutos::where('autoId', $data['autoId'])->first();
            $record->delete();
        } else if ($data['NresidenteId'] != 0) {

            if ($data['residenteId'] != null) {
                // dd( 'Residente' );
                $record = residenteAutos::where('autoId', $data['autoId'])->first();
                $record->residenteId = $data['NresidenteId'];
                $record->save();
            } else {
                // $maquinaria = maquinaria::where('id', $data['autoId'])->first();
                $record = new residenteAutos();
                // dd($request);
                $record->autoId = $data['autoId'];
                $record->residenteId = $data['NresidenteId'];
                $record->save();
            }

            // $record = residenteAutos::where('residenteId', $data['NresidenteId'])->first();
            // $record->autoId = $data['autoId'];
            // $record->save();
        }
        return redirect()->route('mtq.index');
    }


    // public function autoAsignado($autoId)
    // {
    //     $residenteAutos = residenteAutos::where('autoId', $autoId)->get();
    //     return response()->json($residenteAutos);
    // }

    public function asignacionCombustible(Request $request)
    {
        $maquinaria = maquinaria::where('id', $request->maquinariaId)->first();

        if ($maquinaria->cisterna === 0) {
            // dd($maquinaria->cisterna);
            $maquinaria->cisterna = null;
            $maquinaria->save();
        } else {
            $maquinaria->cisterna = 0;
            $maquinaria->save();
        }

        return redirect()->route('mtq.index');
        // return response()->json($residenteAutos);
    }
}
