@extends('adminlte::page')
@section('content')
<div class="container">
    <h2 class="text-center">Registrar nuevo Proveedor</h2>
        <form class="row justify-content-center" action=" {{ route('proveedores.store') }}" method="POST" enctype="multipart/form-data" required>
            @csrf
            <div class="form-group col-5  mt-4">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="namelHelp" placeholder="Ingresar nombre proveedor" required>
            </div> 
            <div class="form-group col-5 offset-1 mt-4">
                <label for="rif">RIF</label>
                <input type="text" class="form-control" id="rif" name="rif" aria-describedby="namelHelp" placeholder="Ingresar rif proveedor" required>
            </div>
            <div class="form-group col-5 mt-2">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" aria-describedby="namelHelp" placeholder="Ingresar telefono proveedor" required>
            </div>
            <div class="form-group col-5 offset-1 mt-2">
                <label for="correo">Correo Electrónico</label>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="namelHelp" placeholder="Ingresar correo proveedor" required>
            </div>    
            <div class="form-group col-4 offset-2 mt-4">
                <button type="submit" class="btn btn-lg btn-primary text-center">Registrar</button> 
            </div>
        </form>
</div>
    
@endsection