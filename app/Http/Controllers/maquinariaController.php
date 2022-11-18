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
        $request->validate([
            'nombre' => 'required|max:250',
            'marca' => 'required|max:250',
            'modelo' => 'required|max:250',
            'horometro' => 'nullable|numeric',
            'kilometraje' => 'nullable|numeric',
            'submarca' => 'nullable|max:200',
            'categoria' => 'nullable|max:200',
            'ano' => 'nullable|max:9999|numeric',
            'color' => 'nullable|max:200',
            'placas' => 'nullable|max:200',
            'motor' => 'nullable|max:200',
            'nummotor' => 'nullable|max:200',
            'numserie' => 'nullable|max:200',
            'vin' => 'nullable|max:200',
            'combustible' => 'nullable|max:200',
            'capacidad' => 'nullable|numeric',
            'tanque' => 'nullable|numeric',
            'ejes' => 'nullable|numeric',
            'rinD' => 'nullable|numeric',
            'rinT' => 'nullable|numeric',
            'llantaD' => 'nullable|numeric',
            'llantaT' => 'nullable|numeric',
            'aceitemotor' => 'nullable|numeric',
            'aceitetras' => 'nullable|numeric',
            'aceitehidra' => 'nullable|numeric',
            'aceitedirec' => 'nullable|numeric',
            'filtroaceite' => 'nullable|numeric',
            'filtroaire' => 'nullable|numeric',
            'bujias' => 'nullable|numeric',
            'tipobujia' => 'nullable|max:200',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'marca.required' => 'El campo marca es obligatorio.',
            'marca.max' => 'El campo marca excede el límite de caracteres permitidos.',
            'modelo.required' => 'El campo modelo es obligatorio.',
            'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
            'horometro.numeric' => 'El campo horómetro debe de ser numérico.',
            'kilometraje.numeric' => 'El campo kilometraje debe de ser numérico.',
            'submarca.max' => 'El campo submarca excede el límite de caracteres permitidos.',
            'categoria.max' => 'El campo categoria excede el límite de caracteres permitidos.',
            'ano.numeric' => 'El campo año debe ser numérico.',
            'ano.max' => 'El campo serie excede el límite de caracteres permitidos.',
            'color.max' => 'El campo color excede el límite de caracteres permitidos.',
            'placas.max' => 'El campo placas excede el límite de caracteres permitidos.',
            'motor.max' => 'El campo motor excede el límite de caracteres permitidos.',
            'nummotor.max' => 'El número de motor placas excede el límite de caracteres permitidos.',
            'numserie.max' => 'El número de serie placas excede el límite de caracteres permitidos.',
            'vin.max' => 'El campo VIN excede el límite de caracteres permitidos.',
            'combustible.max' => 'El campo combustible excede el límite de caracteres permitidos.',
            'capacidad.numeric' => 'El campo capacidad debe ser numérico.',
            'tanque.numeric' => 'El campo tanque debe ser numérico.',
            'ejes.numeric' => 'El campo ejes debe ser numérico.',
            'rinD.numeric' => 'El campo rin delatero debe ser numérico.',
            'rinT.numeric' => 'El campo rin trasero debe ser numérico.',
            'llantaD.numeric' => 'El campo llanta delantera debe ser numérico.',
            'llantaT.numeric' => 'El campo llanta trasera debe ser numérico.',
            'aceitemotor.numeric' => 'El campo aceite de motor debe ser numérico.',
            'aceitetras.numeric' => 'El campo aceite de transmisión debe ser numérico.',
            'aceitehidra.numeric' => 'El campo aceite hidráulico debe ser numérico.',
            'aceitedirec.numeric' => 'El campo aceite de dirección debe ser numérico.',
            'filtroaceite.numeric' => 'El campo filtro de aceite debe ser numérico.',
            'filtroaire.numeric' => 'El campo filtro de aire debe ser numérico.',
            'bujias.numeric' => 'El campo bujias trasera debe ser numérico.',
            'tipobujia.max' => 'El campo tipo de bujía excede el límite de caracteres permitidos.',
        ]);


        $maquinaria = $request->all();

        $maquinaria['placas'] = strtoupper($maquinaria['placas']);
        $maquinaria['nummotor'] = strtoupper($maquinaria['nummotor']);
        $maquinaria['numserie'] = strtoupper($maquinaria['numserie']);

        //  dd($request);
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
        if ($request->hasFile("especial")) {
            $docs['especial'] = time() . '_' . $request->file('especial')->getClientOriginalName();
            $request->file('registro')->storeAs('/public/docmaquinaria', $docs['especial']);
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
        $docs = maqdocs::where("maquinariaId", $maquinaria->id)->first();
        return view('maquinaria.detalleMaquinaria', compact('maquinaria', 'docs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function edit(maquinaria $maquinaria)
    {
        dd($maquinaria);
        // $docs = maqdocs::where("maquinariaId", $maquinaria->id)->first();
        // return view('maquinaria.detalleMaquinaria', compact('maquinaria', 'docs'));
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
        $request->validate([
            'nombre' => 'required|max:250',
            'marca' => 'required|max:250',
            'modelo' => 'required|max:250',
            'horometro' => 'nullable|numeric',
            'kilometraje' => 'nullable|numeric',
            'submarca' => 'nullable|max:200',
            'categoria' => 'nullable|max:200',
            'ano' => 'nullable|max:9999|numeric',
            'color' => 'nullable|max:200',
            'placas' => 'nullable|max:200',
            'motor' => 'nullable|max:200',
            'nummotor' => 'nullable|max:200',
            'numserie' => 'nullable|max:200',
            'vin' => 'nullable|max:200',
            'combustible' => 'nullable|max:200',
            'capacidad' => 'nullable|numeric',
            'tanque' => 'nullable|numeric',
            'ejes' => 'nullable|numeric',
            'rinD' => 'nullable|numeric',
            'rinT' => 'nullable|numeric',
            'llantaD' => 'nullable|numeric',
            'llantaT' => 'nullable|numeric',
            'aceitemotor' => 'nullable|numeric',
            'aceitetras' => 'nullable|numeric',
            'aceitehidra' => 'nullable|numeric',
            'aceitedirec' => 'nullable|numeric',
            'filtroaceite' => 'nullable|numeric',
            'filtroaire' => 'nullable|numeric',
            'bujias' => 'nullable|numeric',
            'tipobujia' => 'nullable|max:200',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'marca.required' => 'El campo marca es obligatorio.',
            'marca.max' => 'El campo marca excede el límite de caracteres permitidos.',
            'modelo.required' => 'El campo modelo es obligatorio.',
            'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
            'horometro.numeric' => 'El campo horómetro debe de ser numérico.',
            'kilometraje.numeric' => 'El campo kilometraje debe de ser numérico.',
            'submarca.max' => 'El campo submarca excede el límite de caracteres permitidos.',
            'categoria.max' => 'El campo categoria excede el límite de caracteres permitidos.',
            'ano.numeric' => 'El campo año debe ser numérico.',
            'ano.max' => 'El campo serie excede el límite de caracteres permitidos.',
            'color.max' => 'El campo color excede el límite de caracteres permitidos.',
            'placas.max' => 'El campo placas excede el límite de caracteres permitidos.',
            'motor.max' => 'El campo motor excede el límite de caracteres permitidos.',
            'nummotor.max' => 'El número de motor placas excede el límite de caracteres permitidos.',
            'numserie.max' => 'El número de serie placas excede el límite de caracteres permitidos.',
            'vin.max' => 'El campo VIN excede el límite de caracteres permitidos.',
            'combustible.max' => 'El campo combustible excede el límite de caracteres permitidos.',
            'capacidad.numeric' => 'El campo capacidad debe ser numérico.',
            'tanque.numeric' => 'El campo tanque debe ser numérico.',
            'ejes.numeric' => 'El campo ejes debe ser numérico.',
            'rinD.numeric' => 'El campo rin delatero debe ser numérico.',
            'rinT.numeric' => 'El campo rin trasero debe ser numérico.',
            'llantaD.numeric' => 'El campo llanta delantera debe ser numérico.',
            'llantaT.numeric' => 'El campo llanta trasera debe ser numérico.',
            'aceitemotor.numeric' => 'El campo aceite de motor debe ser numérico.',
            'aceitetras.numeric' => 'El campo aceite de transmisión debe ser numérico.',
            'aceitehidra.numeric' => 'El campo aceite hidráulico debe ser numérico.',
            'aceitedirec.numeric' => 'El campo aceite de dirección debe ser numérico.',
            'filtroaceite.numeric' => 'El campo filtro de aceite debe ser numérico.',
            'filtroaire.numeric' => 'El campo filtro de aire debe ser numérico.',
            'bujias.numeric' => 'El campo bujias trasera debe ser numérico.',
            'tipobujia.max' => 'El campo tipo de bujía excede el límite de caracteres permitidos.',
        ]);

        $data = $request->all();

        $data['placas'] = strtoupper($data['placas']);
        $data['nummotor'] = strtoupper($data['nummotor']);
        $data['numserie'] = strtoupper($data['numserie']);

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
        if ($request->hasFile("especial")) {
            $docs['especial'] = time() . '_' . $request->file('especial')->getClientOriginalName();
            $request->file('especial')->storeAs('/public/docmaquinaria', $docs['especial']);
        }
        $docu = maqdocs::where("maquinariaId", $maquinaria->id);
        if (isset($docs)) {
            $docu->update($docs);
            # code...
        }
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
        return redirect()->back()->with('failed', 'No se puede eliminar');
    }

    public function download($id, $doc)
    {
        $book = maqdocs::where('id', $id)->firstOrFail();

        if (empty($book) === false) {
            $pathToFile = storage_path("app/public/docmaquinaria/" . $book->$doc);
            if (file_exists($pathToFile) === true &&  is_file($pathToFile) === true) {
                // return response()->download($pathToFile);
                return response()->file($pathToFile);
            } else {
                return redirect('404');
            }
        }
    }
}
