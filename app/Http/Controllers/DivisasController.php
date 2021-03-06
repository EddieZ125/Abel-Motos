<?php

namespace App\Http\Controllers;

use App\Divisa;
use App\HistorialDivisa;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class DivisasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('divisas.index');
    }

    public function buscar() {
        return DataTables::of(Divisa::query())
                            ->addcolumn('tasa', function($data) {
                                return $data->ultima_divisa->tasa;
                            })->addColumn('editar', function($data) {
                                $ruta = route('divisas.edit',['divisa' => $data->id]);
                                return "<a class='btn btn-primary' href='$ruta'>Editar</a>";
                            })->rawColumns(['editar'])
                            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('divisas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $divisa = Divisa::create([
            'nombre' => $request->get('nombre'),
            'unidad' => $request->get('unidad')
        ]);
        $historial = HistorialDivisa::create([
            'divisa_id' => $divisa->id, 
            'fecha' => Carbon::now(),
            'tasa' => $request->get('tasa')
        ]);
        return redirect()->route('divisas.index');
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
    public function edit(Divisa $divisa)
    {
        $ultima_divisa = $divisa->ultima_divisa;
        return view('divisas.edit', [
            'ultima_divisa' => $ultima_divisa
        ]);
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
        $divisa = Divisa::findOrFail($id);
        $ultima_divisa = $divisa->ultima_divisa;
        $divisa->update([
            'nombre' => $request->get('nombre'),
            'unidad' => $request->get('unidad')
        ]);
        if (floatval($ultima_divisa->tasa) != floatval($request->get('tasa')))
            HistorialDivisa::create([
                'divisa_id' => $id, 
                'fecha' => Carbon::now(),
                'tasa' => $request->get('tasa')
            ]);
        return redirect()->route('divisas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Divisa::destroy($id);
        return redirect()->route('divisas.index');
    }
}
