<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('productos.index');
    }

    public function buscar()
    {
        return DataTables::of(Producto::query())
                            ->addColumn('editar', function($data) {
                                $ruta = route('productos.edit',['producto' => $data->id]);
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
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('imagen')) {
            $imagen  = $request->file('imagen');
            $nombre  = md5($imagen->getClientOriginalName()) . '_' . time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(storage_path('app/public/imagenes/'), $nombre);
            $request->merge(['foto' => 'storage/imagenes/'.$nombre]);
        }
        Producto::create($request->all());
        return view('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', [
            'producto' => $producto
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        if ($request->has('imagen')) {
            $imagen  = $request->file('imagen');
            $nombre  = md5($imagen->getClientOriginalName()) . '_' . time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(storage_path('app/public/imagenes/'), $nombre);
            $request->merge(['foto' => "/storage/imagenes/$nombre"]);
        }
        $producto->update($request->all());
        return view('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        Producto::destroy($producto->id);
        return view('productos.index');
    }
}
