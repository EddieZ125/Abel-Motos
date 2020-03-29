@extends('adminlte::page')
@section('content')
<div class="container">
    <div>
        <form action="{{ route('divisas.destroy', $ultima_divisa->divisa->id) }}" method='POST' onsubmit="return confirm('Estás seguro/a?')">
            @csrf
            {{ method_field('DELETE') }}
            <div class="float-right">
                <input type='submit' class="btn btn-danger" value="Borrar Divisa"/>
            </div>
        </form>
    <div>
    <h2 class="text-center">Editar Divisa {{ $ultima_divisa->divisa->nombre }}</h2>
        <form class="row justify-content-center" action=" {{ route('divisas.update', $ultima_divisa->divisa->id) }}" method="POST" enctype="multipart/form-data" required>
            @csrf
            {{ method_field('PUT') }}
            <input name="historial_id" type="hidden" value="{{ $ultima_divisa->id }}">
            <div class="form-group col-5  mt-4">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="namelHelp" placeholder="Ingresar nombre divisa" value="{{ $ultima_divisa->divisa->nombre }}" required>
            </div> 
            <div class="form-group col-5 offset-1 mt-4">
                <label for="tasa">Tasa</label>
                <input type="text" class="form-control" id="tasa" name="tasa" aria-describedby="namelHelp" placeholder="Ingresar tasa divisa" value="{{ $ultima_divisa->tasa }}" required>
            </div>
            <div class="form-group col-4 offset-2 mt-4">
                <button type="submit" class="btn btn-lg btn-primary text-center">Actualizar</button> 
            </div>
        </form>
</div>
@endsection
