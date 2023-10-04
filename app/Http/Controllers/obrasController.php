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
use App\Models\obraMaqPer;
use App\Models\obraMaqPerHistorico;
use App\Models\residente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class obrasController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        abort_if ( Gate::denies( 'obra_index' ), 403 );

        // dd( 'lista de obras' );
        $obras = obras::orderBy( 'created_at', 'desc' )->paginate( 15 );
        return view( 'obra.indexObras', compact( 'obras' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        abort_if ( Gate::denies( 'obra_create' ), 403 );

        $vctMaquinaria = maquinaria::select( '*' )->where( 'compania', '=', null )->orderBy( 'maquinaria.identificador', 'asc' )->get();
        // $vctPersonal = personal::select( '*', db::raw( 'puesto.nombre AS puesto' ) )

        // ->join( 'puesto', 'puesto.id', '=', 'personal.puestoId' )
        // ->where( 'puesto.puestoNivelId', '=', 5 )->get();
        //*** solo los que son operadores */

        $vctPersonal = personal::select(
            'personal.id',
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            'obras.nombre AS obra',
            'maquinaria.identificador',
            'maquinaria.nombre AS auto',
            'nomina.puestoId',
            'puesto.nombre AS puesto',
            'puesto.puestoNivelId',
            'puestoNivel.nombre AS puestoNivel'
        )
        ->join( 'nomina', 'nomina.personalId', 'personal.id' )
        ->join( 'puesto', 'puesto.id', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', 'puesto.puestoNivelId' )
        ->leftjoin( 'obraMaqPer', 'obraMaqPer.personalId', 'personal.id' )
        ->leftjoin( 'maquinaria', 'maquinaria.id', '=', 'obraMaqPer.maquinariaId' )
        ->leftjoin( 'obras', 'obras.id', '=', 'obraMaqPer.obraId' )
        ->where( 'puesto.puestoNivelId', '=', 5 ) //*** solo operarios de maquinaria */
        ->orderBy( 'personal.nombres', 'asc' )->get();

        $Clientes = clientes::orderBy( 'clientes.nombre', 'asc' )->get();

        // dd( $vctPersonal );
        return view( 'obra.altaObra', compact( 'vctMaquinaria', 'vctPersonal', 'Clientes' ) );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        abort_if ( Gate::denies( 'obra_create' ), 403 );

        // dd( $request );
        // $obra = obras::create( $request->only( 'nombre', 'tipo', 'calle', 'numero', 'colonia', 'estado', 'ciudad', 'cp' ) );

        $request->validate( [
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
        ] );

        $objValida = new Validaciones();

        $obra = $request->all();
        $obra[ 'estatus' ] = 'Activa';
        $obra = obras::create( $obra );

        // $obraId = 1;

        $obraId = $obra->id;

        /*** directorio contenedor de su información */
        $pathObra = str_pad( $obra->id, 4, '0', STR_PAD_LEFT );

        if ( $request->hasFile( 'logo' ) ) {
            $obra->logo = time() . '_' . 'logo.' . $request->file( 'logo' )->getClientOriginalExtension();
            $request->file( 'logo' )->storeAs( '/public/obras/' . $pathObra, $obra->logo );
            $obra->save();
        }

        if ( $request->hasFile( 'foto' ) ) {
            $obra->foto = time() . '_' . 'foto.' . $request->file( 'foto' )->getClientOriginalExtension();
            $request->file( 'foto' )->storeAs( '/public/obras/' . $pathObra, $obra->foto );
            $obra->save();
        }

        $vctDebug = array();
        $objAsigna = new obraMaqPer();
        $objHistorico = new obraMaqPerHistorico();
        //*** registro de maquinas */
        if ( is_null( $request[ 'maquinariaId' ] ) == false && count( $request[ 'maquinariaId' ] ) > 0 ) {
            for ( $i = 0; $i < count( $request[ 'maquinariaId' ] );
            $i++ ) {
                //*** se guarda solo si se selecciono una máquina */
                if ( $request[ 'maquinariaId' ][ $i ] != '' ) {

                    //*** realizamos el registro de movimiento */
                    $objResult = $objAsigna->registraMovimiento( $request[ 'maquinariaId' ][ $i ], $request[ 'personalId' ][ $i ], $obraId, 0,  $request[ 'combustible' ][ $i ], $request[ 'inicio' ][ $i ], $request[ 'fin' ][ $i ] ) ;

                    //*** preguntamos si la maquina ya esta asignada */
                    // $vctDebug[] = 'Validamos si la maquinariaId->' .  $request[ 'maquinariaId' ][ $i ] . ' ya esta registrada...';
                    // $objEnObra = obraMaqPer::where( 'maquinariaId', $request[ 'maquinariaId' ][ $i ] )->first();

                    // if ( $objEnObra ) {

                    //     $vctDebug[] = 'La maquinariaId->'. $request[ 'maquinariaId' ][ $i ].' esta en el registro obraId->' . $objEnObra->id;

                    //     if ( $objEnObra ) {

                    //         //*** preguntamos si se trata de la misma obra */
                    //         $vctDebug[] = 'Validamos si se trata de la misma maquina: maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' == enObra->maquinariaId->'. $objEnObra->maquinariaId ;

                    //         if ( $objEnObra->maquinariaId ==  $request[ 'maquinariaId' ][ $i ] ) {

                    //             //*** preguntamos si se trata del mismo operador */
                    //             $vctDebug[] = 'Validamos si se trata del misma operador: operadorId->'. $request[ 'personalId' ][ $i ] . ' == enObra->operadorId->'. $objEnObra->personalId ;
                    //             $strObraAnterior = $objEnObra->obraId;
                    //             if ( $objEnObra->personalId ==  $request[ 'personalId' ][ $i ] ) {
                    //                 //*** es el mismo operador */
                    //                 $vctDebug[] = 'Se trata del mismo operador: EnObra->operadorId->'. $objEnObra->obraId .' != operadorId-> '. $request[ 'personalId' ][ $i ];
                    //                 //*** asignamos al registro la nueva obra */
                    //                 $vctDebug[] = 'Se actualiza el registro de EnObra->obraId->' . $strObraAnterior . ' a obraId->' . $obraId . ', la información de maquinaria y operador continua igual';
                    //                 $objEnObra->obraId = $obraId;
                    //                 $objEnObra->inicio  = $request[ 'inicio' ][ $i ];
                    //                 $objEnObra->fin  = $request[ 'fin' ][ $i ];
                    //                 $objEnObra->combustible  = $request[ 'combustible' ][ $i ];
                    //                 $objEnObra->save();

                    //                 $objHistorico->registraHistorico( $objEnObra, 'OBRAS: la maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' y el operadorId->'. $request[ 'personalId' ][ $i ] . ',  ya estaban en un registro existente obraId->'.$strObraAnterior.', por lo que solo se cambio a la nueva obraId->' . $obraId ) ;
                    //                 $vctDebug[] = $objEnObra;

                    //             } else {
                    //                 //*** es otro operador */
                    //                 $vctDebug[] = 'Se trata de otro operador: EnObra->operadorId->'. $objEnObra->obraId .' != operadorId-> '. $request[ 'personalId' ][ $i ];
                    //                 $objOperadorAsignado = obraMaqPer::where( 'personalId', $request[ 'personalId' ][ $i ] )->first();

                    //                 $vctDebug[] = 'Validamos si el operadorId->'. $request[ 'personalId' ][ $i ]. ' esta en otro registro...';

                    //                 if ( $objOperadorAsignado ) {

                    //                     $vctDebug[] = 'El operadorId->'. $request[ 'personalId' ][ $i ] .' esta en el registro de obraId->' . $objOperadorAsignado->obraId;

                    //                     $vctDebug[] = 'El operadorId->'. $request[ 'personalId' ][ $i ] .' se libera del registro : ' . $objOperadorAsignado->obraId;
                    //                     $objOperadorAsignado->personalId = null;
                    //                     $objOperadorAsignado->save();
                    //                     $objHistorico->registraHistorico( $objOperadorAsignado, 'OBRAS: se libera el EnObra->operadorId->'. $request[ 'personalId' ][ $i ] .' de la obraId->'. $strObraAnterior .' por cambio a la obraId->' . $obraId ) ;
                    //                     $vctDebug[] = 'El operadorId->'.$request[ 'personalId' ][ $i ] .' se libera de la obraId->' . $objOperadorAsignado->obraId;

                    //                     $objEnObra->obraId  = $obraId;
                    //                     $objEnObra->personalId  = $request[ 'personalId' ][ $i ];
                    //                     $objEnObra->inicio  = $request[ 'inicio' ][ $i ];
                    //                     $objEnObra->fin  = $request[ 'fin' ][ $i ];
                    //                     $objEnObra->combustible  = $request[ 'combustible' ][ $i ];
                    //                     $objEnObra->save();

                    //                     $objHistorico->registraHistorico( $objEnObra, 'OBRAS: la maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' ya estaban en un registro existente obraId->'.$strObraAnterior.', por lo que solo se cambio a la nueva obraId->' . $obraId . ' y se asigno al operadorId->'.$request[ 'personalId' ][ $i ] . ' que se libero de la obraId->'. $objOperadorAsignado->obraId ) ;
                    //                     $vctDebug[] = 'Se actualiza el registro de EnObra->obraId->' . $strObraAnterior . ' a obraId->' . $obraId . ', y se asigna al operadorId->'.$request[ 'personalId' ][ $i ]. ' que se libero de la obraId->'. $objOperadorAsignado->obraId ;
                    //                     $vctDebug[] = $objEnObra;

                    //                 } else {
                    //                     $vctDebug[] = 'El operadorId->'. $request[ 'personalId' ][ $i ]. ' No esta registrado...' ;
                    //                     $objEnObra->obraId  = $obraId;
                    //                     $objEnObra->personalId  = $request[ 'personalId' ][ $i ];
                    //                     $objEnObra->inicio  = $request[ 'inicio' ][ $i ];
                    //                     $objEnObra->fin  = $request[ 'fin' ][ $i ];
                    //                     $objEnObra->combustible  = $request[ 'combustible' ][ $i ];
                    //                     $objEnObra->save();

                    //                     $objHistorico->registraHistorico( $objEnObra, 'OBRAS: la maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' ya estaban en un registro existente obraId->'.$strObraAnterior.', por lo que solo se cambio a la nueva obraId->' . $obraId . ' y se asigno al operadorId->'.$request[ 'personalId' ][ $i ] ) ;
                    //                     $vctDebug[] = 'Se actualiza el registro de EnObra->obraId->' . $strObraAnterior . ' a obraId->' . $obraId . ', y se asigna al operadorId->'.$request[ 'personalId' ][ $i ];
                    //                     $vctDebug[] = $objEnObra;
                    //                 }
                    //             }

                    //         } else {
                    //             //*** es otra maquinaria */
                    //             $vctDebug[] = '¿Que paso aqui?';
                    //             dd( $vctDebug );

                    //         }

                    //     } else {

                    //         $vctDebug[] = 'No existe registro';

                    //     }

                    // } else {

                    //     $vctDebug[] = 'La maquinariaId->' .  $request[ 'maquinariaId' ][ $i ] . ' No esta registrada...';

                    //     $vctDebug[] = 'Validamos si el operadorId->'.  $request[ 'personalId' ][ $i ] .' ya esta registrado en otra maquina de una obra...';
                    //     $objOperadorAsignado = obraMaqPer::where( 'personalId', $request[ 'personalId' ][ $i ] )->first();

                    //     if ( $objOperadorAsignado ) {
                    //         $vctDebug[] = 'El operadorId->'.  $request[ 'personalId' ][ $i ] .' existe en el registro de obraId->' . $objOperadorAsignado->id;

                    //         $objOperadorAsignado->personalId = null;
                    //         $objOperadorAsignado->save();
                    //         //*** registro de historico */
                    //         $objHistorico->registraHistorico(
                    //             $objOperadorAsignado,
                    //             'OBRAS: Se libera operadorId->'.  $request[ 'personalId' ][ $i ] .' de la obraId->' . $objOperadorAsignado->id . ', para ser asignado a la obraId-> ' . $obraId
                    // ) ;

                    //         $vctDebug[] = 'El operadorId->'.  $request[ 'personalId' ][ $i ] .' se libera del registro de obraId->' . $objOperadorAsignado->id;

                    //     } else {
                    //         $vctDebug[] = 'El operador No esta registrado...' ;
                    //     }

                    //     $objMaq = new obraMaqPer();
                    //     $objMaq->obraId  = $obraId;
                    //     $objMaq->maquinariaId = $request[ 'maquinariaId' ][ $i ];
                    //     $objMaq->personalId  = $request[ 'personalId' ][ $i ];
                    //     $objMaq->inicio  = $request[ 'inicio' ][ $i ];
                    //     $objMaq->fin  = $request[ 'fin' ][ $i ];
                    //     $objMaq->combustible  = $request[ 'combustible' ][ $i ];
                    //     $objMaq->save();

                    //     $objHistorico->registraHistorico(
                    //         $objMaq, 'OBRAS: Nueva Obra, obraId->'.$obraId .
                    //         ',  maquinariaId->' . $request[ 'maquinariaId' ][ $i ] .
                    //         ', operadorId->'.$request[ 'personalId' ][ $i ]
                    // ) ;

                    //     $vctDebug[] = 'Registramos el equipo: ' . $request[ 'maquinariaId' ][ $i ] .' en nueva Obra: ' . $objMaq->obraId;
                    //     $vctDebug[] = 'Registramos el operador: ' . $request[ 'personalId' ][ $i ] . ' en Nueva Obra: ' . $objMaq->obraId;
                    //     $vctDebug[] = $objMaq;
                    // }

                }
            }
            // dd( $vctDebug );
        }

        Session::flash( 'message', 1 );

        return redirect()->route( 'obras.index' );
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\obras  $obras
    * @return \Illuminate\Http\Response
    */

    public function show( obras $obras ) {
        abort_if ( Gate::denies( 'obra_show' ), 403 );

        $vctResidenteAsignado = residente::select( '*' )->where( 'obraId', '=', $obras->id )->get();

        $vctMaquinariaAsignada = obraMaqPer::select(
            'obraMaqPer.*',
            db::raw( "CONCAT(maquinaria.identificador,' ',maquinaria.nombre) AS maquinaria" ),
        )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'obraMaqPer.maquinariaId' )
        ->where( 'obraMaqPer.obraId', '=', $obras->id )->get();

        // dd( $vctMaquinariaAsignada );

        return view( 'obra.vistaObra', compact( 'obras' ), compact( 'vctResidenteAsignado', 'vctMaquinariaAsignada' ) );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\obras  $obras
    * @return \Illuminate\Http\Response
    */

    public function edit( obras $obras ) {
        abort_if ( Gate::denies( 'obra_edit' ), 403 );

        $vctMaquinaria =  maquinaria::select( '*' )->where( 'compania', '=', null )->orderBy( 'maquinaria.identificador', 'asc' )->get();

        // $vctPersonal = personal::select( '*', db::raw( 'puesto.nombre AS puesto' ) )
        // ->join( 'puesto', 'puesto.id', '=', 'personal.puestoId' )
        // ->where( 'puesto.puestoNivelId', '=', 5 )->get();
        //*** solo los que son nivel de operadores */

        $vctPersonal = personal::select(
            'personal.id',
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            'obras.nombre AS obra',
            'maquinaria.identificador',
            'maquinaria.nombre AS auto',
            'nomina.puestoId',
            'puesto.nombre AS puesto',
            'puesto.puestoNivelId',
            'puestoNivel.nombre AS puestoNivel'
        )
        ->join( 'nomina', 'nomina.personalId', 'personal.id' )
        ->join( 'puesto', 'puesto.id', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', 'puesto.puestoNivelId' )
        ->leftjoin( 'obraMaqPer', 'obraMaqPer.personalId', 'personal.id' )
        ->leftjoin( 'maquinaria', 'maquinaria.id', '=', 'obraMaqPer.maquinariaId' )
        ->leftjoin( 'obras', 'obras.id', '=', 'obraMaqPer.obraId' )
        ->where( 'puesto.puestoNivelId', '=', 5 ) //*** solo operarios de maquinaria */
        ->orderBy( 'personal.nombres', 'asc' )->get();

        $vctMaquinariaAsignada = obraMaqPer::select( '*' )->where( 'obraId', '=', $obras->id )->get();
        $vctResidenteAsignado = residente::select( '*' )->where( 'obraId', '=', $obras->id )->get();
        $Clientes = clientes::orderBy( 'clientes.nombre', 'asc' )->get();

        // dd( $vctResidenteAsignado );
        return view( 'obra.detalleObra', compact( 'obras', 'vctPersonal', 'vctMaquinaria', 'vctResidenteAsignado', 'vctMaquinariaAsignada', 'Clientes' ) );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\obras  $obras
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, obras $obras ) {
        abort_if ( Gate::denies( 'obra_edit' ), 403 );

        // dd( $request );
        $objValida = new Validaciones();

        $request->validate( [
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
        ] );

        $data = $request->all();

        /*** directorio contenedor de su información */
        $pathObra = str_pad( $obras->id, 4, '0', STR_PAD_LEFT );

        if ( $request->hasFile( 'logo' ) ) {
            $data[ 'logo' ] = time() . '_' . 'logo.' . $request->file( 'logo' )->getClientOriginalExtension();
            $request->file( 'logo' )->storeAs( '/public/obras/' . $pathObra, $data[ 'logo' ] );
        }
        if ( $request->hasFile( 'foto' ) ) {
            $data[ 'foto' ] = time() . '_' . 'foto.' . $request->file( 'foto' )->getClientOriginalExtension();
            $request->file( 'foto' )->storeAs( '/public/obras/' . $pathObra, $data[ 'foto' ] );
        }
        $obras->update( $data );

        //*** registro de maquinaria */
        $vctRegistrados = $objValida->preparaArreglo( obraMaqPer::where( 'obraId', '=', $obras->id )->pluck( 'id' )->toArray() );
        $vctArreglo = $objValida->preparaArreglo( $request[ 'idObraMaqPer' ] );

        $vctDebug = array();
        $objAsigna = new obraMaqPer();
        $objHistorico = new obraMaqPerHistorico();

        //*** Preguntamos si existen registros en el arreglo */
        if ( is_array( $vctArreglo ) && count( $vctArreglo ) > 0 ) {

            //** buscamos si el registrado esta en el arreglo, de no ser asi se elimina */
            if ( is_array( $vctRegistrados ) && count( $vctRegistrados ) > 0 ) {
                for (
                    $i = 0; $i < count( $vctRegistrados );
                    $i++
                ) {
                    $intValor = ( int ) $vctRegistrados[ $i ];

                    if ( in_array( $intValor, $vctArreglo ) == false ) {
                        /*** no existe y se debe de eliminar */

                        $objResult = $objAsigna->eliminarReferenciaDeOperador( $vctRegistrados[ $i ] ) ;

                        // $objMaq = obraMaqPer::where( 'id', '=', $vctRegistrados[ $i ] )->first();
                        // $vctDebug[] = 'Buscamos el registro->' . $vctRegistrados[ $i ];

                        // if ( $objMaq ) {
                        //     $strOperador = $objMaq->personalId;
                        //     $objMaq->obraId = 1;
                        //     $objMaq->personalId = null;
                        //     $objMaq->combustible = 0;
                        //     $objMaq->inicio = null;
                        //     $objMaq->fin = null;
                        //     $objMaq->save();

                        //     $vctDebug[] = 'Se reasigna la maquinaria->'. $objMaq->maquinariaId.' al centro de control que es la obraId->1, y se libera al OperadorId->'. $strOperador  ;
                        //     $objHistorico->registraHistorico( $objMaq, 'OBRAS: Se reasigna la maquinaria->'. $objMaq->maquinariaId.' al centro de control que es la obraId->1, y se libera al OperadorId->'. $strOperador ) ;

                        // }

                    } else {
                        /*** existe el registro */
                    }
                }
            }

            //*** trabajamos el resto */
            for (
                $i = 0; $i < count( $request[ 'maquinariaId' ] );
                $i++
            ) {

                // dd($request[ 'maquinariaId' ][ $i ], $request[ 'personalId' ][ $i ],$request[ 'obraId' ], $request[ 'idObraMaqPer' ][ $i ],  $request[ 'combustible' ][ $i ], $request[ 'inicio' ][ $i ], $request[ 'fin' ][ $i ] );
                //*** realizamos el registro de movimiento */
                $objResult = $objAsigna->registraMovimiento( $request[ 'maquinariaId' ][ $i ], $request[ 'personalId' ][ $i ],$request[ 'obraId' ], $request[ 'idObraMaqPer' ][ $i ],  $request[ 'combustible' ][ $i ], $request[ 'inicio' ][ $i ], $request[ 'fin' ][ $i ] ) ;

                // $vctDebug[] = 'Validamos si existe en BD el record->' .  $request[ 'idObraMaqPer' ][ $i ] ;

                // if ( $request[ 'idObraMaqPer' ][ $i ] != '' ) {

                //     $vctDebug[] = 'record->' .  $request[ 'idObraMaqPer' ][ $i ] ;

                //     //** Actualizacion de registro */
                //     $objEnObra =  obraMaqPer::where( 'id', '=', $request[ 'idObraMaqPer' ][ $i ] )->first();

                //     // if ( $objEnObra ) {

                //     $vctDebug[] = 'La maquinariaId->'. $request[ 'maquinariaId' ][ $i ].' esta en el registro obraId->' . $objEnObra->id;

                //     //*** preguntamos si se trata de la misma obra */
                //     $vctDebug[] = 'Validamos si se trata de la misma maquina: maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' == enObra->maquinariaId->'. $objEnObra->maquinariaId ;

                //     if ( $objEnObra->maquinariaId ==  $request[ 'maquinariaId' ][ $i ] ) {

                //         //*** preguntamos si se trata del mismo operador */
                //         $vctDebug[] = 'Validamos si se trata del misma operador: operadorId->'. $request[ 'personalId' ][ $i ] . ' == enObra->operadorId->'. $objEnObra->personalId ;
                //         $strObraAnterior = $objEnObra->obraId;
                //         if ( $objEnObra->personalId ==  $request[ 'personalId' ][ $i ] ) {
                //             //*** es el mismo operador */
                //             $vctDebug[] = 'Se trata del mismo operador: EnObra->operadorId->'. $objEnObra->obraId .' != operadorId-> '. $request[ 'personalId' ][ $i ];
                //             //*** asignamos al registro la nueva obra */
                //             $vctDebug[] = 'Se actualiza el registro de EnObra->obraId->' . $strObraAnterior . ' a obraId->' .  $request[ 'obraId' ]  . ', la información de maquinaria y operador continua igual';
                //             $objEnObra->obraId =  $request[ 'obraId' ] ;
                //             $objEnObra->inicio  = $request[ 'inicio' ][ $i ];
                //             $objEnObra->fin  = $request[ 'fin' ][ $i ];
                //             $objEnObra->combustible  = $request[ 'combustible' ][ $i ];
                //             $objEnObra->save();

                //             $objHistorico->registraHistorico( $objEnObra, 'OBRAS: la maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' y el operadorId->'. $request[ 'personalId' ][ $i ] . ',  ya estaban en un registro existente obraId->'.$strObraAnterior.', por lo que solo se cambio a la nueva obraId->' .  $request[ 'obraId' ] ) ;
                //             $vctDebug[] = $objEnObra;

                //         } else {
                //             //*** es otro operador */
                //             $vctDebug[] = 'Se trata de otro operador: EnObra->operadorId->'. $objEnObra->obraId .' != operadorId-> '. $request[ 'personalId' ][ $i ];
                //             $objOperadorAsignado = obraMaqPer::where( 'personalId', $request[ 'personalId' ][ $i ] )->first();

                //             $vctDebug[] = 'Validamos si el operadorId->'. $request[ 'personalId' ][ $i ]. ' esta en otro registro...';

                //             if ( $objOperadorAsignado ) {

                //                 $vctDebug[] = 'El operadorId->'. $request[ 'personalId' ][ $i ] .' esta en el registro de obraId->' . $objOperadorAsignado->obraId;

                //                 $vctDebug[] = 'El operadorId->'. $request[ 'personalId' ][ $i ] .' se libera del registro : ' . $objOperadorAsignado->obraId;
                //                 $objOperadorAsignado->personalId = null;
                //                 $objOperadorAsignado->save();
                //                 $objHistorico->registraHistorico( $objOperadorAsignado, 'OBRAS: se libera el EnObra->operadorId->'. $request[ 'personalId' ][ $i ] .' de la obraId->'. $strObraAnterior .' por cambio a la obraId->' . $request[ 'obraId' ] ) ;
                //                 $vctDebug[] = 'El operadorId->'.$request[ 'personalId' ][ $i ] .' se libera de la obraId->' . $objOperadorAsignado->obraId;

                //                 $objEnObra->obraId  =  $request[ 'obraId' ] ;
                //                 $objEnObra->personalId  = $request[ 'personalId' ][ $i ];
                //                 $objEnObra->inicio  = $request[ 'inicio' ][ $i ];
                //                 $objEnObra->fin  = $request[ 'fin' ][ $i ];
                //                 $objEnObra->combustible  = $request[ 'combustible' ][ $i ];
                //                 $objEnObra->save();

                //                 $objHistorico->registraHistorico( $objEnObra, 'OBRAS: la maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' ya estaban en un registro existente obraId->'.$strObraAnterior.', por lo que solo se cambio a la nueva obraId->' .  $request[ 'obraId' ] . ' y se asigno al operadorId->'.$request[ 'personalId' ][ $i ] . ' que se libero de la obraId->'. $objOperadorAsignado->obraId ) ;
                //                 $vctDebug[] = 'Se actualiza el registro de EnObra->obraId->' . $strObraAnterior . ' a obraId->' .  $request[ 'obraId' ]  . ', y se asigna al operadorId->'.$request[ 'personalId' ][ $i ]. ' que se libero de la obraId->'. $objOperadorAsignado->obraId ;
                //                 $vctDebug[] = $objEnObra;

                //             } else {
                //                 $vctDebug[] = 'El operadorId->'. $request[ 'personalId' ][ $i ]. ' No esta registrado...' ;
                //                 $objEnObra->obraId  =  $request[ 'obraId' ] ;
                //                 $objEnObra->personalId  = $request[ 'personalId' ][ $i ];
                //                 $objEnObra->inicio  = $request[ 'inicio' ][ $i ];
                //                 $objEnObra->fin  = $request[ 'fin' ][ $i ];
                //                 $objEnObra->combustible  = $request[ 'combustible' ][ $i ];
                //                 $objEnObra->save();

                //                 $objHistorico->registraHistorico( $objEnObra, 'OBRAS: la maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' ya estaban en un registro existente obraId->'.$strObraAnterior.', por lo que solo se cambio a la nueva obraId->' .  $request[ 'obraId' ]  . ' y se asigno al operadorId->'.$request[ 'personalId' ][ $i ] ) ;
                //                 $vctDebug[] = 'Se actualiza el registro de EnObra->obraId->' . $strObraAnterior . ' a obraId->' .  $request[ 'obraId' ]  . ', y se asigna al operadorId->'.$request[ 'personalId' ][ $i ];
                //                 $vctDebug[] = $objEnObra;
                //             }
                //         }

                //     } else {
                //         $vctDebug[] = 'Validamos si la maquinariaId->' .  $request[ 'maquinariaId' ][ $i ] . ' ya esta registrada...';
                //         $objEnObra = obraMaqPer::where( 'maquinariaId', $request[ 'maquinariaId' ][ $i ] )->first();

                //         if ( $objEnObra ) {

                //             $vctDebug[] = 'La maquinariaId->'. $request[ 'maquinariaId' ][ $i ].' esta en el registro obraId->' . $objEnObra->id;

                //             if ( $objEnObra ) {

                //                 //*** preguntamos si se trata de la misma obra */
                //                 $vctDebug[] = 'Validamos si se trata de la misma maquina: maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' == enObra->maquinariaId->'. $objEnObra->maquinariaId ;

                //                 if ( $objEnObra->maquinariaId ==  $request[ 'maquinariaId' ][ $i ] ) {

                //                     //*** preguntamos si se trata del mismo operador */
                //                     $vctDebug[] = 'Validamos si se trata del misma operador: operadorId->'. $request[ 'personalId' ][ $i ] . ' == enObra->operadorId->'. $objEnObra->personalId ;
                //                     $strObraAnterior = $objEnObra->obraId;
                //                     if ( $objEnObra->personalId ==  $request[ 'personalId' ][ $i ] ) {
                //                         //*** es el mismo operador */
                //                         $vctDebug[] = 'Se trata del mismo operador: EnObra->operadorId->'. $objEnObra->obraId .' != operadorId-> '. $request[ 'personalId' ][ $i ];
                //                         //*** asignamos al registro la nueva obra */
                //                         $vctDebug[] = 'Se actualiza el registro de EnObra->obraId->' . $strObraAnterior . ' a obraId->' . $request[ 'obraId' ] . ', la información de maquinaria y operador continua igual';
                //                         $objEnObra->obraId = $request[ 'obraId' ];
                //                         $objEnObra->inicio  = $request[ 'inicio' ][ $i ];
                //                         $objEnObra->fin  = $request[ 'fin' ][ $i ];
                //                         $objEnObra->combustible  = $request[ 'combustible' ][ $i ];
                //                         // $objEnObra->save();

                //                         // $objHistorico->registraHistorico( $objEnObra, 'OBRAS: la maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' y el operadorId->'. $request[ 'personalId' ][ $i ] . ',  ya estaban en un registro existente obraId->'.$strObraAnterior.', por lo que solo se cambio a la nueva obraId->' . $request[ 'obraId' ] ) ;
                //                         $vctDebug[] = $objEnObra;

                //                     } else {
                //                         //*** es otro operador */
                //                         $vctDebug[] = 'Se trata de otro operador: EnObra->operadorId->'. $objEnObra->obraId .' != operadorId-> '. $request[ 'personalId' ][ $i ];
                //                         $objOperadorAsignado = obraMaqPer::where( 'personalId', $request[ 'personalId' ][ $i ] )->first();

                //                         $vctDebug[] = 'Validamos si el operadorId->'. $request[ 'personalId' ][ $i ]. ' esta en otro registro...';

                //                         if ( $objOperadorAsignado ) {

                //                             $vctDebug[] = 'El operadorId->'. $request[ 'personalId' ][ $i ] .' esta en el registro de obraId->' . $objOperadorAsignado->obraId;

                //                             $vctDebug[] = 'El operadorId->'. $request[ 'personalId' ][ $i ] .' se libera del registro : ' . $objOperadorAsignado->obraId;
                //                             $objOperadorAsignado->personalId = null;
                //                             $objOperadorAsignado->save();
                //                             $objHistorico->registraHistorico( $objOperadorAsignado, 'OBRAS: se libera el EnObra->operadorId->'. $request[ 'personalId' ][ $i ] .' de la obraId->'. $strObraAnterior .' por cambio a la obraId->' . $request[ 'obraId' ] ) ;
                //                             $vctDebug[] = 'El operadorId->'.$request[ 'personalId' ][ $i ] .' se libera de la obraId->' . $objOperadorAsignado->obraId;

                //                             $objEnObra->obraId  = $request[ 'obraId' ];
                //                             $objEnObra->personalId  = $request[ 'personalId' ][ $i ];
                //                             $objEnObra->inicio  = $request[ 'inicio' ][ $i ];
                //                             $objEnObra->fin  = $request[ 'fin' ][ $i ];
                //                             $objEnObra->combustible  = $request[ 'combustible' ][ $i ];
                //                             // $objEnObra->save();

                //                             // $objHistorico->registraHistorico( $objEnObra, 'OBRAS: la maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' ya estaban en un registro existente obraId->'.$strObraAnterior.', por lo que solo se cambio a la nueva obraId->' . $request[ 'obraId' ] . ' y se asigno al operadorId->'.$request[ 'personalId' ][ $i ] . ' que se libero de la obraId->'. $objOperadorAsignado->obraId ) ;
                //                             $vctDebug[] = 'Se actualiza el registro de EnObra->obraId->' . $strObraAnterior . ' a obraId->' . $request[ 'obraId' ] . ', y se asigna al operadorId->'.$request[ 'personalId' ][ $i ]. ' que se libero de la obraId->'. $objOperadorAsignado->obraId ;
                //                             $vctDebug[] = $objEnObra;

                //                         } else {
                //                             $vctDebug[] = 'El operadorId->'. $request[ 'personalId' ][ $i ]. ' No esta registrado...' ;
                //                             $objEnObra->obraId  = $request[ 'obraId' ];
                //                             $objEnObra->personalId  = $request[ 'personalId' ][ $i ];
                //                             $objEnObra->inicio  = $request[ 'inicio' ][ $i ];
                //                             $objEnObra->fin  = $request[ 'fin' ][ $i ];
                //                             $objEnObra->combustible  = $request[ 'combustible' ][ $i ];
                //                             // $objEnObra->save();

                //                             // $objHistorico->registraHistorico( $objEnObra, 'OBRAS: la maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' ya estaban en un registro existente obraId->'.$strObraAnterior.', por lo que solo se cambio a la nueva obraId->' . $request[ 'obraId' ] . ' y se asigno al operadorId->'.$request[ 'personalId' ][ $i ] ) ;
                //                             $vctDebug[] = 'Se actualiza el registro de EnObra->obraId->' . $strObraAnterior . ' a obraId->' . $request[ 'obraId' ] . ', y se asigna al operadorId->'.$request[ 'personalId' ][ $i ];
                //                             $vctDebug[] = $objEnObra;
                //                         }
                //                     }

                //                 } else {
                //                     //*** es otra maquinaria */
                //                     $vctDebug[] = '¿Que paso aqui?';
                //                     dd( $vctDebug );

                //                 }

                //             } else {

                //                 $vctDebug[] = 'No existe registro';

                //             }

                //         } else {

                //             $vctDebug[] = 'La maquinariaId->' .  $request[ 'maquinariaId' ][ $i ] . ' No esta registrada...';

                //             $vctDebug[] = 'Validamos si el operadorId->'.  $request[ 'personalId' ][ $i ] .' ya esta registrado en otra maquina de una obra...';
                //             $objOperadorAsignado = obraMaqPer::where( 'personalId', $request[ 'personalId' ][ $i ] )->first();

                //             if ( $objOperadorAsignado ) {
                //                 $vctDebug[] = 'El operadorId->'.  $request[ 'personalId' ][ $i ] .' existe en el registro de obraId->' . $objOperadorAsignado->id;

                //                 $objOperadorAsignado->personalId = null;
                //                 $objOperadorAsignado->save();
                //                 //*** registro de historico */
                //                 $objHistorico->registraHistorico(
                //                     $objOperadorAsignado,
                //                     'OBRAS: Se libera operadorId->'.  $request[ 'personalId' ][ $i ] .' de la obraId->' . $objOperadorAsignado->id . ', para ser asignado a la obraId-> ' . $request[ 'obraId' ]
                //                 ) ;

                //                 $vctDebug[] = 'El operadorId->'.  $request[ 'personalId' ][ $i ] .' se libera del registro de obraId->' . $objOperadorAsignado->id;

                //             } else {
                //                 $vctDebug[] = 'El operador No esta registrado...' ;
                //             }

                //             $objMaq = new obraMaqPer();
                //             $objMaq->obraId  = $request[ 'obraId' ];
                //             $objMaq->maquinariaId = $request[ 'maquinariaId' ][ $i ];
                //             $objMaq->personalId  = $request[ 'personalId' ][ $i ];
                //             $objMaq->inicio  = $request[ 'inicio' ][ $i ];
                //             $objMaq->fin  = $request[ 'fin' ][ $i ];
                //             $objMaq->combustible  = $request[ 'combustible' ][ $i ];
                //             $objMaq->save();

                //             $objHistorico->registraHistorico(
                //                 $objMaq, 'OBRAS: Nueva Obra, obraId->'. $request[ 'obraId' ] .
                //                 ',  maquinariaId->' . $request[ 'maquinariaId' ][ $i ] .
                //                 ', operadorId->'.$request[ 'personalId' ][ $i ]
                //             ) ;

                //             $vctDebug[] = 'Registramos el equipo: ' . $request[ 'maquinariaId' ][ $i ] .' en la obraId->' . $request[ 'obraId' ];
                //             $vctDebug[] = 'Registramos el operador: ' . $request[ 'personalId' ][ $i ] . ' en la obraId-> ' . $request[ 'obraId' ];
                //             $vctDebug[] = $objMaq;
                //         }

                //     }

                //     // }

                //     // } else {

                //     //     $vctDebug[] = 'La maquinariaId->' .  $request[ 'maquinariaId' ][ $i ] . ' No esta registrada...';

                //     //     $vctDebug[] = 'Validamos si el operadorId->'.  $request[ 'personalId' ][ $i ] .' ya esta registrado en otra maquina de una obra...';
                //     //     $objOperadorAsignado = obraMaqPer::where( 'personalId', $request[ 'personalId' ][ $i ] )->first();

                //     //     if ( $objOperadorAsignado ) {
                //     //         $vctDebug[] = 'El operadorId->'.  $request[ 'personalId' ][ $i ] .' existe en el registro de obraId->' . $objOperadorAsignado->id;

                //     //         $objOperadorAsignado->personalId = null;
                //     //         $objOperadorAsignado->save();
                //     //         //*** registro de historico */
                //     //         $objHistorico->registraHistorico(
                //     //             $objOperadorAsignado,
                //     //             'OBRAS: Se libera operadorId->'.  $request[ 'personalId' ][ $i ] .' de la obraId->' . $objOperadorAsignado->id . ', para ser asignado a la obraId-> ' . $obraId
                //     // ) ;

                //     //         $vctDebug[] = 'El operadorId->'.  $request[ 'personalId' ][ $i ] .' se libera del registro de obraId->' . $objOperadorAsignado->id;

                //     //     } else {
                //     //         $vctDebug[] = 'El operador No esta registrado...' ;
                //     //     }

                //     //     $objMaq = new obraMaqPer();
                //     //     $objMaq->obraId  = $obraId;
                //     //     $objMaq->maquinariaId = $request[ 'maquinariaId' ][ $i ];
                //     //     $objMaq->personalId  = $request[ 'personalId' ][ $i ];
                //     //     $objMaq->inicio  = $request[ 'inicio' ][ $i ];
                //     //     $objMaq->fin  = $request[ 'fin' ][ $i ];
                //     //     $objMaq->combustible  = $request[ 'combustible' ][ $i ];
                //     //     $objMaq->save();

                //     //     $objHistorico->registraHistorico(
                //     //         $objMaq, 'OBRAS: Nueva Obra, obraId->'.$obraId .
                //     //         ',  maquinariaId->' . $request[ 'maquinariaId' ][ $i ] .
                //     //         ', operadorId->'.$request[ 'personalId' ][ $i ]
                //     // ) ;

                //     //     $vctDebug[] = 'Registramos el equipo: ' . $request[ 'maquinariaId' ][ $i ] .' en nueva Obra: ' . $objMaq->obraId;
                //     //     $vctDebug[] = 'Registramos el operador: ' . $request[ 'personalId' ][ $i ] . ' en Nueva Obra: ' . $objMaq->obraId;
                //     //     $vctDebug[] = $objMaq;
                //     // }

                // } else {
                //     //*** no existe un registro de movimiento de maquinaria */
                //     //*** preguntamos si la maquina ya esta asignada */

                //     $vctDebug[] = 'Validamos si la maquinariaId->' .  $request[ 'maquinariaId' ][ $i ] . ' ya esta registrada...';
                //     $objEnObra = obraMaqPer::where( 'maquinariaId', $request[ 'maquinariaId' ][ $i ] )->first();

                //     if ( $objEnObra ) {

                //         $vctDebug[] = 'La maquinariaId->'. $request[ 'maquinariaId' ][ $i ].' esta en el registro obraId->' . $objEnObra->id;

                //         if ( $objEnObra ) {

                //             //*** preguntamos si se trata de la misma obra */
                //             $vctDebug[] = 'Validamos si se trata de la misma maquina: maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' == enObra->maquinariaId->'. $objEnObra->maquinariaId ;

                //             if ( $objEnObra->maquinariaId ==  $request[ 'maquinariaId' ][ $i ] ) {

                //                 //*** preguntamos si se trata del mismo operador */
                //                 $vctDebug[] = 'Validamos si se trata del misma operador: operadorId->'. $request[ 'personalId' ][ $i ] . ' == enObra->operadorId->'. $objEnObra->personalId ;
                //                 $strObraAnterior = $objEnObra->obraId;
                //                 if ( $objEnObra->personalId ==  $request[ 'personalId' ][ $i ] ) {
                //                     //*** es el mismo operador */
                //                     $vctDebug[] = 'Se trata del mismo operador: EnObra->operadorId->'. $objEnObra->obraId .' != operadorId-> '. $request[ 'personalId' ][ $i ];
                //                     //*** asignamos al registro la nueva obra */
                //                     $vctDebug[] = 'Se actualiza el registro de EnObra->obraId->' . $strObraAnterior . ' a obraId->' . $request[ 'obraId' ] . ', la información de maquinaria y operador continua igual';
                //                     $objEnObra->obraId = $request[ 'obraId' ];
                //                     $objEnObra->inicio  = $request[ 'inicio' ][ $i ];
                //                     $objEnObra->fin  = $request[ 'fin' ][ $i ];
                //                     $objEnObra->combustible  = $request[ 'combustible' ][ $i ];
                //                     // $objEnObra->save();

                //                     // $objHistorico->registraHistorico( $objEnObra, 'OBRAS: la maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' y el operadorId->'. $request[ 'personalId' ][ $i ] . ',  ya estaban en un registro existente obraId->'.$strObraAnterior.', por lo que solo se cambio a la nueva obraId->' . $request[ 'obraId' ] ) ;
                //                     $vctDebug[] = $objEnObra;

                //                 } else {
                //                     //*** es otro operador */
                //                     $vctDebug[] = 'Se trata de otro operador: EnObra->operadorId->'. $objEnObra->obraId .' != operadorId-> '. $request[ 'personalId' ][ $i ];
                //                     $objOperadorAsignado = obraMaqPer::where( 'personalId', $request[ 'personalId' ][ $i ] )->first();

                //                     $vctDebug[] = 'Validamos si el operadorId->'. $request[ 'personalId' ][ $i ]. ' esta en otro registro...';

                //                     if ( $objOperadorAsignado ) {

                //                         $vctDebug[] = 'El operadorId->'. $request[ 'personalId' ][ $i ] .' esta en el registro de obraId->' . $objOperadorAsignado->obraId;

                //                         $vctDebug[] = 'El operadorId->'. $request[ 'personalId' ][ $i ] .' se libera del registro : ' . $objOperadorAsignado->obraId;
                //                         $objOperadorAsignado->personalId = null;
                //                         $objOperadorAsignado->save();
                //                         $objHistorico->registraHistorico( $objOperadorAsignado, 'OBRAS: se libera el EnObra->operadorId->'. $request[ 'personalId' ][ $i ] .' de la obraId->'. $strObraAnterior .' por cambio a la obraId->' . $request[ 'obraId' ] ) ;
                //                         $vctDebug[] = 'El operadorId->'.$request[ 'personalId' ][ $i ] .' se libera de la obraId->' . $objOperadorAsignado->obraId;

                //                         $objEnObra->obraId  = $request[ 'obraId' ];
                //                         $objEnObra->personalId  = $request[ 'personalId' ][ $i ];
                //                         $objEnObra->inicio  = $request[ 'inicio' ][ $i ];
                //                         $objEnObra->fin  = $request[ 'fin' ][ $i ];
                //                         $objEnObra->combustible  = $request[ 'combustible' ][ $i ];
                //                         // $objEnObra->save();

                //                         // $objHistorico->registraHistorico( $objEnObra, 'OBRAS: la maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' ya estaban en un registro existente obraId->'.$strObraAnterior.', por lo que solo se cambio a la nueva obraId->' . $request[ 'obraId' ] . ' y se asigno al operadorId->'.$request[ 'personalId' ][ $i ] . ' que se libero de la obraId->'. $objOperadorAsignado->obraId ) ;
                //                         $vctDebug[] = 'Se actualiza el registro de EnObra->obraId->' . $strObraAnterior . ' a obraId->' . $request[ 'obraId' ] . ', y se asigna al operadorId->'.$request[ 'personalId' ][ $i ]. ' que se libero de la obraId->'. $objOperadorAsignado->obraId ;
                //                         $vctDebug[] = $objEnObra;

                //                     } else {
                //                         $vctDebug[] = 'El operadorId->'. $request[ 'personalId' ][ $i ]. ' No esta registrado...' ;
                //                         $objEnObra->obraId  = $request[ 'obraId' ];
                //                         $objEnObra->personalId  = $request[ 'personalId' ][ $i ];
                //                         $objEnObra->inicio  = $request[ 'inicio' ][ $i ];
                //                         $objEnObra->fin  = $request[ 'fin' ][ $i ];
                //                         $objEnObra->combustible  = $request[ 'combustible' ][ $i ];
                //                         // $objEnObra->save();

                //                         // $objHistorico->registraHistorico( $objEnObra, 'OBRAS: la maquinariaId->'. $request[ 'maquinariaId' ][ $i ] . ' ya estaban en un registro existente obraId->'.$strObraAnterior.', por lo que solo se cambio a la nueva obraId->' . $request[ 'obraId' ] . ' y se asigno al operadorId->'.$request[ 'personalId' ][ $i ] ) ;
                //                         $vctDebug[] = 'Se actualiza el registro de EnObra->obraId->' . $strObraAnterior . ' a obraId->' . $request[ 'obraId' ] . ', y se asigna al operadorId->'.$request[ 'personalId' ][ $i ];
                //                         $vctDebug[] = $objEnObra;
                //                     }
                //                 }

                //             } else {
                //                 //*** es otra maquinaria */
                //                 $vctDebug[] = '¿Que paso aqui?';
                //                 dd( $vctDebug );

                //             }

                //         } else {

                //             $vctDebug[] = 'No existe registro';

                //         }

                //     } else {

                //         $vctDebug[] = 'La maquinariaId->' .  $request[ 'maquinariaId' ][ $i ] . ' No esta registrada...';

                //         $vctDebug[] = 'Validamos si el operadorId->'.  $request[ 'personalId' ][ $i ] .' ya esta registrado en otra maquina de una obra...';
                //         $objOperadorAsignado = obraMaqPer::where( 'personalId', $request[ 'personalId' ][ $i ] )->first();

                //         if ( $objOperadorAsignado ) {
                //             $vctDebug[] = 'El operadorId->'.  $request[ 'personalId' ][ $i ] .' existe en el registro de obraId->' . $objOperadorAsignado->id;

                //             $objOperadorAsignado->personalId = null;
                //             $objOperadorAsignado->save();
                //             //*** registro de historico */
                //             $objHistorico->registraHistorico(
                //                 $objOperadorAsignado,
                //                 'OBRAS: Se libera operadorId->'.  $request[ 'personalId' ][ $i ] .' de la obraId->' . $objOperadorAsignado->id . ', para ser asignado a la obraId-> ' . $request[ 'obraId' ]
                //             ) ;

                //             $vctDebug[] = 'El operadorId->'.  $request[ 'personalId' ][ $i ] .' se libera del registro de obraId->' . $objOperadorAsignado->id;

                //         } else {
                //             $vctDebug[] = 'El operador No esta registrado...' ;
                //         }

                //         $objMaq = new obraMaqPer();
                //         $objMaq->obraId  = $request[ 'obraId' ];
                //         $objMaq->maquinariaId = $request[ 'maquinariaId' ][ $i ];
                //         $objMaq->personalId  = $request[ 'personalId' ][ $i ];
                //         $objMaq->inicio  = $request[ 'inicio' ][ $i ];
                //         $objMaq->fin  = $request[ 'fin' ][ $i ];
                //         $objMaq->combustible  = $request[ 'combustible' ][ $i ];
                //         $objMaq->save();

                //         $objHistorico->registraHistorico(
                //             $objMaq, 'OBRAS: Nueva Obra, obraId->'. $request[ 'obraId' ] .
                //             ',  maquinariaId->' . $request[ 'maquinariaId' ][ $i ] .
                //             ', operadorId->'.$request[ 'personalId' ][ $i ]
                //         ) ;

                //         $vctDebug[] = 'Registramos el equipo: ' . $request[ 'maquinariaId' ][ $i ] .' en la obraId->' . $request[ 'obraId' ];
                //         $vctDebug[] = 'Registramos el operador: ' . $request[ 'personalId' ][ $i ] . ' en la obraId-> ' . $request[ 'obraId' ];
                //         $vctDebug[] = $objMaq;
                //     }

                // }
            }
        } else {
            //*** se deben de eliminar todos los registrados */
            if ( is_array( $vctRegistrados ) && count( $vctRegistrados ) > 0 ) {
                for (
                    $i = 0; $i < count( $vctRegistrados );
                    $i++
                ) {

                    $objResult = $objAsigna->eliminarReferenciaDeOperador( $vctRegistrados[ $i ] ) ;

                    // // obraMaqPer::destroy( $vctRegistrados[ $i ].$vctRegistrados[ $i ] );
                    // $objMaq = obraMaqPer::where( 'id', '=', $vctRegistrados[ $i ] )->first();
                    // $vctDebug[] = 'Buscamos el registro->' . $vctRegistrados[ $i ];

                    // if ( $objMaq ) {
                    //     $strOperador = $objMaq->personalId;
                    //     $objMaq->obraId = 1;
                    //     $objMaq->personalId = null;
                    //     $objMaq->combustible = 0;
                    //     $objMaq->inicio = null;
                    //     $objMaq->fin = null;
                    //     $objMaq->save();

                    //     $vctDebug[] = 'Se reasigna la maquinaria->'. $objMaq->maquinariaId.' al centro de control que es la obraId->1, y se libera al OperadorId->'. $strOperador  ;
                    //     $objHistorico->registraHistorico( $objMaq, 'OBRAS: Se reasigna la maquinaria->'. $objMaq->maquinariaId.' al centro de control que es la obraId->1, y se libera al OperadorId->'. $strOperador ) ;

                    // }
                }
            }
        }

        // dd( $vctDebug, $request );

        Session::flash( 'message', 1 );

        return redirect()->route( 'obras.index' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\obras  $obras
    * @return \Illuminate\Http\Response
    */

    public function destroy( obras $obras ) {
        // dd( 'test' );
        abort_if ( Gate::denies( 'obra_destroy' ), 403 );
        return redirect()->back()->with( 'failed', 'No se puede eliminar' );
    }
}
