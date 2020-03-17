@extends('adminlte::page')
@section('content')
	<table class="table table-bordered" id="productos">
		<thead>
			<tr>
				<th>Id</th>
				<th>Codigo</th>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Precio</th>
			</tr>
		</thead>
	</table>
@stop
@section('js')
	<script>
		document.addEventListener('DOMContentLoaded',()=>{
			const tabla = $('#productos').DataTable({
				processing: true,
				serverSide: false,
				ajax: '/productos/buscar',
				language: window.lang_español,
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'codigo', name: 'codigo' },
					{ data: 'nombre', name: 'nombre' },
					{ data: 'descripcion', name: 'descripcion' },
					{ data: 'precio', name: 'precio' },
				],
				dom: '<"d-flex flex-row justify-content-between pr-2"f<"Botones">>rtip',
				buttons: {
					buttons: [],
					dom: {
						button: { className: 'btn' }
					}
				}
			});

			document.querySelector('.Botones').innerHTML = `
				<a class="btn btn-success" href="/productos/create">Crear Proveedor</a>
			`
		})
	</script>
@stop