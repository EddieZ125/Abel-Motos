@extends('adminlte::page')
@section('content')
	<table class="table table-bordered" id="proveedores">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Rif</th>
				<th>Teléfono</th>
				<th>Correo Electrónico</th>
				<th>Editar</th>
			</tr>
		</thead>
	</table>
@stop
@section('js')
	<script>
		document.addEventListener('DOMContentLoaded',()=>{
			const tabla = $('#proveedores').DataTable({
				processing: true,
				serverSide: false,
				ajax: '/proveedores/buscar',
				language: window.lang_español,
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'nombre', name: 'nombre' },
					{ data: 'rif', name: 'rif' },
					{ data: 'telefono', name: 'telefono' },
					{ data: 'email', name: 'email' },
					{ data: 'editar', name: 'editar' },
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
				<a class="btn btn-success" href="/proveedores/create">Crear Proveedor</a>
			`
		})
	</script>
@stop