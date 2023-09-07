<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\checkList;
use App\Models\bitacoras;
use App\Models\checkListRegistros;
use App\Models\grupoBitacoras;
use App\Models\grupoTareas;
use App\Models\grupo;
use App\Models\tarea;
use App\Models\maquinaria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class checkListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        abort_if(Gate::denies('checkList_index'), 403);

        $records = checkList::select(
            'checkList.*',
            DB::raw('maquinaria.nombre AS maquinaria'),
            DB::raw('users.username AS usuario'),
            DB::raw('bitacoras.nombre AS bitacora')
        )
            ->join('maquinaria', 'maquinaria.id', '=', 'checkList.maquinariaId')
            ->join('users', 'users.id', '=', 'checkList.usuarioId')
            ->leftJoin('bitacoras', 'bitacoras.id', '=', 'checkList.bitacoraId')
            ->orderBy('registrada', 'desc')->paginate(15);

        // dd( $records );
        return view('checkList.checkList', compact('records'));
    }

    /**
     * Show the form for seleccionar sobre que equipo se realizará un checklist.
     *
     * @return \Illuminate\Http\Response
     */

    public function seleccionar()
    {
        // dd( 'Hola' );
        abort_if(Gate::denies('checkList_index'), 403);

        $records = bitacoras::select(
            'bitacoras.*',
            DB::raw('maquinaria.nombre AS maquinaria'),
            DB::raw('maquinaria.id AS maquinariaId'),
            DB::raw('bitacoras.nombre AS bitacora'),
            DB::raw('bitacoras.id AS bitacoraId')
        )
            ->join('maquinaria', 'maquinaria.bitacoraId', '=', 'bitacoras.id')
            ->orderBy('bitacoras.nombre', 'desc')->paginate(15);

        return view('checkList.seleccionarChecklist', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($bitacoraId, $maquinariaId)
    {

        $maquinaria = maquinaria::select('maquinaria.*')->where('id', '=', $maquinariaId)->first();
        $bitacora = bitacoras::select('bitacoras.*')->where('id', '=', $bitacoraId)->first();
        //*** obtenemos las tareas */
        $vctTareas = grupo::select(
            DB::raw('tarea.id AS tareaId'),
            DB::raw('tarea.nombre AS tarea'),
            DB::raw('tarea.tipoValorId'),
            DB::raw('tipoValorTarea.nombre AS tipoValor'),
            DB::raw('grupo.nombre AS grupo'),
            'grupoBitacoras.*',
            'tipoValorTarea.*'
        )
            ->join('grupoBitacoras', 'grupoBitacoras.grupoId', '=', 'grupo.id')
            ->join('grupoTareas', 'grupoTareas.grupoId', '=', 'grupo.id')
            ->join('tarea', 'tarea.id', '=', 'grupoTareas.tareaId')
            ->join('tipoValorTarea', 'tipoValorTarea.id', '=', 'tarea.tipoValorId')
            ->where('grupoBitacoras.bitacoraId', '=', $bitacora->id)->get();

        // dd( $bitacora, $maquinaria,  $vctTareas );

        return view('checkList.nuevoCheckList', compact('maquinaria', 'bitacora', 'vctTareas'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        abort_if(Gate::denies('checkList_show'), 403);

        $checkList = checkList::select(
            'checkList.*',
            DB::raw('maquinaria.nombre AS maquinaria'),
            DB::raw('users.username AS usuario'),
            DB::raw('bitacoras.nombre AS bitacora')
        )
            ->join('maquinaria', 'maquinaria.id', '=', 'checkList.maquinariaId')
            ->join('users', 'users.id', '=', 'checkList.usuarioId')
            ->leftJoin('bitacoras', 'bitacoras.id', '=', 'checkList.bitacoraId')
            ->orderBy('registrada', 'desc')
            ->where('checkList.id', '=', $id)->first();

        $records = checkListRegistros::select(
            'checkListRegistros.*',
            DB::raw('maquinaria.nombre AS maquinaria'),
            DB::raw('users.username AS usuario'),
            DB::raw('bitacoras.nombre AS bitacora')
        )
            ->join('maquinaria', 'maquinaria.id', '=', 'checkListRegistros.maquinariaId')
            ->join('users', 'users.id', '=', 'checkListRegistros.usuarioId')
            ->leftJoin('bitacoras', 'bitacoras.id', '=', 'checkListRegistros.bitacoraId')
            ->orderBy('grupo', 'asc')
            ->where('checkListRegistros.checkListId', '=', $id)->get();

        // dd( $records );
        return view('checkList.detalleCheckList', compact('checkList', 'records'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
    }
}
