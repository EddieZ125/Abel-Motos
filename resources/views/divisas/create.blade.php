@extends('adminlte::page')
@section('content')
<div class="container">
    <h2 class="text-center">Registrar nueva Divisa</h2>
        <form class="row justify-content-center" action=" {{ route('divisas.store') }}" method="POST" enctype="multipart/form-data" required>
            @csrf
            <div class="form-group col-5  mt-4">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="namelHelp" placeholder="Ingresar nombre divisa" required>
            </div> 
            <div class="form-group col-5 offset-1 mt-4">
                <label for="tasa">Tasa</label>
                <input type="text" class="form-control" id="tasa" name="tasa" aria-describedby="namelHelp" placeholder="Ingresar tasa divisa" required>
            </div>
            <div class="form-group col-4 offset-2 mt-4">
                <button type="submit" class="btn btn-lg btn-primary text-center">Registrar</button> 
            </div>
        </form>
</div>
    
@endsection