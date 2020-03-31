@extends('adminlte::page')
@section('content')
	<table class="table table-bordered" id="divisas">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Unidad</th>
				<th>Tasa</th>
				<th>Editar</th>
			</tr>
		</thead>
	</table>
@stop
@section('js')
	<script>
		document.addEventListener('DOMContentLoaded',()=>{
			const tabla = $('#divisas').DataTable({
				processing: true,
				serverSide: false,
				ajax: '/divisas/buscar',
				language: window.lang_español,
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'nombre', name: 'nombre' },
					{ data: 'unidad', name: 'unidad' },
					{ data: 'tasa', name: 'tasa' },
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
				<a class="btn btn-success" href="/divisas/create">Crear Divisa</a>
			`
		})
	</script>
@stop