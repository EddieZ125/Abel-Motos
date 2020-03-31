@extends('adminlte::page')
@section('content')
	<table class="table table-bordered" id="facturas">
		<thead>
			<tr>
				<th>Id</th>
                <th>Cliente</th>
				<th>Fecha</th>
			</tr>
		</thead>
	</table>
@stop
@section('js')
	<script>
		document.addEventListener('DOMContentLoaded',()=>{
			const tabla = $('#facturas').DataTable({
				processing: true,
				serverSide: false,
				ajax: '/facturas/buscar',
				language: window.lang_español,
				columns: [
					{ data: 'id', name: 'id' },
                    { data: 'client', name: 'client' },
					{ data: 'fecha', name: 'fecha' },
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
				<a class="btn btn-success" href="/facturas/create">Crear Factura</a>
			`
		})
	</script>
@stop