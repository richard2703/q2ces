<?php

namespace App\Http\Controllers;

use App\Models\obras;
use App\Models\maquinaria;
use App\Models\personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Helpers\Validaciones;
use App\Models\clientes;
use App\Models\conceptos;
use App\Models\obraMaqPer;
use App\Models\obraMaqPerHistorico;
use App\Models\obrasServicios;
use App\Models\residente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class obrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        abort_if(Gate::denies('obra_index'), 403);

        // dd( 'lista de obras' );
        $obras = obras::orderBy('created_at', 'desc')->paginate(15);
        return view('obra.indexObras', compact('obras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        abort_if(Gate::denies('obra_create'), 403);

        $vctMaquinaria = maquinaria::select('*')
            ->where('compania', '=', null)
            ->where('estatusId', '=', 1)
            ->orderBy('maquinaria.identificador', 'asc')->get();
        // $vctPersonal = personal::select( '*', db::raw( 'puesto.nombre AS puesto' ) )

        // ->join( 'puesto', 'puesto.id', '=', 'personal.puestoId' )
        // ->where( 'puesto.puestoNivelId', '=', 5 )->get();
        //*** solo los que son operadores */

        $vctPersonal = personal::select(
            'personal.id',
            DB::raw("CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal"),
            'obras.nombre AS obra',
            'maquinaria.identificador',
            'maquinaria.nombre AS auto',
            'nomina.puestoId',
            'puesto.nombre AS puesto',
            'personal.estatusId',
            'puesto.puestoNivelId',
            'puestoNivel.nombre AS puestoNivel'
        )
            ->join('nomina', 'nomina.personalId', 'personal.id')
            ->join('puesto', 'puesto.id', 'nomina.puestoId')
            ->join('puestoNivel', 'puestoNivel.id', 'puesto.puestoNivelId')
            ->leftjoin('obraMaqPer', 'obraMaqPer.personalId', 'personal.id')
            ->leftjoin('maquinaria', 'maquinaria.id', '=', 'obraMaqPer.maquinariaId')
            ->leftjoin('obras', 'obras.id', '=', 'obraMaqPer.obraId')
            ->where('puesto.puestoNivelId', '=', 5)
            ->where('personal.estatusId', '=', 1) //*** solo operarios de maquinaria con estatus activo */
            ->orderBy('personal.nombres', 'asc')->get();

        $Clientes = clientes::orderBy('clientes.nombre', 'asc')->get();
        $servicios = conceptos::orderBy('codigo', 'asc')->get();
        // dd($servicios);

        // dd( $vctPersonal );
        return view('obra.altaObra', compact('vctMaquinaria', 'vctPersonal', 'Clientes', 'servicios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        abort_if(Gate::denies('obra_create'), 403);

        // dd( $request );
        // $obra = obras::create( $request->only( 'nombre', 'tipo', 'calle', 'numero', 'colonia', 'estado', 'ciudad', 'cp' ) );

        $request->validate([
            'nombre' => 'required|max:250',
            // 'email' => 'required|email|max:200',
            'calle' => 'nullable|max:250',
            'numero' => 'nullable|max:20',
            'colonia' => 'nullable|max:200',
            'cp' => 'nullable|max:99999|numeric',
            'ciudad' => 'nullable|max:200',
            'estado' => 'nullable|max:200',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            // 'email.required' => 'El campo nombre es obligatorio.',
            'calle.max' => 'El campo calle excede el límite de caracteres permitidos.',
            'numero.max' => 'El campo número excede el límite de caracteres permitidos.',
            'colonia.max' => 'El campo colonia excede el límite de caracteres permitidos.',
            'cp.numeric' => 'El campo código postal debe de ser numérico.',
            'cp.min' => 'El campo código postal requiere de al menos 5 caracteres.',
            'cp.max' => 'El campo código postal excede el límite de caracteres permitidos.',
            'ciudad.max' => 'El campo localidad excede el límite de caracteres permitidos.',
            'estado.max' => 'El campo estado excede el límite de caracteres permitidos.',
        ]);


        $objValida = new Validaciones();

        $obra = $request->all();
        $obra['estatus'] = 1;
        $obra = obras::create($obra);

        // $obraId = 1;

        $obraId = $obra->id;

        /*** directorio contenedor de su información */
        $pathObra = str_pad($obra->id, 4, '0', STR_PAD_LEFT);

        if ($request->hasFile('logo')) {
            $obra->logo = time() . '_' . 'logo.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('/public/obras/' . $pathObra, $obra->logo);
            $obra->save();
        }

        if ($request->hasFile('foto')) {
            $obra->foto = time() . '_' . 'foto.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('/public/obras/' . $pathObra, $obra->foto);
            $obra->save();
        }

        $vctDebug = array();
        $objAsigna = new obraMaqPer();
        $objHistorico = new obraMaqPerHistorico();
        //*** registro de maquinas */
        if (is_null($request['maquinariaId']) == false && count($request['maquinariaId']) > 0) {
            for (
                $i = 0;
                $i < count($request['maquinariaId']);
                $i++
            ) {
                //*** se guarda solo si se selecciono una máquina */
                if ($request['maquinariaId'][$i] != '') {

                    //*** realizamos el registro de movimiento */
                    $objResult = $objAsigna->registraMovimiento($request['maquinariaId'][$i], $request['personalId'][$i], $obraId, 0,  $request['combustible'][$i], $request['inicio'][$i], $request['fin'][$i]);
                }
            }
            // dd( $vctDebug );
        }

        if ($request->servicioId[0] != null && $request->precio[0] > 0) {
            for ($i = 0; $i < count($request->servicioId); $i++) {
                //*** se guarda solo si se selecciono una máquina */
                if ($request->servicioId[$i] != '') {


                    $objServicio = new obrasServicios();
                    $objServicio->obraId = $obra->id;
                    $objServicio->conceptoId  = $request->servicioId[$i];
                    $objServicio->precio = $request->precio[$i];
                    $objServicio->save();
                }
            }
            // dd( $vctDebug );
        }



        Session::flash('message', 1);

        return redirect()->route('obras.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\obras  $obras
     * @return \Illuminate\Http\Response
     */

    public function show(obras $obras)
    {
        abort_if(Gate::denies('obra_show'), 403);

        $vctMaquinaria =  maquinaria::select('*')->where('compania', '=', null)->orderBy('maquinaria.identificador', 'asc')->get();

        $vctPersonal = personal::select(
            'personal.id',
            DB::raw("CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal"),
            'obras.nombre AS obra',
            'maquinaria.identificador',
            'maquinaria.nombre AS auto',
            'nomina.puestoId',
            'puesto.nombre AS puesto',
            'puesto.puestoNivelId',
            'personal.estatusId',
            'puestoNivel.nombre AS puestoNivel'
        )
            ->join('nomina', 'nomina.personalId', 'personal.id')
            ->join('puesto', 'puesto.id', 'nomina.puestoId')
            ->join('puestoNivel', 'puestoNivel.id', 'puesto.puestoNivelId')
            ->leftjoin('obraMaqPer', 'obraMaqPer.personalId', 'personal.id')
            ->leftjoin('maquinaria', 'maquinaria.id', '=', 'obraMaqPer.maquinariaId')
            ->leftjoin('obras', 'obras.id', '=', 'obraMaqPer.obraId')
            ->where('puesto.puestoNivelId', '=', 5)
            ->where('personal.estatusId', '=', 1) //*** solo operarios de maquinaria */
            ->orderBy('personal.nombres', 'asc')->get();

        $vctMaquinariaAsignada = obraMaqPer::select('*')->where('obraId', '=', $obras->id)->get();
        $vctResidenteAsignado = residente::select('*')->where('obraId', '=', $obras->id)->get();
        $Clientes = clientes::orderBy('clientes.nombre', 'asc')->get();


        return view('obra.vistaObra', compact('obras', 'vctPersonal', 'vctMaquinaria', 'vctResidenteAsignado', 'vctMaquinariaAsignada', 'Clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\obras  $obras
     * @return \Illuminate\Http\Response
     */

    public function edit(obras $obras)
    {
        abort_if(Gate::denies('obra_edit'), 403);

        $vctMaquinaria =  maquinaria::select('*')
            ->where('compania', '=', null)
            ->where('estatusId', '=', 1)
            ->orderBy('maquinaria.identificador', 'asc')->get();

        // $vctPersonal = personal::select( '*', db::raw( 'puesto.nombre AS puesto' ) )
        // ->join( 'puesto', 'puesto.id', '=', 'personal.puestoId' )
        // ->where( 'puesto.puestoNivelId', '=', 5 )->get();
        //*** solo los que son nivel de operadores */

        $vctPersonal = personal::select(
            'personal.id',
            DB::raw("CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal"),
            'obras.nombre AS obra',
            'maquinaria.identificador',
            'maquinaria.nombre AS auto',
            'nomina.puestoId',
            'puesto.nombre AS puesto',
            'puesto.puestoNivelId',
            'personal.estatusId',
            'puestoNivel.nombre AS puestoNivel'
        )
            ->join('nomina', 'nomina.personalId', 'personal.id')
            ->join('puesto', 'puesto.id', 'nomina.puestoId')
            ->join('puestoNivel', 'puestoNivel.id', 'puesto.puestoNivelId')
            ->leftjoin('obraMaqPer', 'obraMaqPer.personalId', 'personal.id')
            ->leftjoin('maquinaria', 'maquinaria.id', '=', 'obraMaqPer.maquinariaId')
            ->leftjoin('obras', 'obras.id', '=', 'obraMaqPer.obraId')
            ->where('puesto.puestoNivelId', '=', 5)
            ->where('personal.estatusId', '=', 1) //*** solo operarios de maquinaria */
            ->orderBy('personal.nombres', 'asc')->get();

        $vctMaquinariaAsignada = obraMaqPer::select('*')->where('obraId', '=', $obras->id)->get();
        $vctResidenteAsignado = residente::select('*')->where('obraId', '=', $obras->id)->get();
        $Clientes = clientes::orderBy('clientes.nombre', 'asc')->get();
        $servicios = conceptos::orderBy('codigo', 'asc')->get();
        $vctObraServicio = obrasServicios::select('*')->where('obraId', '=', $obras->id)->get();

        // dd($vctObraServicio);

        // dd( $vctResidenteAsignado );
        return view('obra.detalleObra', compact('obras', 'vctPersonal', 'vctMaquinaria', 'vctResidenteAsignado', 'vctMaquinariaAsignada', 'Clientes', 'servicios', 'vctObraServicio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\obras  $obras
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, obras $obras)
    {
        abort_if(Gate::denies('obra_edit'), 403);

        // dd( $request );
        $objValida = new Validaciones();

        $request->validate([
            'nombre' => 'required|max:250',
            'calle' => 'nullable|max:250',
            'numero' => 'nullable|max:20',
            'colonia' => 'nullable|max:200',
            // 'email' => 'require|email|max:200',
            'cp' => 'nullable|max:99999|numeric',
            'ciudad' => 'nullable|max:200',
            'estado' => 'nullable|max:200',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            // 'email.required' => 'El campo email es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'calle.max' => 'El campo calle excede el límite de caracteres permitidos.',
            'numero.max' => 'El campo número excede el límite de caracteres permitidos.',
            'colonia.max' => 'El campo colonia excede el límite de caracteres permitidos.',
            'cp.numeric' => 'El campo código postal debe de ser numérico.',
            'cp.min' => 'El campo código postal requiere de al menos 5 caracteres.',
            'cp.max' => 'El campo código postal excede el límite de caracteres permitidos.',
            'ciudad.max' => 'El campo localidad excede el límite de caracteres permitidos.',
            'estado.max' => 'El campo estado excede el límite de caracteres permitidos.',
        ]);

        $data = $request->all();

        /*** directorio contenedor de su información */
        $pathObra = str_pad($obras->id, 4, '0', STR_PAD_LEFT);

        if ($request->hasFile('logo')) {
            $data['logo'] = time() . '_' . 'logo.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('/public/obras/' . $pathObra, $data['logo']);
        }
        if ($request->hasFile('foto')) {
            $data['foto'] = time() . '_' . 'foto.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('/public/obras/' . $pathObra, $data['foto']);
        }
        $obras->update($data);

        //*** registro de maquinaria */
        $vctRegistrados = $objValida->preparaArreglo(obraMaqPer::where('obraId', '=', $obras->id)->pluck('id')->toArray());
        $vctArreglo = $objValida->preparaArreglo($request['idObraMaqPer']);

        $vctDebug = array();
        $objAsigna = new obraMaqPer();
        $objHistorico = new obraMaqPerHistorico();

        //*** Preguntamos si existen registros en el arreglo */
        if (is_array($vctArreglo) && count($vctArreglo) > 0) {

            //** buscamos si el registrado esta en el arreglo, de no ser asi se elimina */
            if (is_array($vctRegistrados) && count($vctRegistrados) > 0) {
                for (
                    $i = 0;
                    $i < count($vctRegistrados);
                    $i++
                ) {
                    $intValor = (int) $vctRegistrados[$i];

                    if (in_array($intValor, $vctArreglo) == false) {
                        /*** no existe y se debe de eliminar */

                        $objResult = $objAsigna->eliminarReferenciaDeOperador($vctRegistrados[$i]);
                    } else {
                        /*** existe el registro */
                    }
                }
            }

            //*** trabajamos el resto */
            for (
                $i = 0;
                $i < count($request['maquinariaId']);
                $i++
            ) {

                // dd($request[ 'maquinariaId' ][ $i ], $request[ 'personalId' ][ $i ],$request[ 'obraId' ], $request[ 'idObraMaqPer' ][ $i ],  $request[ 'combustible' ][ $i ], $request[ 'inicio' ][ $i ], $request[ 'fin' ][ $i ] );
                //*** realizamos el registro de movimiento */
                $objResult = $objAsigna->registraMovimiento($request['maquinariaId'][$i], $request['personalId'][$i], $request['obraId'], $request['idObraMaqPer'][$i],  $request['combustible'][$i], $request['inicio'][$i], $request['fin'][$i]);
            }
        } else {
            //*** se deben de eliminar todos los registrados */
            if (is_array($vctRegistrados) && count($vctRegistrados) > 0) {
                for (
                    $i = 0;
                    $i < count($vctRegistrados);
                    $i++
                ) {

                    $objResult = $objAsigna->eliminarReferenciaDeOperador($vctRegistrados[$i]);
                }
            }
        }

        $nuevaLista = collect();
        // dd($request);

        if ($request->servicioId[0] != null && $request->precio[0] > 0) {
            # code...

            for ($i = 0; $i < count($request->servicioId); $i++) {

                $array = [
                    'id' => $request->Idser[$i],
                    'obraId' => $request->obraId,
                    'conceptoId' => $request->servicioId[$i],
                    'precio' => $request->precio[$i],
                ];
                $objRelacion = obrasServicios::updateOrCreate(['id' => $array['id']], $array);
                $nuevaLista->push($objRelacion->id);
            }
            $test = obrasServicios::where('obraId', $request->obraId)->whereNotIn('id', $nuevaLista)->delete();
        }

        // dd( $vctDebug, $request );

        Session::flash('message', 1);

        return redirect()->route('obras.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\obras  $obras
     * @return \Illuminate\Http\Response
     */

    public function destroy(obras $obras)
    {
        // dd( 'test' );
        abort_if(Gate::denies('obra_destroy'), 403);
        return redirect()->back()->with('failed', 'No se puede eliminar');
    }
}
