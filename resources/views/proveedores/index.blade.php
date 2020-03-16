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
		$(function() {
			$('#proveedores').DataTable({
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
				]
			});
		});


		function eliminar(e){
			const resultado = confirm('Realmente desea eliminar este registro');
			if(!resultado){
				e.preventDefault()
			}
		}
	</script>
@stop