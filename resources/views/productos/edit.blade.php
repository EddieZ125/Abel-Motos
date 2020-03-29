@extends('adminlte::page')
@section('content')
<div class="container">
    <div>
        <form action="{{ route('productos.destroy', $producto->id) }}" method='POST' onsubmit="return confirm('Estás seguro/a?')">
            @csrf
            {{ method_field('DELETE') }}
            <div class="float-right">
                <input type='submit' class="btn btn-danger" value="Borrar Producto"/>
            </div>
        </form>
    <div>
    <h2 class="text-center">Actualizar producto</h2>
        <form class="row justify-content-center" action=" {{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="col-4">
                <div class="form-group col-12  mt-4">
                    <label for="codigo">Codigo</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" aria-describedby="namelHelp" placeholder="Ingresar codigo producto" value="{{ $producto->codigo }}" required>
                </div> 
                <div class="form-group col-12  mt-4">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="namelHelp" placeholder="Ingresar nombre producto" value="{{ $producto->nombre }}" required>
                </div> 
                <div class="form-group col-12 mt-2">
                    <label for="precio">Precio</label>
                    <input type="text" class="form-control" id="precio" name="precio" aria-describedby="namelHelp" placeholder="Ingresar precio producto" value="{{ $producto->precio }}" required>
                </div>
                <div class="form-group col-12 mt-2">
                    <label for="cantidad">Cantidad</label>
                    <input type="text" class="form-control" id="cantidad" name="cantidad" aria-describedby="namelHelp" placeholder="Ingresar cantidad producto" value="{{ $producto->cantidad }}" required>
                </div>
            </div>
            <div class="col-6 offset-1">
                <div class="form-group col-12 offset-1 mt-2">
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="10" aria-describedby="namelHelp" placeholder="Ingresar descripcion producto" required>{{ $producto->descripcion }}</textarea>
                </div>
                <div class="form-group col-12 mt-2">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="imagen" aria-describedby="namelHelp" placeholder="Ingresar foto producto">
                </div>
            </div>
            @if($producto->foto)
                <div>
                    <img class="img-fluid" src="{{ $producto->foto }}">
                </div>
            @endif
            <div class="form-group col-4 offset-2 mt-4">
                <button type="submit" class="btn btn-lg btn-primary text-center">Registrar</button> 
            </div>
        </form>
</div>
    
@endsection