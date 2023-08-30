<?php

namespace App\Http\Controllers;

use App\Models\obras;
use App\Models\maquinaria;
use App\Models\personal;
use App\Models\obramaqpr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Helpers\Validaciones;
use App\Models\clientes;
use App\Models\obraMaqPer;
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
        $obras = obras::orderBy('created_at', 'desc')->paginate(5);
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

        $vctMaquinaria = maquinaria::all();
        $vctPersonal = personal::all();
        $Clientes = clientes::all();
        // dd($Clientes);
        return view('obra.altaObra', compact('vctMaquinaria', 'vctPersonal', 'Clientes'));
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
        $obra['estatus'] = 'Activa';
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

        //*** registro de residentes */
        // dd($request);
        // for ($i = 0; $i < count($request['rnombre']); $i++) {
        //     //*** se guarda solo si se selecciono una máquina */
        //     if ($request['rnombre'][$i] != '') {
        //         $objResidente = new residente();
        //         $objResidente->obraid  = $obraId;
        //         $objResidente->userid  = 1;
        //         $objResidente->nombre  = $objValida->validaTexto($request['rnombre'][$i]);
        //         $objResidente->empresa  = $objValida->validaTexto($request['rempresa'][$i]);
        //         $objResidente->telefono = $objValida->validaTelefono($request['rtelefono'][$i]);
        //         $objResidente->puesto = $objValida->validaTexto($request['rpuesto'][$i]);
        //         $objResidente->firma = $objValida->validaTexto($request['rfirma'][$i]);
        //         $objResidente->email = $objValida->validaTexto($request['remail'][$i]);
        //         $objResidente->save();
        //     }
        // }

        //*** registro de maquinas */
        for (
            $i = 0;
            $i < count($request['maquinariaId']);
            $i++
        ) {
            //*** se guarda solo si se selecciono una máquina */
            if ($request['maquinariaId'][$i] != '') {
                $objMaq = new obraMaqPer();
                $objMaq->obraId  = $obraId;
                $objMaq->maquinariaId = $request['maquinariaId'][$i];
                $objMaq->personalId  = $request['personalId'][$i];
                $objMaq->inicio  = $request['inicio'][$i];
                $objMaq->fin  = $request['fin'][$i];
                $objMaq->combustible  = $request['combustible'][$i];
                $objMaq->save();
            }
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

        $vctResidenteAsignado = residente::select('*')->where('obraId', '=', $obras->id)->get();

        $vctMaquinariaAsignada = obraMaqPer::select(
            'obramaqper.*',
            db::raw("CONCAT(maquinaria.identificador,' ',maquinaria.nombre) AS maquinaria"),
        )
            ->join('maquinaria', 'maquinaria.id', '=', 'obramaqper.maquinariaId')
            ->where('obraId', '=', $obras->id)->get();

        // dd( $vctMaquinariaAsignada );

        return view('obra.vistaObra', compact('obras'), compact('vctResidenteAsignado', 'vctMaquinariaAsignada'));
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

        $vctMaquinaria = maquinaria::all();
        $vctPersonal = personal::all();

        $vctMaquinariaAsignada = obraMaqPer::select('*')->where('obraId', '=', $obras->id)->get();
        $vctResidenteAsignado = residente::select('*')->where('obraId', '=', $obras->id)->get();
        $Clientes = clientes::all();

        // dd( $vctResidenteAsignado );
        return view('obra.detalleObra', compact('obras', 'vctPersonal', 'vctMaquinaria', 'vctResidenteAsignado', 'vctMaquinariaAsignada', 'Clientes'));
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

        // $data = $request->only(
        //     'nombre',
        //     'calle',
        //     'numero',
        //     'colonia',
        //     'estado',
        //     'ciudad',
        //     'cp',
        //     'foto',
        //     'logo',
        // );

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

        //*** registro de residentes */
        // $vctRegistrados = $objValida->preparaArreglo(residente::where('obraId', '=', $obras->id)->pluck('id')->toArray());
        // $vctArreglo = $objValida->preparaArreglo($request['idResidente']);

        //*** Preguntamos si existen registros en el arreglo */
        // if (is_array($vctArreglo) && count($vctArreglo) > 0) {

        //     //** buscamos si el registrado esta en el arreglo, de no ser asi se elimina */
        //     if (is_array($vctRegistrados) && count($vctRegistrados) > 0) {
        //         for ($i = 0; $i < count($vctRegistrados); $i++) {
        //             $intValor = (int) $vctRegistrados[$i];

        //             if (in_array($intValor, $vctArreglo) == false) {
        //                 /*** no existe y se debe de eliminar */
        //                 residente::destroy($vctRegistrados[$i]);
        //                 // dd( 'Borrando por que se quito el residente' );
        //             } else {
        //                 /*** existe el registro */
        //                 // dd( 'Sigue vivo en el arreglo' );
        //             }
        //         }
        //     }

        //     //*** trabajamos el resto */
        //     for (
        //         $i = 0;
        //         $i < count($request['idResidente']);
        //         $i++
        //     ) {
        //         // if ($request['idResidente'][$i] != '') {
        //         //     //** Actualizacion de registro */
        //         //     $objResidente =  residente::where('id', '=', $request['idResidente'][$i])->first();

        //         //     if ($objResidente && $objResidente->id > 0) {
        //         //         $objResidente->nombre  = $objValida->validaTexto($request['rnombre'][$i]);
        //         //         $objResidente->empresa  = $objValida->validaTexto($request['rempresa'][$i]);
        //         //         $objResidente->telefono = $objValida->validaTelefono($request['rtelefono'][$i]);
        //         //         $objResidente->puesto = $objValida->validaTexto($request['rpuesto'][$i]);
        //         //         $objResidente->firma = $objValida->validaTexto($request['rfirma'][$i]);
        //         //         $objResidente->email = $objValida->validaEmail($request['remail'][$i]);
        //         //         $objResidente->save();
        //         //         // dd( 'Actualizando residente' );
        //         //     }
        //         // } else {

        //         //     //** No existe en bd */
        //         //     if ($request['rnombre'][$i] != '') {
        //         //         $objResidente = new residente();
        //         //         $objResidente->obraid  = $obras->id;
        //         //         $objResidente->userid  = 1;
        //         //         $objResidente->nombre  = $objValida->validaTexto($request['rnombre'][$i]);
        //         //         $objResidente->empresa  = $objValida->validaTexto($request['rempresa'][$i]);
        //         //         $objResidente->telefono = $objValida->validaTelefono($request['rtelefono'][$i]);
        //         //         $objResidente->puesto = $objValida->validaTexto($request['rpuesto'][$i]);
        //         //         $objResidente->firma = $objValida->validaTexto($request['rfirma'][$i]);
        //         //         $objResidente->email = $objValida->validaEmail($request['remail'][$i]);
        //         //         $objResidente->save();
        //         //         // dd( 'Guardando residente' );
        //         //     }
        //         // }
        //     }
        // } else {
        //     //*** se deben de eliminar todos los registrados */
        //     // if (is_array($vctRegistrados) && count($vctRegistrados) > 0) {
        //     //     for (
        //     //         $i = 0;
        //     //         $i < count($vctRegistrados);
        //     //         $i++
        //     //     ) {
        //     //         residente::destroy($vctRegistrados[$i]);
        //     //         // dd( 'Borrando todo residente' );
        //     //     }
        //     // }
        // }

        //*** registro de maquinaria */
        $vctRegistrados = $objValida->preparaArreglo(obraMaqPer::where('obraId', '=', $obras->id)->pluck('id')->toArray());
        $vctArreglo = $objValida->preparaArreglo($request['idObraMaqPer']);

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
                        obraMaqPer::destroy($vctRegistrados[$i]);
                        // dd( 'Borrando por que se quito la maquina' );
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
                if ($request['idObraMaqPer'][$i] != '') {
                    //** Actualizacion de registro */
                    $objMaq =  obraMaqPer::where('id', '=', $request['idObraMaqPer'][$i])->first();

                    if ($objMaq && $objMaq->id > 0) {
                        $objMaq->maquinariaId = $request['maquinariaId'][$i];
                        $objMaq->personalId  = $request['personalId'][$i];
                        $objMaq->inicio  = $request['inicio'][$i];
                        $objMaq->fin  = $request['fin'][$i];
                        $objMaq->combustible  = $request['combustible'][$i];
                        $objMaq->save();
                        // dd( 'Actualizando Maq' );
                    }
                } else {

                    //** No existe en bd */
                    if ($request['maquinariaId'][$i] != '') {
                        $objMaq = new obraMaqPer();
                        $objMaq->obraId  = $obras->id;
                        $objMaq->maquinariaId = $request['maquinariaId'][$i];
                        $objMaq->personalId  = $request['personalId'][$i];
                        $objMaq->inicio  = $request['inicio'][$i];
                        $objMaq->fin  = $request['fin'][$i];
                        $objMaq->combustible  = $request['combustible'][$i];
                        $objMaq->save();
                        // dd( 'Guardando Maq' );
                    }
                }
            }
        } else {
            //*** se deben de eliminar todos los registrados */
            if (is_array($vctRegistrados) && count($vctRegistrados) > 0) {
                for (
                    $i = 0;
                    $i < count($vctRegistrados);
                    $i++
                ) {
                    obraMaqPer::destroy($vctRegistrados[$i]);
                    // dd( 'Borrando todo obra per maq' );
                }
            }
        }

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
        // dd('test');
        return redirect()->back()->with('failed', 'No se puede eliminar');
    }
}
