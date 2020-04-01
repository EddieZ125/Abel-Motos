<?php

namespace App\Http\Controllers;

use App\Divisa;
use App\Cliente;
use App\Factura;
use App\Producto;
use Carbon\Carbon;
use App\FacturaProducto;
use App\HistorialDivisa;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('facturas.index');
    }

    public function buscar() {
        return DataTables::of(Factura::query())
            ->addColumn('cliente', function($data) {
                return $data->cliente->nombre;
            })->addColumn('divisa', function($data) {
                return $data->factura_producto->ultima_divisa->divisa->nombre;
            })->addColumn('tasa', function($data) {
                return $data->factura_producto->ultima_divisa->tasa;
            })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::where('cantidad', '>', 0)->get();
        $divisas = Divisa::all();
        
        return view('facturas.create', [
            'productos' => $productos,
            'divisas' => $divisas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = Cliente::where('id', $request->get('cliente_id'))->first();
        $ultima_divisa = HistorialDivisa::where('id', $request->get('historial_divisa_id'))->first();
        $fecha = Carbon::now();
        $tasa = floatval($ultima_divisa->tasa);
        $total = 0;
                
        foreach ($request->productos as $producto)
            $total = $total + intval($producto['cantidad']) * floatval($producto['precio']);
        $total = $total * $tasa;

        $factura = Factura::create([
            'cliente_id' => $cliente->id,
            'total' => $total,
            'fecha' => $fecha
        ]);

        foreach ($request->productos as $producto) {
            $item = Producto::where('id', $producto['id'])->first();
            FacturaProducto::create([
                'factura_id' => $factura->id,
                'producto_id' => $item->id,
                'historial_divisa_id' => $ultima_divisa->id,
                'cantidad' => intval($producto['cantidad']),
                'precio' => floatval($item['precio'])
            ]);
            $item->cantidad = intval($item->cantidad) - intval($producto['cantidad']);
            $item->save();
        }
        
        return $factura;
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
        dd(Factura::first()->factura_producto->ultima_divisa);
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
