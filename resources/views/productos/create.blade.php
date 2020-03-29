@extends('adminlte::page')
@section('content')
<div class="container">
    <h2 class="text-center">Registrar nuevo Producto</h2>
        <form class="row justify-content-center" action=" {{ route('productos.store') }}" method="POST" enctype="multipart/form-data" required>
            @csrf
            <div class="col-4">
                <div class="form-group col-12  mt-4">
                    <label for="codigo">Codigo</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" aria-describedby="namelHelp" placeholder="Ingresar codigo producto" required>
                </div> 
                <div class="form-group col-12  mt-4">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="namelHelp" placeholder="Ingresar nombre producto" required>
                </div> 
                <div class="form-group col-12 mt-2">
                    <label for="precio">Precio</label>
                    <input type="text" class="form-control" id="precio" name="precio" aria-describedby="namelHelp" placeholder="Ingresar precio producto" required>
                </div>
                <div class="form-group col-12 mt-2">
                    <label for="foto">Cantidad</label>
                    <input type="text" class="form-control" id="cantidad" name="cantidad" aria-describedby="namelHelp" placeholder="Ingresar cantidad producto" required>
                </div>
            </div>
            <div class="col-6 offset-1">
                <div class="form-group col-12 offset-1 mt-2">
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="9" aria-describedby="namelHelp" placeholder="Ingresar descripcion producto" required></textarea>
                </div>
                <div class="form-group col-12 mt-2">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="imagen" aria-describedby="namelHelp" placeholder="Ingresar foto producto">
                </div>
            </div>
            <div class="form-group col-4 offset-2 mt-4">
                <button type="submit" class="btn btn-lg btn-primary text-center">Registrar</button> 
            </div>
        </form>
</div>
    
@endsection