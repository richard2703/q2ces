<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\comprobante;
use App\Models\conceptos;
use App\Models\eventosCalendarioTipos;
use App\Models\frecuenciaEjecucion;
use App\Models\manoDeObra;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\puesto;
use App\Models\puestoNivel;
use App\Models\tareaCategoria;
use App\Models\tareaTipo;
use App\Models\tareaUbicacion;
use App\Models\tipoUniforme;
use App\Models\marca;
use App\Models\proveedor;
use App\Models\proveedorCategoria;
use App\Models\refaccionTipo;
use App\Models\refacciones;
use App\Models\maquinaria;
use App\Models\maquinariaCategoria;
use App\Models\maquinariaTipo;
use App\Models\marcasTipo;
use App\Models\tipoEquipo;
use App\Models\tipoHoraExtra;
use App\Models\tipoMantenimiento;
use App\Models\tiposMarcas;
use App\Models\tiposUnidades;
use App\Models\tipoValorTarea;
use App\Models\unidadesSat;
use Illuminate\Support\Arr;

class catalogosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        abort_if(Gate::denies('catalogos_index'), 403);
        return view('catalogos.dashCatalogos');
    }

    public function indexPuestos()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = puesto::select('puesto.*', 'puestoNivel.nombre as puestoNivel')
            ->leftJoin('puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId')
            ->orderBy('nombre', 'asc')->paginate(10);

        $vctNiveles = puestoNivel::orderBy('nombre', 'asc')->get();
        // dd( $records );
        return view('catalogos.puestos', compact('records', 'vctNiveles'));
    }

    public function indexPuestosNivel()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = puestoNivel::orderBy('nombre', 'asc')->paginate(10);
        return view('catalogos.puestosNivel', compact('records'));
    }

    public function indexCatalogoCategoriasTareas()
    {
        abort_if(Gate::denies('tarea_index'), 403);

        $records = tareaCategoria::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.tareaCategorias', compact('records'));
    }

    public function indexCatalogoCategoriasMaquinaria()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = maquinariaCategoria::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.maquinariaCategorias', compact('records'));
    }

    public function indexCatalogoTiposMaquinaria()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = maquinariaTipo::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.maquinariaTipos', compact('records'));
    }

    public function indexCatalogoTiposTareas()
    {
        abort_if(Gate::denies('tarea_index'), 403);

        $records = tareaTipo::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.tareaTipos', compact('records'));
    }

    public function indexCatalogoTiposValorTarea()
    {
        abort_if(Gate::denies('tarea_index'), 403);

        $records = tipoValorTarea::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.tareaTiposValor', compact('records'));
    }

    public function indexCatalogoFrecuenciaEjecucion()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = frecuenciaEjecucion::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.frecuenciaEjecucion', compact('records'));
    }

    public function indexCatalogoUbicacionesTareas()
    {
        abort_if(Gate::denies('tarea_index'), 403);

        $records = tareaUbicacion::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.tareaUbicaciones', compact('records'));
    }

    public function indexCatalogoTipoUniforme()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = tipoUniforme::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.uniformeTipos', compact('records'));
    }

    public function indexCatalogoTipoHorasExtra()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = tipoHoraExtra::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.horasExtraTipos', compact('records'));
    }

    public function indexCatalogoTiposEquipo()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = tipoEquipo::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.equiposTipos', compact('records'));
    }

    public function indexCatalogoTiposMantenimiento()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = tipoMantenimiento::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.mantenimientoTipos', compact('records'));
    }

    public function indexCatalogoEventosCalendarioTipos()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = eventosCalendarioTipos::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.eventosCalendarioTipos', compact('records'));
    }

    public function indexCatalogoTipoRefaccion()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = refaccionTipo::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.refaccionTipos', compact('records'));
    }

    public function indexCatalogoRefacciones()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = refacciones::select('refacciones.*', 'marca.nombre as marca', 'maquinaria.nombre as maquinaria', 'refaccionTipo.nombre as tipo')
            ->leftJoin('marca', 'marca.id', '=', 'refacciones.marcaId')
            ->leftJoin('maquinaria', 'maquinaria.id', '=', 'refacciones.maquinariaId')
            ->leftJoin('refaccionTipo', 'refaccionTipo.id', '=', 'refacciones.tipoRefaccionId')
            ->orderBy('nombre', 'asc')->paginate(10);

        $vctMarcas = marca::orderBy('nombre', 'asc')->get();
        $vctMaquinaria = maquinaria::orderBy('nombre', 'asc')->get();
        $vctTipos = refaccionTipo::orderBy('nombre', 'asc')->get();
        // dd( $records );
        return view('catalogos.refacciones', compact('records', 'vctMarcas', 'vctMaquinaria', 'vctTipos'));
    }

    public function indexCatalogoMarca()
    {
        abort_if(Gate::denies('catalogos_index'), 403);
        // $records = marca::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        $records = marca::orderBy('nombre', 'asc')
            ->paginate(15);
        // $tiposMarcas = tiposMarcas::all()->pluck('nombre', 'id');
        $records->load('tiposMarcas');
        // dd($records);
        // for ($i = 0; $i < count($records); $i++) {
        //     $relacion = marcasTipo::where('marcasTipo.marcaId', '=', $records[$i]['id'])->get();
        //     dd($relacion);
        //     $records = Arr::flatten($relacion);
        // }
        //
        // dd($records);
        $tipos = marcasTipo::all();
        // dd($tipos);
        return view('catalogos.marcas', compact('records', 'tipos'));
    }

    public function indexCatalogoConceptos()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = conceptos::select('conceptos.*', 'unidadesSat.nombre as unidadesSat_nombre', 'unidadesSat.codigo as unidadesSat_codigo', 'tiposUnidades.nombre as tiposUnidades_nombre', 'tiposUnidades.codigo as tiposUnidades_codigo')
            ->leftJoin('unidadesSat', 'unidadesSat.id', 'conceptos.unidadesSatId')
            ->leftJoin('tiposUnidades', 'tiposUnidades.id', 'conceptos.tiposUnidadesId')
            ->orderBy('nombre', 'asc')->paginate(10);

        $vctUnidades = tiposUnidades::orderBy('nombre', 'asc')->get();
        $vctUnidadesSAT = unidadesSat::orderBy('nombre', 'asc')->get();
        // dd($records);
        return view('catalogos.conceptos', compact('records', 'vctUnidades', 'vctUnidadesSAT'));
    }

    public function indexCatalogoManoDeObra()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = manoDeObra::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.manoDeObra', compact('records'));
    }

    public function indexCatalogoComprobantes()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = comprobante::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.comprobantes', compact('records'));
    }

    public function indexCatalogoProveedorCategoria()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = proveedorCategoria::orderBy('nombre', 'asc')->paginate(10);
        // dd( $records );
        return view('catalogos.proveedorCategoria', compact('records'));
    }

    public function indexCatalogoProveedor()
    {
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = proveedor::select('proveedor.*', 'proveedorCategoria.nombre as categoria')
            ->leftJoin('proveedorCategoria', 'proveedorCategoria.id', '=', 'proveedor.categoriaId')
            ->orderBy('nombre', 'asc')->paginate(10);
        $vctCategorias = proveedorCategoria::orderBy('nombre', 'asc')->get();
        // dd( $records );
        return view('catalogos.proveedores', compact('records', 'vctCategorias'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
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
