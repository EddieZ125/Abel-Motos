@extends('adminlte::page')
@section('content')
<div class="container">
    <div>
        <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method='POST' onsubmit="return confirm('Estás seguro/a?')">
            @csrf
            {{ method_field('DELETE') }}
            <div class="float-right">
                <input type='submit' class="btn btn-danger" value="Borrar proveedor"/>
            </div>
        </form>
    <div>
    <h2 class="text-center">Editar proveedor {{ $proveedor->nombre }}</h2>
        <form class="row justify-content-center" action=" {{ route('proveedores.update', $proveedor->id) }}" method="POST" enctype="multipart/form-data" required>
            @csrf
            {{ method_field('PUT') }}
            <div class="form-group col-5  mt-4">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="namelHelp" placeholder="Ingresar nombre proveedor" value="{{ $proveedor->nombre }}" required>
            </div> 
            <div class="form-group col-5 offset-1 mt-4">
                <label for="rif">RIF</label>
                <input type="text" class="form-control" id="rif" name="rif" aria-describedby="namelHelp" placeholder="Ingresar rif proveedor" value="{{ $proveedor->rif }}" required>
            </div>
            <div class="form-group col-5 mt-2">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" aria-describedby="namelHelp" placeholder="Ingresar telefono proveedor" value="{{ $proveedor->telefono }}" required>
            </div>
            <div class="form-group col-5 offset-1 mt-2">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="namelHelp" placeholder="Ingresar correo proveedor" value="{{ $proveedor->email }}" required>
            </div>    
            <div class="form-group col-4 offset-2 mt-4">
                <button type="submit" class="btn btn-lg btn-primary text-center">Actualizar</button> 
            </div>
        </form>
</div>
@endsection
