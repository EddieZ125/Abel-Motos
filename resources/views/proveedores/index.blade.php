@extends('adminlte::page')
@section('content')
	<table class="table table-bordered" id="proveedores">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Rif</th>
				<th>Telefono</th>
				<th>Email</th>
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
				<a class="btn btn-success" href="#">Crear Proveedor</a>
			`
		})
	</script>
@stop